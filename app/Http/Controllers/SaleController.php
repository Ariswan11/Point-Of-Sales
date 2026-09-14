<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function create(): View
    {
        $customers = Customer::orderBy('nama')->get();
        $products = Product::with('category')->orderBy('nama')->get();

        return view('sales.create', compact('customers', 'products'));
    }

    public function report(Request $request): View
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        $salesQuery = Sale::query()
            ->with(['customer', 'user', 'saleDetails.product'])
            ->whereBetween('tanggal_penjualan', [$startDate, $endDate])
            ->orderByDesc('tanggal_penjualan')
            ->orderByDesc('id');

        $sales = $salesQuery->get();
        $totalPenjualan = Sale::query()
            ->whereBetween('tanggal_penjualan', [$startDate, $endDate])
            ->sum('total') ?? 0;

        return view('sales.report', compact('sales', 'startDate', 'endDate', 'totalPenjualan'));
    }

    public function detail(Sale $sale): View
    {
        $sale->load(['customer', 'user', 'saleDetails.product']);

        return view('sales.detail', compact('sale'));
    }

    public function receipt(Sale $sale): View
    {
        $sale->load(['customer', 'user', 'saleDetails.product']);

        return view('sales.receipt', compact('sale'));
    }

    public function store(StoreSaleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $items = json_decode($validated['items'], true);

        if (!is_array($items) || empty($items)) {
            return back()->withErrors(['items' => 'Keranjang produk wajib diisi.'])->withInput();
        }

        $saleItems = [];
        $total = 0;

        foreach ($items as $item) {
            if (!isset($item['produk_id'], $item['jumlah'])) {
                return back()->withErrors(['items' => 'Data keranjang tidak lengkap.'])->withInput();
            }

            $product = Product::lockForUpdate()->find($item['produk_id']);

            if (!$product) {
                return back()->withErrors(['items' => 'Produk tidak ditemukan.'])->withInput();
            }

            $jumlah = (int) $item['jumlah'];

            if ($jumlah < 1) {
                return back()->withErrors(['items' => 'Jumlah produk minimal 1.'])->withInput();
            }

            if ($product->stok < $jumlah) {
                return back()->withErrors(['items' => 'Stok produk ' . $product->nama . ' tidak mencukupi.'])->withInput();
            }

            $hargaJual = (float) $product->harga_jual;
            $subtotal = $hargaJual * $jumlah;

            $saleItems[] = [
                'produk_id' => $product->id,
                'nama' => $product->nama,
                'jumlah' => $jumlah,
                'harga_jual' => $hargaJual,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        $dibayar = (float) $validated['dibayar'];
        $kembalian = max(0, $dibayar - $total);

        if ($dibayar < $total) {
            return back()->withErrors(['dibayar' => 'Jumlah pembayaran tidak boleh kurang dari total transaksi.'])->withInput();
        }

        $saleId = null;

        DB::transaction(function () use ($validated, $saleItems, $total, $dibayar, $kembalian, &$saleId) {
            $sale = Sale::create([
                'pelanggan_id' => $validated['pelanggan_id'] ?? null,
                'user_id' => Auth::id(),
                'nomor_faktur' => 'PJ-' . now()->format('YmdHis'),
                'tanggal_penjualan' => now()->toDateString(),
                'total' => $total,
                'dibayar' => $dibayar,
                'kembalian' => $kembalian,
                'status' => 'selesai',
                'catatan' => $validated['catatan'] ?? null,
            ]);

            foreach ($saleItems as $item) {
                SaleDetail::create([
                    'penjualan_id' => $sale->id,
                    'produk_id' => $item['produk_id'],
                    'jumlah' => $item['jumlah'],
                    'harga_jual' => $item['harga_jual'],
                    'subtotal' => $item['subtotal'],
                ]);

                Product::whereKey($item['produk_id'])->decrement('stok', $item['jumlah']);
            }

            $saleId = $sale->id;
        });

        return redirect()->route('sales.receipt', ['sale' => $saleId])->with('success', 'Transaksi penjualan berhasil disimpan.');
    }
}

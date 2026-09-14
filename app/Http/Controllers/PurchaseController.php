<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public function create(): View
    {
        $suppliers = Supplier::orderBy('nama')->get();
        $products = Product::orderBy('nama')->get();

        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(StorePurchaseRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $product = Product::findOrFail($data['produk_id']);

        $subtotal = (float) $data['jumlah'] * (float) $data['harga_beli'];
        $dibayar = (float) ($data['dibayar'] ?? 0);

        DB::transaction(function () use ($data, $product, $subtotal, $dibayar) {
            $purchase = Purchase::create([
                'supplier_id' => $data['supplier_id'],
                'nomor_faktur' => 'PB-' . now()->format('YmdHis'),
                'tanggal_pembelian' => now()->toDateString(),
                'total' => $subtotal,
                'dibayar' => $dibayar,
                'status' => 'completed',
                'catatan' => $data['catatan'] ?? null,
            ]);

            PurchaseDetail::create([
                'pembelian_id' => $purchase->id,
                'produk_id' => $data['produk_id'],
                'jumlah' => $data['jumlah'],
                'harga_beli' => $data['harga_beli'],
                'subtotal' => $subtotal,
            ]);

            $product->increment('stok', $data['jumlah']);
        });

        return redirect()->route('purchases.create')->with('success', 'Pembelian berhasil disimpan. Stok produk bertambah otomatis.');
    }
}

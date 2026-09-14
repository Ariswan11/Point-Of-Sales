<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplier;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'customers' => Customer::count(),
            'suppliers' => Supplier::count(),
            'sales' => Sale::count(),
            'revenue' => Sale::sum('total') ?? 0,
        ];

        $recentSales = Sale::with(['customer', 'user'])
            ->orderByDesc('tanggal_penjualan')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentSales'));
    }
}

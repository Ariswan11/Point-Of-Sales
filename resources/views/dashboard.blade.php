<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                    <div class="text-sm text-slate-500">Total Produk</div>
                    <div class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['products'] }}</div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                    <div class="text-sm text-slate-500">Total Kategori</div>
                    <div class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['categories'] }}</div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                    <div class="text-sm text-slate-500">Total Pelanggan</div>
                    <div class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['customers'] }}</div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                    <div class="text-sm text-slate-500">Total Supplier</div>
                    <div class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['suppliers'] }}</div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                    <div class="text-sm text-slate-500">Total Transaksi</div>
                    <div class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['sales'] }}</div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                    <div class="text-sm text-slate-500">Total Pendapatan</div>
                    <div class="mt-2 text-3xl font-bold text-slate-900">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="mt-8 bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h3 class="text-lg font-semibold text-slate-900">Ringkasan Penjualan</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">No. Faktur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Kasir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse ($recentSales as $sale)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                        {{ $sale->tanggal_penjualan->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                        {{ $sale->nomor_faktur }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                        {{ $sale->customer?->nama ?? 'Umum' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                        {{ $sale->user?->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        Rp {{ number_format($sale->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-500">
                                        Belum ada data penjualan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 32px;
            color: #111827;
        }

        .receipt-wrapper {
            max-width: 420px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            padding: 24px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .store-name {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .divider {
            border-top: 1px dashed #9ca3af;
            margin: 16px 0;
        }

        .meta {
            font-size: 13px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 13px;
        }

        th, td {
            padding: 6px 0;
            vertical-align: top;
        }

        th {
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .right {
            text-align: right;
        }

        .summary {
            margin-top: 12px;
            font-size: 13px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .summary-row.total {
            font-size: 16px;
            font-weight: 700;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px dashed #9ca3af;
        }

        .actions {
            margin-top: 24px;
            text-align: center;
        }

        .print-btn {
            display: inline-block;
            background: #f59e0b;
            color: #111827;
            border: none;
            border-radius: 999px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
        }

        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }

            .receipt-wrapper {
                box-shadow: none;
                border: none;
                max-width: 100%;
            }

            .actions {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-wrapper">
        <div class="header">
            <p class="store-name">POS App</p>
            <small>Point of Sale</small>
        </div>

        <div class="divider"></div>

        <div class="meta">
            <div><strong>Nomor Transaksi:</strong> {{ $sale->nomor_faktur }}</div>
            <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($sale->tanggal_penjualan)->translatedFormat('d M Y') }}</div>
            <div><strong>Kasir:</strong> {{ $sale->user->name ?? '-' }}</div>
            <div><strong>Pelanggan:</strong> {{ $sale->customer?->nama ?? 'Umum / Walk In' }}</div>
        </div>

        <div class="divider"></div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th class="right">Qty</th>
                    <th class="right">Harga</th>
                    <th class="right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->saleDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->nama ?? '-' }}</td>
                        <td class="right">{{ $detail->jumlah }}</td>
                        <td class="right">Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                        <td class="right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="divider"></div>

        <div class="summary">
            <div class="summary-row">
                <span>Total</span>
                <span>Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span>Pembayaran</span>
                <span>Rp {{ number_format($sale->dibayar, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span>Kembalian</span>
                <span>Rp {{ number_format($sale->kembalian, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row total">
                <span>Grand Total</span>
                <span>Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="actions">
            <button class="print-btn" onclick="window.print()">Print Struk</button>
        </div>
    </div>
</body>
</html>

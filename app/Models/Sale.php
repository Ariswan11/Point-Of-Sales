<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $table = 'penjualans';

    protected $fillable = [
        'pelanggan_id',
        'user_id',
        'nomor_faktur',
        'tanggal_penjualan',
        'total',
        'dibayar',
        'kembalian',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_penjualan' => 'date',
        'total' => 'decimal:2',
        'dibayar' => 'decimal:2',
        'kembalian' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'pelanggan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function saleDetails(): HasMany
    {
        return $this->hasMany(SaleDetail::class, 'penjualan_id');
    }
}

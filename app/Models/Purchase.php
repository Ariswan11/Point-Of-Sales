<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    protected $table = 'pembelians';

    protected $fillable = [
        'supplier_id',
        'nomor_faktur',
        'tanggal_pembelian',
        'total',
        'dibayar',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pembelian' => 'date',
        'total' => 'decimal:2',
        'dibayar' => 'decimal:2',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function purchaseDetails(): HasMany
    {
        return $this->hasMany(PurchaseDetail::class, 'pembelian_id');
    }
}

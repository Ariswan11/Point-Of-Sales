<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $table = 'pelanggans';

    protected $fillable = [
        'nama',
        'telepon',
        'email',
        'alamat',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'pelanggan_id');
    }
}

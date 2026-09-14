<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pelanggan_id' => ['nullable', 'exists:pelanggans,id'],
            'items' => ['required', 'string', 'json'],
            'dibayar' => ['required', 'numeric', 'min:0'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'pelanggan_id.exists' => 'Pelanggan tidak valid.',
            'items.required' => 'Keranjang produk wajib diisi.',
            'items.json' => 'Data keranjang produk tidak valid.',
            'dibayar.required' => 'Jumlah pembayaran wajib diisi.',
            'dibayar.numeric' => 'Jumlah pembayaran harus berupa angka.',
            'dibayar.min' => 'Jumlah pembayaran tidak boleh negatif.',
            'catatan.string' => 'Catatan harus berupa teks.',
            'catatan.max' => 'Catatan maksimal 500 karakter.',
        ];
    }
}

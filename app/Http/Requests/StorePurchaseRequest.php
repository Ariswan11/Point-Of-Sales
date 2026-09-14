<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'produk_id' => ['required', 'exists:produks,id'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'harga_beli' => ['required', 'numeric', 'min:0'],
            'dibayar' => ['nullable', 'numeric', 'min:0'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_id.required' => 'Supplier wajib dipilih.',
            'supplier_id.exists' => 'Supplier tidak valid.',
            'produk_id.required' => 'Produk wajib dipilih.',
            'produk_id.exists' => 'Produk tidak valid.',
            'jumlah.required' => 'Jumlah pembelian wajib diisi.',
            'jumlah.integer' => 'Jumlah pembelian harus berupa angka bulat.',
            'jumlah.min' => 'Jumlah pembelian minimal 1.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.numeric' => 'Harga beli harus berupa angka.',
            'harga_beli.min' => 'Harga beli tidak boleh negatif.',
            'dibayar.numeric' => 'Jumlah dibayar harus berupa angka.',
            'dibayar.min' => 'Jumlah dibayar tidak boleh negatif.',
            'catatan.string' => 'Catatan harus berupa teks.',
            'catatan.max' => 'Catatan maksimal 500 karakter.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product')->id;

        return [
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'nama' => ['required', 'string', 'max:150'],
            'kode_produk' => ['required', 'string', 'max:50', 'unique:produks,kode_produk,' . $productId],
            'barcode' => ['nullable', 'string', 'max:100', 'unique:produks,barcode,' . $productId],
            'harga_beli' => ['required', 'numeric', 'min:0'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'satuan' => ['required', 'string', 'max:50'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'nama.required' => 'Nama produk wajib diisi.',
            'nama.max' => 'Nama produk maksimal 150 karakter.',
            'kode_produk.required' => 'Kode produk wajib diisi.',
            'kode_produk.unique' => 'Kode produk sudah ada.',
            'barcode.unique' => 'Barcode sudah digunakan.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.numeric' => 'Harga beli harus berupa angka.',
            'harga_beli.min' => 'Harga beli tidak boleh negatif.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.numeric' => 'Harga jual harus berupa angka.',
            'harga_jual.min' => 'Harga jual tidak boleh negatif.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh negatif.',
            'satuan.required' => 'Satuan wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
            'deskripsi.max' => 'Deskripsi maksimal 255 karakter.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $customerId = $this->route('customer')->id;

        return [
            'nama' => ['required', 'string', 'max:150'],
            'telepon' => ['nullable', 'string', 'max:25'],
            'email' => ['nullable', 'email', 'max:150', 'unique:pelanggans,email,' . $customerId],
            'alamat' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama pelanggan wajib diisi.',
            'nama.string' => 'Nama pelanggan harus berupa teks.',
            'nama.max' => 'Nama pelanggan maksimal 150 karakter.',
            'telepon.string' => 'Nomor telepon harus berupa teks.',
            'telepon.max' => 'Nomor telepon maksimal 25 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
        ];
    }
}

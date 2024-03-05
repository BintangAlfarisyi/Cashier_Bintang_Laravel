<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_produk' => 'required',
            'nama_supplier' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'keterangan' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'nama_produk.required' => 'Data Nama Produk Belum Diisi',
            'nama_supplier.required' => 'Data Nama Supplier Belum Diisi',
            'harga_beli.required' => 'Data Harga Beli Belum Diisi',
            'harga_jual.required' => 'Data Harga Jual Belum Diisi',
            'stok.required' => 'Data Nama Stok Diisi',
            'keterangan.required' => 'Data Keterangan Belum Diisi'
        ];
    }
}

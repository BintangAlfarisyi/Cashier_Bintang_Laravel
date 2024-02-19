<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransaksiRequest extends FormRequest
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
            'tanggal' => 'required',
            'total_harga' => 'required',
            'metode_pembayaran' => 'required',
            'keterangan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tanggal.required' => 'Data Tanggal belum diisi!',
            'total_harga.required' => 'Data Total Harga belum diisi!',
            'metode_pembayaran.required' => 'Data Metode Pembayaran belum diisi!',
            'keterangan.required' => 'Data Keterangan belum diisi!',
        ];
    }
}

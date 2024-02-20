<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemesananRequest extends FormRequest
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
            'meja_id' => 'required',
            'tanggal_pemesanan' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'nama_pemesan' => 'required',
            'jumlah_pelanggan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_pemesan.required' => 'Data Nama Pemesanan belum diisi!',
            'tanggal_pemesanan.required' => 'Data Tanggal Pemesanan belum diisi!',
            'jam_mulai.required' => 'Data Jam Mulai belum diisi!',
            'jam_selesai.required' => 'Data Jam Selesai belum diisi!',
            'jumlah_pelanggan.required' => 'Data Jumlah Pelanggan belum diisi!',
            'meja_id.required' => 'Data Meja Id belum diisi!',
        ];
    }
}

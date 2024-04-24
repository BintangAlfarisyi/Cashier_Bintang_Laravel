<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePegawaiRequest extends FormRequest
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
            'nama_karyawan' => 'required',
            'tanggal_masuk' => 'required',
            'waktu_masuk' => 'required',
            'status' => 'required',
            'waktu_keluar' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_karyawan.required' => 'Data Nama Karyawan harus diisi!',
            'tanggal_masuk.required' => 'Data Tanggal Masuk harus diisi!',
            'waktu_masuk.required' => 'Data Waktu Masuk harus diisi!',
            'status.required' => 'Data Status harus diisi!',
            'waktu_keluar.required' => 'Data Waktu Selesai harus diisi!'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePelangganRequest extends FormRequest
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
            'nama_pelanggan' => 'required',
            'email' => 'required',
            'ponsel' => 'required',
            'alamat' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_pelanggan.required' => 'Data Nama Pelanggan belum diisi!',
            'email.required' => 'Data Email belum diisi!',
            'ponsel.required' => 'Data Ponsel belum diisi!',
            'alamat.required' => 'Data Alamat belum diisi!'
        ];
    }
}

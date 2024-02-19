<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailTransaksiRequest extends FormRequest
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
            'transaksi_id' => 'required',
            'menu_id' => 'required',
            'jumlah' => 'required',
            'sub_total' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'transaksi_id.required' => 'Data Transaksi Id belum diisi!',
            'menu_id.required' => 'Data Menu Id belum diisi!',
            'jumlah.required' => 'Data jumlah belum diisi!',
            'sub_total.required' => 'Data Sub Total belum diisi!'
        ];
    }
}

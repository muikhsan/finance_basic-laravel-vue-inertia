<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengeluaranPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required'],
            'nominal_keluar' => ['required', 'numeric', 'gt:0'],
            'tanggal_keluar' => ['required'],
            'deskripsi' => ['required', 'max:360'],
            'transaksi' => ['required'],
    ];
    }
}

<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RetailerKycRequest extends FormRequest
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
            'shop_name'         => 'required',
            'shop_front_image'  => 'image|mimes:jpeg,png,jpg|required|max:2048',
            'shop_full_address' => 'required',
            'owner_name'        => 'required',
            'other_document'    => 'required',
            'other_document_file'=>'image|mimes:jpeg,png,jpg|required|max:2048',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveVirtualRequest extends FormRequest
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
            'billing_name'=>'required',
            'amount'=>'required|numeric',
            'senderemail'=>'required',
            'sendername'=>'required',
            'recipientname'=>'required',
            'recipientemail'=>'required',
            'message'=>'nullable',
            'number'=>'nullable',
            'expiry_date'=>'nullable',
            'vendor_name'=>'nullable',
            'cvv'=>'nullable',
            'created'=>'nullable',
        ];
    }
}

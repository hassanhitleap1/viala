<?php

namespace App\Http\Requests;

use App\Models\Vaila;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VailaRequest extends \App\Http\Requests\Api\FormRequest
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



    public function rules()
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
           $id=request()->route()->parameter('vaila')->id;
            return   Vaila::rules($id)["update"];;
           
        }else{
            return  Vaila::rules()["create"];
        }

    }


    /*
     * Returns validations errors.
     *
     * @param Validator $validator
     * @throws  HttpResponseException
     */
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'=>false,
            "message" => $this->validator->errors()->first(),
            'errors' => $validator->errors(),
            'status' => 422
        ], 422));

        parent::failedValidation($validator);
    }
}

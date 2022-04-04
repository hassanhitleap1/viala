<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
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
        return false;
    }



    public function rules()
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return  Vaila::rules()["create"];
        }else{
            return   Vaila::rules()["update"];;
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
            'errors' => $validator->errors(),
            'status' => 422
        ], 422));

        parent::failedValidation($validator);
    }
}

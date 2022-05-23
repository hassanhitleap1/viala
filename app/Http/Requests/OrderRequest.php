<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest  extends \App\Http\Requests\Api\FormRequest
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
        return  [
            'form_date' => 
            [   'required',
                'date_format:Y-m-d',// format without hours, minutes and seconds.
                'after_or_equal:' . date('Y-m-d'), // not 'now' string
            ],
            'to_date' => 'required|after_or_equal:form_date',
            'vaial_id'=>'required',
        ];

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

<?php

namespace App\Http\Requests;

use App\Services\ApiResponseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class MovieRequest extends FormRequest
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
           'title' => 'required|string|max:30|min:3',
           'director' =>'required|string|max:30',
           'genre' =>'required',
           'release_year' =>'required|integer',
           'description' =>'required|string|max:255|min:30'
        ];
    }
    /**
     * Summary of prepareValidation
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     * @return never
     */
    protected function prepareValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        throw new HttpResponseException(ApiResponseService::error('Validation Errors',422,$errors));
    }
}

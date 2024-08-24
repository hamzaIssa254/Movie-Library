<?php

namespace App\Http\Requests;
use App\Services\ApiResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
            'title' => 'string|max:30|min:3',
            'director' =>'string|max:30',
            'genre' =>'string',
            'release_year' =>'integer',
            'description' =>'string|max:255|min:30'

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

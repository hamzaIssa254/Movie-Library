<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Services\ApiResponseService;


class RatingRequest extends FormRequest
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
           'user_id' => 'required|exists:users,id|integer',
           'movie_id' => 'required|exists:movies,id',
            'rating' => 'required',
            'review' => 'nullable|min:4|max:50'

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

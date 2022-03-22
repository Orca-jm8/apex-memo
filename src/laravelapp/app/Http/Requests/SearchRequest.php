<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'free_word' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'free_word.required' => '検索キーワードは必ず入力して下さい。',
        ];
    }
}

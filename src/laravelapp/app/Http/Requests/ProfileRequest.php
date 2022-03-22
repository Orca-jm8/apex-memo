<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'rank_id' => 'numeric',
            'icon' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザーネームは必ず入力して下さい。',
            'rank_id.numeric' => 'ランクは必ず選択して下さい。',
            'icon' => '画像ファイルをアップロードして下さい。',
        ];
    }
}

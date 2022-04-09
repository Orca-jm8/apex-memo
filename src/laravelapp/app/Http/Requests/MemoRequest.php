<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemoRequest extends FormRequest
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
            'memo' => 'required|max:2000',
            'tags' => 'nullable|regex: /#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u',
            'content' => 'file|mimes:jpeg,bmp,png,mp4,qt,x-ms-wmv,mpeg,x-msvideo',
        ];
    }

    public function messages()
    {
        return [
            'memo.required' => 'メモは必ず入力して下さい。',
            'memo.max' => 'メモは2000文字以下にして下さい。',
            'tags.regex' => 'タグは#〇〇のように入力して下さい。',
            'content.file' => 'ファイルは画像か動画を選択して下さい。'
        ];
    }
}

<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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

     public function getValidatorInstance() {
        //この場で作った変数にもバリデーションを設定できるようにする↓
        // $this->merge([
        //     'datetime' => $datetime,
        // ]);
        return parent::getValidatorInstance();
        //ここで定義した変数はここでしか使えないようにする↑
     }

    public function rules()
    {
        return [
            'post_title' => 'min:4|max:50',
            'post_body' => 'min:10|max:500',
            'comment' => 'string|max:250',
            // 'main_category_id' => 'required | in:1,2',
            // 'sub_category' => 'string|max:100|unique:sub_category'
        ];
    }

    public function messages(){
        return [
            'post_title.min' => 'タイトルは4文字以上入力してください。',
            'post_title.max' => 'タイトルは50文字以内で入力してください。',
            'post_body.min' => '内容は10文字以上入力してください。',
            'post_body.max' => '最大文字数は500文字です。',
            'comment.string' => 'コメントは必須項目です。',
            'comment.max' => '最大文字数は250文字です。',
            // 'main_category_id.required' => 'メインカテゴリーを選択してください。',
            // 'sub_category.max' => '最大文字数は100文字です。',
            // 'sub_category.unique' => 'すでに登録されているサブカテゴリーです。'
        ];
    }
}

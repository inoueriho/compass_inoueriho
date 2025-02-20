<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\User;

class UserRequest extends FormRequest
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
        //生年月日をまとめる
        $old_year = $this->input('old_year');
        $old_month = $this->input('old_month');
        $old_day = $this->input('old_day');
        $datetime = $old_year .'-'. $old_month .'-'. $old_day;
        //この場で作った変数にもバリデーションを設定できるようにする↓
        $this->merge([
            'datetime' => $datetime,
        ]);
        return parent::getValidatorInstance();
        //ここで定義した変数はここでしか使えないようにする↑
     }

    public function rules()
    {
        return [
            'over_name' => ' required | string | max:10',
            'under_name' => ' required | string | max:10',
            'over_name_kana' => ' required | string | max:30 | regex:/^[ｧ-ﾝﾞﾟ]*$/ ',
            'under_name_kana' => ' required | string | max:30 | regex:/^[ｧ-ﾝﾞﾟ]*$/ ',
            'mail_address' => 'required |email | min:5 | max:100 | unique:users,mail_address',
            'sex' => 'required | in:1,2,3', //男女その他ではなく数字で入れる
            'datetime' => 'required | date | after:1999-12-31 | before:tomorrow', //before afterの日は含まない
            'role' => 'required | in:1,2,3,4',
            'password' => ' required | min:8 | max:30 | confirmed',
            'password_confirmation' => ' required |string | alpha_num | min:8 | max:20',
        ];
    }
     public function messages(){
        return [
            "required" => "必須項目です",
            "email" => "メールアドレスの形式で入力してください",
            "regex" => "全角カタカナで入力してください",
            "string" => "文字で入力してください",
            "max" => "30文字以内で入力してください",
            "over_name.max" => "10文字以内で入力してください",
            "under_name.max" => "10文字以内で入力してください",
            "min" => "8文字以上で入力してください",
            "mail_address.max" => "100文字以内で入力してください",
            "unique" => "登録済みのメールアドレスは無効です",
            "confirmed" => "パスワード確認が一致しません",
            "datetime" => "有効な日付に直してください",
            "datetime.after" => "2000年1月1日から今日までの日付を入力してください",
            "datetime.before" => "2000年1月1日から今日までの日付を入力してください"
        ];
    }

}

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
    public function rules()
    {
        return [
            'over_name' => ' required | string | max:10',
            'under_name' => ' required | string | max:10',
            'over_name_kana' => ' required | string | max:30 | /^[ｧ-ﾝﾞﾟ]*$/ ',
            'under_name_kana' => ' required | string | max:30 | /^[ｧ-ﾝﾞﾟ]*$/ ',
            'mail_address' => 'required |email | min:5 | max:100 | unique:users,mail',
            'sex' => 'required | regex:/^[男|女|その他]+$/',
            'old_year' => 'required | date | after:2000-01-01 |',
            'old_month' => 'required | date | after:2000-01-01 |',
            'old_day' => 'required | date | after:2000-01-01 |',
            'role' => 'required | regex:/^[講師(国語)|講師(数学)|講師(英語)|生徒]+$/ |',
            'password' => ' required | alpha_dash | min:8 | max:30 | confirmed',
            'password_confirmation' => ' required |string | alpha_num | min:8 | max:20',
            //
        ];
    }
}

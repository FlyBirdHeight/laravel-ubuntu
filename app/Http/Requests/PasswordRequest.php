<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PasswordRequest extends Request
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
            'password_old'=>'required|min:6',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'password_old.required'=>'旧密码不能为空!',
            'password_old.min'=>'旧密码不能少于六位！',
            'password.required'=>'新密码不能为空!',
            'password.min'=>'新密码不能少于六位！',
            'password.confirmed'=>'两次密码不相同！',
            'password_confirmation.required'=>'确认密码不能为空!',
            'password_confirmation.min'=>'确认密码不能少于六位！',
        ];
    }
}

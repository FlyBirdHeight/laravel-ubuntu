<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRegisterRequest extends Request
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
            'name'=>'required|unique:users,name|between:3,20',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'用户名不能为空！',
            'name.unique'=>'用户名已经存在！',
            'name.between'=>'用户名长度在3-15个字符之间',
            'email.required'=>'邮箱不能为空！',
            'email.unique'=>'邮箱已经存在！',
            'password.required'=>'密码不能为空！',
            'password.min'=>'密码不能少于六位！',
            'password.confirmed'=>'密码与确认密码不相同!',
            'password_confirmation.confirmed'=>'确认密码不能为空！',
            'password_confirmation.min'=>'确认密码不能少于六位！',
        ];
    }
}

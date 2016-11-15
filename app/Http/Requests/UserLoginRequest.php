<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserLoginRequest extends Request
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
            'login'=>'required',
            'password'=>'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'login.required'=>'用户名或邮箱不能为空！',
            'password.required'=>'密码不能为空！'
        ];
    }
}

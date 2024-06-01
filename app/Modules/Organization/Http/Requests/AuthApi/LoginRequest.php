<?php

namespace Organization\Http\Requests\AuthApi;

use Organization\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'password' => 'required|string|max:191',
        ];
    }

}

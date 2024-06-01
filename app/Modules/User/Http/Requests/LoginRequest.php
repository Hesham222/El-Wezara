<?php

namespace User\Http\Requests;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'username' => 'required|string|max:191',
            'password' => 'required|string|max:191',
            'deviceType' => 'required|in:Web,Android,IOS',
            'firebaseToken' => 'nullable|string|max:65000',
        ];
    }
}

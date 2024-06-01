<?php

namespace User\Http\Controllers;

use App\Events\User\UserLoggedIn;
use App\Services\SmsService;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use User\Http\Requests\ChangeForgotPasswordRequest;
use User\Http\Requests\ForgotPasswordRequest;
use User\Http\Requests\LoginProviderRequest;
use User\Http\Requests\VerifyForgotCodeRequest;
use User\Mail\VerifyUser;
use User\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use User\Http\Requests\LoginRequest;
use User\Http\Requests\RegisterRequest;
use User\Http\Requests\ResendCodeRequest;
use User\Http\Requests\VerifyUserRequest;
use User\Http\Resources\UserResource;
use User\Models\UserVerification;

class AuthController extends BaseResponse
{

    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function listCodes()
    {
        return UserVerification::select('user_id', 'code', 'codeType')->orderBy('id', 'DESC')->take(6)->get();
    }

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('password')),
            ]);

            $code = rand(1000,9999);
            UserVerification::create([
                'code' => $code,
                'user_id' => $user->id,
                'codeType' => 'Verify',
            ]);

            //Mail::to($user)->send(new VerifyUser($user, $code));
            //$this->smsService->sendSMS($user->phone, $code . ' is your code');

            DB::commit();
            return $this->response(200, __('User::messages.verificationCodeSent'), 200, [], $user->id);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function verifyCode(VerifyUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('isVerified', 0)->where('id', $request->input('user_id'))->first();
            if (!$user)
                return $this->response(101, 'Validation Error', 200, [__('User::messages.userNotFound')]);
            $user->isVerified = 1;
            $user->deviceType = $request->input('deviceType');
            $user->firebaseToken = $request->input('firebaseToken');
            $user->api_token = Str::random(80);
            $user->save();
            auth()->login($user);
            event(new UserLoggedIn($user));
            DB::commit();
            return $this->response(200, $user->api_token, 200, [], 0, [
                'user' => new UserResource($user),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function resendCode(ResendCodeRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', $request->input('user_id'))->firstOrFail();
            $code = rand(1000,9999);
            UserVerification::create([
                'code' => $code,
                'user_id' => $user->id,
                'codeType' => $user->isVerified ? 'Forget' : 'Verify',
            ]);
            //$this->smsService->sendSMS($user->phone, $code . __('User::messages.codeSent'));
            //Mail::to($user)->send(new VerifyUser($user, $code));
            DB::commit();
            return $this->response(200, __('User::messages.verificationCodeSent'), 200, [], $user->id);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request)
    {
        DB::beginTransaction();
        try {
            if (
                auth()->attempt([
                    'email' => $request->input('username'),
                    'password' => $request->input('password')])
                ||
                auth()->attempt([
                    'phone' => $request->input('username'),
                    'password' => $request->input('password')])) {

                $user = auth()->user();

                if ($user->isVerified == 0)
                    return $this->response(105, 'Validation Error', 200, [__('User::messages.verifyYourAccount')], $user->id);

                $user->deviceType = $request->input('deviceType');
                $user->firebaseToken = $request->input('firebaseToken');
                if (!$user->api_token) {
                    $user->api_token = Str::random(80);
                }
                $user->save();
                event(new UserLoggedIn($user));

                DB::commit();
                return $this->response(200, $user->api_token, 200, [], 0, [
                    'user' => new UserResource($user),
                ]);
            }
            return $this->response(101, 'Validation Error', 200, [__('auth.failed')]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function loginProvider(LoginProviderRequest $request)
    {
        DB::beginTransaction();
        try {
            $socialUser = Socialite::driver($request->input('from'))->userFromToken($request->input('token'));
            if (empty($socialUser->getEmail()))
                return $this->response(101, 'Validation Error', 200, [__('User::messages.registerWithYourSocialAcc')]);

            $user = User::where('provider', $request->input('from'))->where('provider_id', $socialUser->getId())->first();

            if (is_null($user)) {
                if (User::where('email', $socialUser->getEmail())->count() > 0)
                    return $this->response(101, 'Validation Error', 200, [__('User::messages.emailAlreadyExists')]);
                else {
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'password' => bcrypt($socialUser->getId()),
                        'provider' => $request->input('from'),
                        'provider_id' => $socialUser->getId(),
                        'isVerified' => 1
                    ]);
                }
            }

            $user->deviceType = $request->input('deviceType');
            $user->firebaseToken = $request->input('firebaseToken');
            if (!$user->api_token) {
                $user->api_token = Str::random(80);
            }
            $user->save();
            auth()->login($user);
            event(new UserLoggedIn($user));

            DB::commit();
            return $this->response(200, $user->api_token, 200, [], 0, [
                'user' => new UserResource($user)
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(101, 'Validation Error', 200, [__('User::messages.invalidSocialAccount')]);
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::when($request->input('phone'), function ($query) use ($request) {
                return $query->where('phone', $request->input('phone'));
            }, function ($query) use ($request) {
                return $query->where('email', $request->input('email'));
            })->whereNull('provider_id')
                ->first();

            if (!$user)
                return $this->response(101, 'Validation Error', 200, [__('User::messages.codeSent')]);

            $code = rand(1000,9999);
            UserVerification::create([
                'code' => $code,
                'user_id' => $user->id,
                'codeType' => 'Forget',
            ]);

            //$this->smsService->sendSMS($user->phone, $code . __('User::messages.yourCodeForSite'));
            //Mail::to($user)->send(new VerifyUser($user, $code));

            DB::commit();
            return $this->response(200, __('User::messages.verificationCodeSent'), 200, [], $user->id);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function changeForgotPassword(ChangeForgotPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('isVerified', 1)->where('id', $request->input('user_id'))->first();
            if (!$user)
                return $this->response(101, 'Validation Error', 200, [__('User::messages.userNotFound')]);
            $user->password = bcrypt($request->input('password'));
            $user->deviceType = $request->input('deviceType');
            $user->firebaseToken = $request->input('firebaseToken');
            $user->api_token = Str::random(80);
            $user->save();
            auth()->login($user);
            event(new UserLoggedIn($user));
            DB::commit();
            return $this->response(200, $user->api_token, 200, [], 0, [
                'user' => new UserResource($user),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function logout()
    {
        $user = auth('api')->user();
        $user->api_token = null;
        $user->save();
        return $this->response(200, __('User::messages.loggedOut'), 200);
    }
}

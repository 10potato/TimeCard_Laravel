<?php
namespace App\Services;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginService
{
    use AuthenticatesUsers;

    /**
     * LoginService construct.
     */
    public function __construct()
    {

    }

    /**
     * ログイン処理
     *
     * @param Request $request
     * @return void
     */
    public function authorize(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return true;
        }else{
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }

    /**
     * ログアウト処理
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();
    }

}

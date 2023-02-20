<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    /**
     * @var string リダイレクト先
     */
    protected $redirectTo = '/login';

    /**
     * @var LoginService
     */
    protected $loginService;

    /**
     * LoginController construct
     *
     * @param LoginService $loginService
     */
    public function __construct(
        LoginService $loginService
    )
    {
        $this->loginService = $loginService;
    }

    /**
     * ログイン画面表示
     * 
     * @param Request $request
     * @return void
     */
    public function showLoginForm(Request $request)
    {
        // ログイン画面を表示
        return view('login');
    }

    /**
     * ログイン処理
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        // ログイン処理
        $this->loginService->authorize($request);
        // サンプル画面へリダイレクト
        // return redirect()->route('sample');
        return redirect()->route('list');
    }

    /**
     * ログアウト処理
     *
     * @return void
     */
    public function logout()
    {
        // ログアウト処理
        $this->loginService->logout();
        // ログイン画面へリダイレクト
        return redirect()->route('login');
    }

}

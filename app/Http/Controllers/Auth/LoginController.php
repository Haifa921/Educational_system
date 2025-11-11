<?php

namespace App\Http\Controllers\Auth; // ← Correct namespace

use App\Http\Controllers\Controller; // ← Extends this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// ✅ Correct namespace
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.login'); // Make sure this view exists
    }
    //   protected function credentials(\Illuminate\Http\Request $request)
    // {
    //     return ['email' => $request->email, 'password' => $request->password, 'status' => 'مفعل'];
    // }
    public function login(Request $request)
{
   // dd('dfg');
    $input = $request->all();

    $this->validate($request, [
        'name' => 'required',
        'password' => 'required',
    ]);

    $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

    if(auth()->attempt(array($fieldType => $input['name'], 'password' => $input['password'])))
    {
        return redirect()->route('home');
    } else {
        return redirect()->route('login')
            ->with('error','تحقق من عنوان البريد الإلكتروني وكلمة المرور.');
    }

}
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}


}

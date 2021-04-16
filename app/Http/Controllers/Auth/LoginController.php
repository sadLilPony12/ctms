<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;
use Session;

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

    use AuthenticatesUsers;

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
    public function login(Request $request)
        {
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->input('email'))->first();

            if (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                //   session()->put('pw', $request->input('password'));
                if (Auth::user()->is_admin) {
                    return redirect()->route('admin.article');
                }else{
                    return redirect()->route('user.article');
                }
            }
            return back()->withErrors(['Email and Password did not match']);
        }
    public function logout(Request $request)
        {
            \Session::flush();
            return redirect()->to('/');
        }
}

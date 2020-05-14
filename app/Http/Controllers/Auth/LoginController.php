<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Session;
use Illuminate\Support\Facades\Auth;
use Hash;
use Redirect;
use Validator;
use App\User;
use App\Role;
use DateTime;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';
    public $path='';

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
      $Input = $request->all();
      $credentials = $request->only('email', 'password');
      $rules = array(
        'email' => 'required|exists:users,email',
        'password' => 'required|min:6'
      );

      $validator = Validator::make($Input, $rules);

      if ($validator->fails()) {
        return Redirect::back()->withErrors($validator);
      }
      else {
        $email         = $Input['email'];
        $password      = $Input['password'];
        $password      = Hash::make($password);

        $user_detail = User::where('email', $email)->first();
        if(!$user_detail){
          return Redirect::back()->with('error','Invalid Email');
        }
        else
        {
          $hash1 = $user_detail->password; // A hash is generated
          $hash2 = Hash::make($Input['password']);
          $password_check = Hash::check($Input['password'], $hash1) && Hash::check($Input['password'], $hash2);
          if($password_check === false){
            return Redirect::back()->with('error','Invalid Password');
          }
          else {
            $user = User::where('email', $email)->where('status', 'activated')->first();
            if(!$user) {
              return Redirect::back()->with('error','Invalid Account');
            }
            else {
              Auth::attempt($credentials);
              if($user->role_id == 1){
                return Redirect::to('admin/dashboard');
              }else {
                return Redirect::to('member/dashboard');
              }
            }
          }
          return Redirect::back()->with('error','Invalid Email / Password');
        }
      }
    }
}

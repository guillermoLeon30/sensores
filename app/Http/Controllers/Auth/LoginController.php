<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use App\User;
use App\Http\Resources\User as UserResourse;
use Validator;

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
  protected $redirectTo = '/home';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('guest')->except('logout');
  }

  /**
   * Handle a login request to the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function login(Request $request){
    $this->validateLogin($request);

    if ($this->hasTooManyLoginAttempts($request)) {
      $this->fireLockoutEvent($request);

      return $this->sendLockoutResponse($request);
    }

    $credentials = [
      'email'     =>  $request->email,
      'password'  =>  $request->password,
      'rol_id'    =>  Categoria::idSuperAdmin()
    ];
    
    if (Auth::attempt($credentials)) {
      return redirect()->intended($this->redirectTo);
    }

    $this->incrementLoginAttempts($request);

    return $this->sendFailedLoginResponse($request);
  }

  /**
   * Handle a login request to the API application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response\Json|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
   *
   * @throws \Illuminate\Validation\ValidationException|GuzzleHttp\Exception\RequestException
   */
  public function apiLogin(Request $request){
    $validator = Validator::make($request->all(), [
      'email'     => 'required|email',
      'password'  => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['errores' => $validator->errors()->all()], 400);  
    }

    $credentials = [
      'email'     =>  $request->email,
      'password'  =>  $request->password
    ];

    if (!Auth::attempt($credentials)) {
      return response()->json(['errores' => ['Credenciales incorrectas.']]);
    }

    $user = User::where('email', $request->email)->get()->first();

    return (new UserResourse($user))->additional([
      'scope' => ''
    ]);
  }

}

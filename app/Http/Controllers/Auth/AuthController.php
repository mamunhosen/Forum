<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
    * where to redirect after logout
    */
    protected $redirectAfterLogout = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
    /**
    *
    */
    public function index(){
        return view('site.auth.auth');
    }
    /**
    *
    */
    public function getAuthenticated(Request $request)
    {
      $validator=$this->login_validation($request->all());
       if($validator->fails())
       {
           return Redirect::back()->withInput()->withErrors($validator->messages());
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) 
        {
           return Redirect::to('/');
        }
        return Redirect::back()->with('login_failed','The credentials you provided cannot be determined to be authentic.');
    }
    /**
    */
    public function register()
    {
        return view('site.auth.register');
    }
    /**
    *
    */
    public function store(Request $request){
        $validator=$this->validator($request->all());
        if($validator->fails()){
           return Redirect::back()->withInput()->withErrors($validator->messages());
        }
        $user=$this->create($request->all());
        Auth::login($user);
        return Redirect::to($this->redirectTo);
    }
    /**
     * Get a validator for an incoming login request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function login_validation(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return Redirect::to($this->redirectAfterLogout);

    }
}

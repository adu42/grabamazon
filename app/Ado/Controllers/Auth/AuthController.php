<?php namespace App\Ado\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request as IRequest;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Lang;
use Validator;
use App\Ado\Models\Tables\User\User;

class AuthController extends Controller {

	protected $inPrison;
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
   // use RegistersUsers;
	use AuthenticatesUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */

	public function __construct()
	{
		//$this->auth = $auth;

		//$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}



	public function login(IRequest $request)
	{
		$this->validate($request, [
			'username' => 'required', 'password' => 'required',
		]);
		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		$throttles = $this->isUsingThrottlesLoginsTrait();

		if ($throttles && $this->hasTooManyLoginAttempts($request)) {
			return $this->sendLockoutResponse($request);
		}
		$credentials = $this->getCredentials($request);

		if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
			if(Auth::user()){
				$this->inPrison = Auth::user()->isInPrison();
				if($this->inPrison>0){
					$this->inPrison = Auth::user()->bad_expire;
					Auth::logout();
						return $this->sendFailedLoginResponse($request);
				}else{
					$this->inPrison = false;
				}
			}
    		return $this->handleUserWasAuthenticated($request, $throttles);
		}
		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		if ($throttles) {
			$this->incrementLoginAttempts($request);
		}
		return $this->sendFailedLoginResponse($request);
	}


	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		if($this->inPrison){
			return Lang::has('auth.in_prison')
				? Lang::get('auth.in_prison',['expire'=>$this->inPrison])
				: 'These locked expire is '.$this->inPrison.'. <br>Because you have bad information to submit.';
		}
		return Lang::has('auth.failed')
			? Lang::get('auth.failed')
			: 'These credentials do not match our records.';
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
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
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


}

<?php

namespace App\Http\Controllers\Auth;

use App\User; 
use Auth;
use Socialite;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'is_active' => true
        ]);
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
 
    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $authUser = $this->findOrCreateUser($provider, $user);
            Auth::login($authUser, true);
        } catch (Exception $e) {
            return redirect('auth/' . $provider);
        }
 
        return redirect('/');
    }
 
    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($provider, $user)
    {   
        $data = $user->email ? $user->email : $user->id;

        $authUser = User::findUser($data)->first();

        if ($authUser) {
            return $authUser;
        }

        $facebookId = null;
        $googleId = null;

        switch ($provider) {
            case 'facebook':
                $facebookId = $user->id;
                break;
            case 'google':
                $googleId = $user->id;
                break;
            default:
                break;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'is_active' => true,
            'facebook_id' => $facebookId,
            'google_id' => $googleId
        ]);
    }
}

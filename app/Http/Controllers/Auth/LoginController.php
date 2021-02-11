<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

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


    public function showLoginForm()
    {
        return redirect()->back();
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        Session::flash('success', 'Login successful');

        // if auth user has a information on talent table.so we need to update user column
        $talent = Talent::where('email', auth()->user()->email)->first();
        if ($talent) {
            $talent->update([
                'user_id' => auth()->id()
            ]);
        }

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param $provider
     * @return RedirectResponse
     */
    public function redirectToProvider($provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider): \Illuminate\Http\RedirectResponse
    {
        $user_social = Socialite::driver($provider)->user();

        $user = $this->checkExitUser($provider, $user_social->getEmail(), $user_social->id);

        if (!$user) {
            $user = User::create([
                'name' => $user_social->name ?: $user_social->nickname,
                'email' => $user_social->email,
                'provider' => $provider,
                'provider_id' => $user_social->id,
            ]);

            $user->image()->create([
                'url' => $user_social->avatar
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }

    public function checkExitUser($provider, $email, $provider_id)
    {
        if ($email) {
            if ($user = User::where('email', $email)->first()) {
                return $user;
            }
        } else {
            if ($user = User::where('provider_id', $provider_id)->where('provider', $provider)->first()) {
                return $user;
            }
        }

        return false;
    }

    /**
     * The user has logged out of the application.
     *
     * @param Request $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        Session::flash('success', 'Logout successful');
    }
}

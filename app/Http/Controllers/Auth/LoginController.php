<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    // Remove the default redirectTo property
    // protected $redirectTo = '/home';

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
     * Get the post login redirect path.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        // You can adjust the role field and redirect paths as necessary
        if ($user->role == 'admin') {
            return '/admin/dashboard';
        } elseif ($user->role == 'operator') {
            return '/operator/dashboard';
        } elseif ($user->role == 'supervisor') {
            return '/supervisor/dashboard';
        } elseif ($user->role == 'superadmin') {
            return '/superadmin/dashboard';
        }

        // Default redirect path if no role matches
        return '/home';
    }
}

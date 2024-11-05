<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


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

    protected function authenticated(Request $request, $user)
    {

        if ($request->input('type') == 704) {
            if ($user->type === 'admin') {
                # Destroying session for verifying otp
                Session::flush();
                # Sending otp to email addresses
                $otp = $this->generateOtp();
                $data = [
                    [
                        'tomail' => 'anshutemp7@gmail.com',
                        'toname' => 'Admin',
                        'otp' => $otp->otp
                    ],
                  
                ];
                if (!env('MAIL_FROM_ADDRESS')) {
                    return redirect()->back()->with('error', 'Environment variable is missing. Please check the configuration and clear the config.');
                }
                try {
                    foreach ($data as $recipient) {
                        Mail::send('auth.otp_template', $recipient, function ($message) use ($recipient) {
                            $message->to($recipient['tomail'], $recipient['toname'])
                                ->subject('Otp for logging into JRR iInternational');
                            $message->from(getenv('MAIL_FROM_ADDRESS'), config('MAIL_USERNAME'));
                        });
                    }
                    return redirect()->route('otp.verify.form')->with(['error' => $otp->otp]);
                } catch (\Exception $e) {
                    return redirect()->back()->with(['error' => 'Email could not be sent.']);
                }
            } else {
                Auth::logout();
                return redirect()->back()->with(['error' => 'Access Denied.']);
            }
        }
    }
    public function otpVerifyForm(Request $request)
    {
        return view('auth.otp_verify');
    }

    public function otpVerify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);
        $user = User::where('type', 'admin')->first();
        // Check if user and OTP match
        if (!$user || $user->otp !== $request->otp) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }
        // Check OTP expiration (using otp_created_at for time comparison)
        $otpValidityMinutes = 2; // Define OTP validity duration
        $now = Carbon::now();
        if ($now->diffInMinutes($user->otp_created_at) >= $otpValidityMinutes) {
            return redirect()->back()->with('error', 'Your OTP has expired');
        }
        // Expire the OTP by clearing it
        $user->update([
            'otp' => null,
            'otp_created_at' => null
        ]);
        // Log the user in
        Auth::login($user);
        return redirect('/admin')->with('success', 'Hi, Welcome!');
    }


    public function adminLogin()
    {
        return view('auth.admin_login');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function generateOtp()
    {
        $user = User::where('type', 'admin')->first();
        $otpValidityMinutes = 2;
        $now = Carbon::now();
        // Check if OTP is still valid
        if ($user->otp && $user->otp_created_at && $now->diffInMinutes($user->otp_created_at) < $otpValidityMinutes) {
            return $user;
        }
        // Generate a new OTP and update the user record
        $user->otp = rand(123456, 999999);
        $user->otp_created_at = $now;
        $user->save();
        return $user;
    }
    
}

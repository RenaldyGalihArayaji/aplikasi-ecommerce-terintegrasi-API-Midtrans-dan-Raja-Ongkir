<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\AuthMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->filled('remember_me');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->email_verified_at !== null) {
                if (Auth::user()->role === 'user') {
                    return redirect()->route('home');
                } else {
                    return redirect()->route('dashboard');
                }
            } else {
                Auth::logout();
                Alert::error('Error', 'Account is not active yet. Please verify first.');
                return redirect()->route('login');
            }
        }

        Alert::error('Error', 'Email or Password Does Not Match');
        return redirect()->route('login');
    }

    public function register()
    {
        return view('auth.register', ['title' => 'Registrasi']);
    }

    public function registerStore(Request $request)
    {
        $str = Str::random(100);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
        ]);

        if ($request['password'] === $request['confirmasi_password']) {
            $infoRegister = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'verify_key' => $str
            ];

            User::create($infoRegister);

            $details = [
                'name' => $infoRegister['name'],
                'email' => $infoRegister['email'],
                'datetime' => date('Y-m-d H:i:s'),
                'url' => 'http://' . request()->getHttpHost() . "/" . "verify/" . $infoRegister['verify_key']
            ];

            Mail::to($infoRegister['email'])->send(new AuthMail($details));

            Alert::success('Success', 'verification link has been sent to your email. Check your email for verification');
            return  redirect()->route('login');
        } else {

            Alert::error('Error', 'Confirm Password is Wrong');
            return  redirect()->route('register');
        }
    }

    public function verify($verify_key)
    {
        $keyCek = User::select('verify_key')->where('verify_key', $verify_key)->exists();
        if ($keyCek) {
            $user = User::where('verify_key', $verify_key)->update(['email_verified_at' => date('Y-m-d H:i:s')]);

            Alert::success('Success', 'Verification Successfully. Your Account is Now Active');
            return redirect()->route('login');
        } else {
            Alert::error('Error', 'Invalid Key. Make Sure You Have Registered');
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

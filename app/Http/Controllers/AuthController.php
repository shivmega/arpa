<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    //Proses Login Desa
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'

        ], [
            'email.required' => 'Email wajib Diisi',
            'password.required' => 'Password wajib Diisi',
            'desa' => 'Desa wajib diisi'
        ]);
        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password

        ];


        if (Auth::attempt($infoLogin)) {
            if (Auth::user()->role == 'desa') {
                return redirect('/home');
            } else {
                Auth::logout();
                return redirect('/login')->with('error', 'Anda Bukan pengguna dengan role Desa');
            }
        } else {
            return redirect('/index')->withErrors("Username dan Password tidak sesuai")->withInput();
        };
    }
    //Proses Registrasi Desa
    public function registrasi(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'desa' => 'required'
        ], [
            'name.required' => 'Nama wajib Diisi',
            'email.required' => 'Email wajib Diisi',
            'password.required' => 'Password wajib Diisi',
            'desa' => 'Desa Wajib Diisi'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'desa' => $request->desa
        ]);

        event(new Registered($user));

        Auth::login($user);
        return redirect('/email/verify');
    }

    //Proses Forget Password
    public function forget_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? view('auth.verify_email')
            : back()->withErrors(['email' => __($status)]);
    }
    //Proses Reset Password
    public function reset_password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    //Proses Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    //Login Admin
    public function admin_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib Diisi',
            'password.required' => 'Password wajib Diisi',
        ]);
        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($infoLogin)) {
            if (Auth::user()->role !== 'desa') {
                return redirect('/home');
            } else {
                Auth::logout();
                return redirect('/admin/login')->with('error', 'Anda Bukan pengguna dengan role Admin');
            }
        } else {
            return redirect('/index')->withErrors("Username dan Password tidak sesuai")->withInput();
        };
    }

    //Proses Registrasi Admin
    public function admin_registrasi(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ], [
            'name.required' => 'Nama wajib Diisi',
            'email.required' => 'Email wajib Diisi',
            'password.required' => 'Password wajib Diisi',
        ]);
        // dd($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);


        event(new Registered($user));

        Auth::login($user);
        return redirect('/email/verify');
    }
    //Login Admin
    public function super_admin_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib Diisi',
            'password.required' => 'Password wajib Diisi',
        ]);
        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($infoLogin)) {
            if (Auth::user()->role == 'super_admin') {
                return redirect('/home');
            } else {
                Auth::logout();
                return redirect('/super_admin/login')->with('error', 'Anda Bukan pengguna dengan role Super Admin');
            }
        } else {
            return redirect('/index')->withErrors("Username dan Password tidak sesuai")->withInput();
        };
    }
}

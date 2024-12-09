<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function loginProcess(Request $request)  // Proses login
    {        
        $request->validate([
        'email' => 'required',
        'password' => 'required',
    ], [
        'email.required' => 'Email atau Username Tidak Boleh Kosong',
        'password.required' => 'Password Tidak Boleh Kosong',
     ]);
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/pengaduan_tidak_langsung');
        }
        return redirect('admin/login')->with('error' , 'Email atau password salah.');
    }

    public function registrationProcess(Request $request)  
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);


        $avatars = File::files(public_path('profile'));


        if (count($avatars) > 0) {
            $randomAvatar = $avatars[array_rand($avatars)]->getFilename();
            $data['avatar'] = $randomAvatar;
        } else {
            $data['avatar'] = 'Profile.png';
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if (!$user) {
            return redirect('admin/registration')->with('error' , 'Username atau Email telah digunakan');
        }
        return redirect('admin/login')->with('success' , 'Registrasi berhasil. Silahkan login untuk masuk ke aplikasi');
    }


    public function logout() 
    {
        Session::flush();
        Auth::logout();
        return redirect('admin/login');
    }
}

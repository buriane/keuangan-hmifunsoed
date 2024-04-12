<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('gagal', 'Login gagal, periksa username atau password yang anda masukkan.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function change()
    {
        return view('login.change_pass', [
            'title' => 'Ubah Kata Sandi',
            'active' => ''
        ]);
    }

    public function save(Request $request)
    {
        $user = Auth::user();

        if (!(Hash::check($request->get('lama'), $user->password))) {
            // The passwords matches
            return redirect()->back()->with("gagal1", "Kata sandi lama salah.");
        }

        if (strcmp($request->get('lama'), $request->get('baru')) == 0) {
            // Current password and new password same
            return redirect()->back()->with("gagal2", "Kata sandi baru tidak boleh sama dengan kata sandi lama.");
        }

        if ($request->get('baru') != $request->get('konfirmasi')) {
            return redirect()->back()->with("gagal3", "Kata sandi baru tidak sesuai.");
        }

        $validatedData = $request->validate([
            'lama' => 'required',
            'baru' => 'required|min:8',
            'konfirmasi' => 'required|min:8'
        ]);

        //Change Password
        $pass = ['password' => bcrypt($request->baru)];
        User::where('id', auth()->user()->id)->update($pass);

        return redirect('/')->with("sukses", "Kata sandi berhasil diperbarui.");
    }
}

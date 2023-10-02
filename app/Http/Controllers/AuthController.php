<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function home()
    {
     
        return view('home');

    }

    public function index()
    {
       
        return view('feature');
    }
    public function login(Request $request)
    {
       $request->validate([
            'nama_kary' => 'required',
            'password' => 'required',
        ]);

      
        $user = User::where('nama_kary', $request->nama_kary)->first();

    if (!$user) {
        return back()->with('error', 'Nama salah.');
    }

    // Periksa kata sandi saat ini menggunakan hashing SHA1
    if ($user->Password == sha1($request->password)) {
        Auth::login($user);
        return redirect('home')->with('success','berhasil');
    } else {
        return back()->with('error','Password salah.');
    }

    }

    public function logout()
    {
        Auth::logout(); // Melakukan logout user yang sedang login
        return redirect()->route('login'); // Redirect user ke halaman login setelah logout
    }
    public function editdata(){
        
        return view('update');
       // return $data = Post::find($NoSPK);
    }

  
}
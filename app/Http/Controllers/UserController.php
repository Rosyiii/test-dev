<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('login', [
            "tittle" => "LOG IN"
        ]);
    }

    public function users(){
        return view('data_user', [
            "tittle" => "Data User",
            "users" => User::latest()->paginate(9)
        ]);
    }

    public function detail(User $id){
        return view('detail_user', [
            "tittle" => "Detail User",
            "jabatans" => ["Admin", "Author"],
            "result" => $id
        ]);
    }

    public function indexRegis()
    {
        return view('registrasi', [
            "tittle" => "Registrasi",
            "jabatans" => ["Admin", "Author"]
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/')->with('message', 'Anda Berhasil Login. Selamat datang '. auth()->user()->name . '!!');
        }

        return back()->with('loginEror', 'Login Failed');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'jabatan' => 'required',
            'username' => ['required', 'min:4', 'max:20', 'unique:users,username'],
            'password' => ['required', 'min:4', 'max:255']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/')->with('message', 'Data User Berhasil Ditambahkan!!');
    }
    
    public function loginSucces(){
        if(auth()->user()->jabatan === "Admin"){
            return view('home', [
                "tittle" => "Home",
                "posts" => Post::with('user')->latest()->paginate(9)
        ]);}
        else
        {
            return view('home', [
                "tittle" => "Home",
                "posts" => Post::with('user')->where('id_user', auth()->user()->id)->latest()->paginate(9) // hanya dapat melihat post yang dibuat olehnya sendiri
        ]);}
    }

    public function update(Request $request, User $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required'
        ]);

        User::where('id', $id->id)->update($validatedData);

        return redirect('/')->with('message', 'Data Karyawan Berhasil Di Perbarui!!');
    }

    public function logout()
    {
        Auth::logout();
    
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect('/login');
    }
}

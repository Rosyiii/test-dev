<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function indexTambah(){
        return view('tambah_post', [
            "tittle" => "Tulis Post"
        ]);
    }

    public function detail(Post $id)
    {
        if (auth()->user()->jabatan !== "Admin" && $id["id_user"] !== auth()->user()->id) {
            return redirect('/')->with('message', 'Anda Tidak bisa membuka pesan milik orang lain!!');
        }else{
            return view('detail_post', [
                "tittle" => "Detail Post",
                "result" => $id
            ]);
        }
    }

    public function edit(Post $id)
    {
        if (auth()->user()->jabatan !== "Admin" && $id["id_user"] !== auth()->user()->id) {
            return redirect('/')->with('message', 'Anda Tidak bisa mengubah pesan milik orang lain!!');
        } else {
            return view('edit_post', [
                "tittle" => "Edit Post",
                "result" => $id
            ]);
        }
    }
    
    public function store(Request $request){
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'isi_post' => 'required'
        ]);

        $validatedData['id_user'] = auth()->user()->id;

        Post::create($validatedData);

        return redirect('/')->with('message', 'Data Post Berhasil Ditambahkan!!');
    }

    public function update(Request $request, Post $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'isi_post' => 'required'
        ]);

        $validatedData['id_user'] = auth()->user()->id;

        Post::where('id', $id->id)->update($validatedData);

        return redirect('/')->with('message', 'Data Karyawan Berhasil Di Perbarui!!');
    }

    public function destroy(Request $request)
    {
        Post::where('id', $request->id)->delete();

        return redirect('/')->with('message', 'Data berhasil dihapus!!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
{
    public function profilUser(){
        return view('landing.profil.index',['title' => 'My Profil']);
    }

    public function updateUser(Request $request){
        
        // Validasi input
        $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'name' => 'required',
            'phone' => 'required',
        ]);

        $data = Auth::user();

        // Cek apakah upload file
        if ($request->hasFile('image')) {

            // Menghapus file lama dari storage
            Storage::delete('public/images_profil/' . $data->image);

            // Upload file baru dengan format nama ditentukan
            $name = $request->file('image');
            $fileName = 'Profil_' . time() . '.' . $name->getClientOriginalExtension();
            $request->file('image')->storeAs('public/images_profil', $fileName);

            // Update file di database
            $data->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'image' => $fileName,
            ]);
        } else {
            // Jika tidak ada gambar yang diunggah, hanya update data lainnya
            $data->update([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
        }

        // Redirect
        Alert::success('Sukes','Profil berhasil di perbarui!!');
          return redirect()->route('profilUser');
    }
    

    public function change_password_user(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        // Cek password lama
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            Alert::error('Gagal','Password lama tidak sesuai!');
            return redirect()->route('profilUser');
        }

        // Validasi password baru
        if ($request['new_password'] != $request['confirmasi_password']) {
            Alert::error('Gagal','Password baru dan Konfirmasi password tidak sesuai!');
            return redirect()->route('profilUser');
        }

        // Update password
        Auth::user()->update([
            'password' => bcrypt($request->new_password),
        ]);

        Alert::success('Sukse','Password berhasil di ubah!');
        return redirect()->route('profilUser');
    }


    // Admin
    public function profilAdmin(){
        return view('admin.profil.index',['title' => 'Profil']);
    }

    public function updateAdmin(Request $request){
        // Validasi input
        $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $data = Auth::user();

        // Cek apakah upload file
        if ($request->hasFile('image')) {

            // Menghapus file lama dari storage
            Storage::delete('public/images_profil/' . $data->image);

            // Upload file baru dengan format nama ditentukan
            $name = $request->file('image');
            $fileName = 'Profil_' . time() . '.' . $name->getClientOriginalExtension();
            $request->file('image')->storeAs('public/images_profil', $fileName);

            // Update file di database
            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => $fileName,
            ]);

            Alert::success('Sukses', 'Profil berhasil di Perbarui!!');
        } else {
            // Jika tidak ada gambar yang diunggah, hanya update data lainnya
            $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            Alert::success('Sukses', 'Profil berhasil di Perbarui!!');
        }

        return redirect()->route('profilAdmin');
    }


    public function change_password_admin(){
        return view('admin.change-password.index',['title' => 'Change Password Admin']);
    }

    public function change_password(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        // Cek password lama
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            Alert::error('Gagal', 'Password Lama tidak sesuai!!');
            return redirect()->route('change_password_admin');
        }

        // Validasi password baru
        if ($request['new_password'] != $request['confirmasi_password']) {
            Alert::error('Gagal', 'Password Baru dan Konfirmasi Password tidak sesuai!!');
            return redirect()->route('change_password_admin');
        }

        // Update password
        Auth::user()->update([
            'password' => bcrypt($request->new_password),
        ]);

        Alert::success('Sukses', 'Password berhasil diubah!!');
        return redirect()->route('change_password_admin');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    //
    public function index()
    {
        return view('setting'); // Pastikan file resources/views/setting.blade.php ada
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Opsional: bisa tambah konfirmasi password sebelum hapus akun
        $request->validate([
            'password' => 'required',
        ]);

        // Cek password sesuai dengan user yang login
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        Auth::logout();

        // Hapus user dari database
        $user->delete();

        // Redirect ke halaman utama setelah akun dihapus
        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }

}

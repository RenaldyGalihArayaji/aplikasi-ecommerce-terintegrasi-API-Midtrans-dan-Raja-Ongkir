<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::where('role', 'user')->get();
        return view('admin.pengguna.index', ['title' => 'Pengguna'], compact('pengguna'));
    }
}

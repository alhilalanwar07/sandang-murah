<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Pelanggan;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class UserRegister extends Component
{
    use WithFileUploads;

    public $name, $alamat, $no_telp, $email, $password, $gambar;
    
    public function render()
    {
        return view('livewire.user-register')->extends('layouts.auth')->section('content');
    }

    public function register(){
        $this->validate([
            'name' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'gambar' => 'required',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'pelanggan',
        ]);

        $imageName = time() . '.' . $this->gambar->extension();

        Pelanggan::create([
            'user_id' => $user->id,
            'nama_pelanggan' => $this->name,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'gambar' => $this->gambar->storeAs('images', $imageName),
            'status' => 'aktif',
        ]);

        return redirect()->route('login')->with('success', 'Register Berhasil, Silahkan Login');
    }
}

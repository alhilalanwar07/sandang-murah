<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Pelanggan;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DataPelanggan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    use WithFileUploads;

    public $search;
    public $perPage = 10;

    protected $updatesQueryString = ['search', 'perPage'];

    protected $pelanggans;
    protected $users;

    public $nama_pelanggan;
    public $alamat;
    public $no_telp;
    public $email;
    public $gambar;
    public $status;
    public $pelanggan_id;
    public $password;
    public $user_id;
    public $role;

    public function render()
    {
        $this->pelanggans = Pelanggan::where('nama_pelanggan', 'like', '%' . $this->search . '%')
            ->orWhere('alamat', 'like', '%' . $this->search . '%')
            ->orWhere('no_telp', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);
        return view('livewire.data-pelanggan', [
            'pelanggans' => $this->pelanggans
        ])->extends('layouts.app')->section('content');
    }

    public function resetInput()
    {
        $this->nama_pelanggan = '';
        $this->alamat         = '';
        $this->no_telp        = '';
        $this->email          = '';
        $this->gambar         = '';
        $this->status         = '';
        $this->pelanggan_id   = '';
    }

    public function pelangganId($id)
    {
        $pelanggan            = Pelanggan::find($id);
        $this->pelanggan_id   = $id;
        $this->nama_pelanggan = $pelanggan->nama_pelanggan;
        $this->alamat         = $pelanggan->alamat;
        $this->no_telp        = $pelanggan->no_telp;
        $this->email          = $pelanggan->email;
        // $this->gambar         = $pelanggan->gambar;
        $this->status         = $pelanggan->status;

    }

    public function store()
    {
        $this->validate([
            'nama_pelanggan' => 'required',
            'alamat'         => 'required',
            'no_telp'        => 'required',
            'email'          => 'required',
            'gambar'         => 'required',
            'password'       => 'required'
        ]);

        $user = User::create([
            'name'     => $this->nama_pelanggan,
            'email'    => $this->email,
            'password' => bcrypt($this->password),
            'role'     => 'pelanggan'
        ]);

        $user_id = $user->id;
        // gambar save to public folder
        $imageName = time() . '.' . $this->gambar->extension();

        Pelanggan::create([
            'nama_pelanggan' => $this->nama_pelanggan,
            'alamat'         => $this->alamat,
            'no_telp'        => $this->no_telp,
            'email'          => $this->email,
            'gambar'         => $this->gambar->storeAs('/public/images', $imageName),
            'status'         => 'aktif',
            'user_id'        => $user_id
        ]);

        $this->resetInput();
        session()->flash('message', 'Data Berhasil Ditambahkan');
    }

    public function update()
    {
        $this->validate([
            'nama_pelanggan' => 'required',
            'alamat'         => 'required',
            'no_telp'        => 'required',
            'email'          => 'required',
        ]);

        if ($this->pelanggan_id) {
            if ($this->gambar) {
                $imageName = time() . '.' . $this->gambar->extension();
                $this->gambar->storeAs('/public/images', $imageName);

                $pelanggan = Pelanggan::find($this->pelanggan_id);
                $pelanggan->update([
                    'nama_pelanggan' => $this->nama_pelanggan,
                    'alamat'         => $this->alamat,
                    'no_telp'        => $this->no_telp,
                    'email'          => $this->email,
                    'gambar'         => $imageName,
                ]);
                $this->resetInput();
                session()->flash('message', 'Data Berhasil Diupdate');
            } else {
                $pelanggan = Pelanggan::find($this->pelanggan_id);
                $pelanggan->update([
                    'nama_pelanggan' => $this->nama_pelanggan,
                    'alamat'         => $this->alamat,
                    'no_telp'        => $this->no_telp,
                    'email'          => $this->email,
                ]);
                $this->resetInput();
                session()->flash('message', 'Data Berhasil Diupdate');
            }
        }
    }

    public function delete($id)
    {
        if ($id) {
            $pelanggan = Pelanggan::find($id);
            $pelanggan->delete();
            session()->flash('message', 'Data Berhasil Dihapus');
        }
    }
}

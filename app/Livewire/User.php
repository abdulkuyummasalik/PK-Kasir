<?php

namespace App\Livewire;

use App\Models\User as ModelUser;

use Livewire\Component;

class User extends Component
{
    public $pilihanMenu = 'lihat';
    public $nama;
    public $email;
    public $peran;
    public $password;
    public $penggunaTerpilih;

    public function mount(){
        if(auth()->user()->peran != 'admin'){
            abort(403);
        }
    }

    public function pilihEdit($id){
        $this->penggunaTerpilih = ModelUser::findOrFail($id);
        $this->nama = $this->penggunaTerpilih->name;
        $this->email = $this->penggunaTerpilih->email;
        $this->peran = $this->penggunaTerpilih->peran;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
{
    $this->validate([
        'nama' => 'required|min:3',
        'email' => 'required|email|unique:users,email,' . $this->penggunaTerpilih->id,
        'peran' => 'required',
        'password' => 'nullable|min:6' // Mengubah validasi password
    ], [
        'nama.required' => 'Nama harus diisi',
        'nama.min' => 'Nama minimal 3 karakter',
        'email.required' => 'Email harus diisi',
        'email.email' => 'Email harus valid',
        'email.unique' => 'Email sudah terdaftar',
        'peran.required' => 'Peran harus dipilih',
        'password.min' => 'Password minimal 6 karakter' // Menambah pesan validasi password
    ]);

    $simpan = $this->penggunaTerpilih;
    $simpan->name = $this->nama;
    $simpan->email = $this->email;
    if ($this->password) {
        $simpan->password = bcrypt($this->password);
    }
    $simpan->peran = $this->peran;
    $simpan->save();

    $this->reset(['nama', 'email', 'peran', 'password', 'penggunaTerpilih']);
    $this->pilihanMenu = 'lihat';
}


    public function pilihHapus($id){
        $this->penggunaTerpilih = ModelUser::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus(){
        $this->penggunaTerpilih->delete();
        $this->reset();
    }

    public function batal(){
        $this->reset();
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'peran' => 'required',
            'password' => 'required'
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah terdaftar',
            'peran.required' => 'Peran harus dipilih',
            'password.required' => 'Password harus diisi'
        ]);

        $simpan = new ModelUser();
        $simpan->name = $this->nama;
        $simpan->email = $this->email;
        $simpan->peran = $this->peran;
        $simpan->password = bcrypt($this->password);
        $simpan->save();

        $this->reset(['nama', 'email', 'peran', 'password']);
        $this->pilihanMenu = 'lihat';
    }

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function render()
    {
        return view('livewire.user')->with([
            'semuaPengguna' => ModelUser::all()
        ]);
    }
}

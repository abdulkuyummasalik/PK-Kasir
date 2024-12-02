<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk as ModelProduk;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Produk as ImportProduk;

class Produk extends Component
{
    use WithFileUploads;
    public $pilihanMenu = 'lihat';
    public $nama;
    public $kode;
    public $harga;
    public $stok;
    public $produkTerpilih;
    public $fileExcel;

    public function mount(){
        if(auth()->user()->peran != 'admin'){
            abort(403);
        }
    }

    public function importExcel(){
        Excel::import(new ImportProduk, $this->fileExcel);
        $this->reset();
    }

    public function pilihEdit($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->nama = $this->produkTerpilih->nama;
        $this->kode = $this->produkTerpilih->kode;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
    {
        $this->validate([
            'nama' => 'required|min:3',
            'kode' => 'required|unique:produks,kode,' . $this->produkTerpilih->id,
            'harga' => 'required',
            'stok' => 'required'
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'kode.required' => 'kode harus diisi',
            'kode.unique' => 'kode sudah terdaftar',
            'harga.required' => 'harga harus diisi',
            'stok.required' => 'stok harus diisi'
        ]);

        $simpan = $this->produkTerpilih;
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->harga = $this->harga;
        $simpan->stok = $this->stok;
        $simpan->save();

        $this->reset();
        $this->pilihanMenu = 'lihat';
    }


    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus()
    {
        $this->produkTerpilih->delete();
        $this->reset();
    }

    public function batal()
    {
        $this->reset();
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required|min:3',
            'kode' => 'required|unique:produks',
            'harga' => 'required',
            'stok' => 'required'
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'kode.required' => 'kode harus diisi',
            'kode.unique' => 'kode sudah terdaftar',
            'harga.required' => 'harga harus diisi',
            'stok.required' => 'stok harus diisi'
        ]);

        $simpan = new ModelProduk();
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->harga = $this->harga;
        $simpan->stok = $this->stok;
        $simpan->save();

        $this->reset(['nama', 'kode', 'harga', 'stok']);
        $this->pilihanMenu = 'lihat';
    }

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function render()
    {
        return view('livewire.produk')->with([
            'semuaProduk' => ModelProduk::all()
        ]);
    }
}

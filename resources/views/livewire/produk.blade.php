<div>
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">Semua
                    Produk</button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">Tambah
                    Produk</button>
                    <button wire:click="pilihMenu('excel')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">Import
                    Produk</button>
                <button wire:loading class="btn btn-info">Loading...</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($pilihanMenu == 'lihat')
                    <div class="card border-primary">
                        <div class="card-header">
                            Semua Produk
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <th>No </th>
                                    <th>Kode </th>
                                    <th>Nama </th>
                                    <th>Harga </th>
                                    <th>Stok </th>
                                    <th>Aksi </th>
                                </thead>
                                <tbody>
                                    @foreach ($semuaProduk as $produk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $produk->kode }}</td>
                                            <td>{{ $produk->nama }}</td>
                                            <td>{{ $produk->harga }}</td>
                                            <td>{{ $produk->stok }}</td>
                                            <td>
                                                <button wire:click="pilihEdit({{ $produk->id }})"
                                                    class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">Edit
                                                    Produk</button>
                                                <button wire:click="pilihHapus({{ $produk->id }})"
                                                    class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-primary' }}">Hapus
                                                    Produk</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'tambah')
                    <div class="card border-primary">
                        <div class="card-header">
                            Tambah Produk
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="simpan">
                                <div class="mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" wire:model="nama">
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kode">Kode</label>
                                    <input type="text" class="form-control" id="kode" wire:model="kode">
                                    @error('kode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" id="harga" wire:model="harga">
                                    @error('harga')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" id="stok" wire:model="stok">
                                    @error('stok')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            </form>

                        </div>
                    </div>
                @elseif ($pilihanMenu == 'edit')
                    <div class="card border-primary">
                        <div class="card-header">
                            Edit produk
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="simpanEdit">
                                <div class="mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" wire:model="nama">
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kode">Kode</label>
                                    <input type="text" class="form-control" id="kode" wire:model="kode">
                                    @error('kode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" id="harga" wire:model="harga">
                                    @error('harga')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" id="stok" wire:model="stok">
                                    @error('stok')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            </form>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'hapus')
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            Hapus produk
                        </div>
                        <div class="card-body">
                            Apakah anda yakin untuk menghapus produk ini :
                            <p>Nama : {{ $produkTerpilih->nama }}</p>
                            <button class="btn btn-danger" wire:click="hapus">Hapus</button>
                            <button class="btn btn-secondary" wire:click="batal">Batal</button>
                        </div>
                    </div>
                    @elseif ($pilihanMenu == 'excel')
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            Import produk
                        </div>
                        <div class="card-body">
                            <form action="" wire:submit="importExcel" enctype="multipart/form-data">
                                @csrf
                                <input type="file" class="form-control" wire:model="fileExcel">
                                <button type="submit" class="btn btn-primary mt-3">Import</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

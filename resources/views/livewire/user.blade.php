<div>
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <div class="btn-group" role="group" aria-label="Menu Pengguna">
                    <button wire:click="pilihMenu('lihat')"
                        class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">Semua Pengguna</button>
                    <button wire:click="pilihMenu('tambah')"
                        class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">Tambah Pengguna</button>
                    <button wire:loading class="btn btn-info">Loading...</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($pilihanMenu == 'lihat')
                    <div class="card border-primary shadow">
                        <div class="card-header bg-primary text-white">
                            Semua Pengguna
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Peran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semuaPengguna as $pengguna)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pengguna->name }}</td>
                                                <td>{{ $pengguna->email }}</td>
                                                <td>{{ $pengguna->peran }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Aksi Pengguna">
                                                        <button wire:click="pilihEdit({{ $pengguna->id }})"
                                                            class="btn btn-sm {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">Edit</button>
                                                        <button wire:click="pilihHapus({{ $pengguna->id }})"
                                                            class="btn btn-sm {{ $pilihanMenu == 'hapus' ? 'btn-danger' : 'btn-outline-danger' }}">Hapus</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'tambah')
                    <div class="card border-primary shadow">
                        <div class="card-header bg-primary text-white">
                            Tambah Pengguna
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
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" wire:model="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" wire:model="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="peran">Peran</label>
                                    <select name="peran" id="peran" class="form-control" wire:model="peran">
                                        <option value="">Pilih Peran</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @error('peran')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'edit')
                    <div class="card border-primary shadow">
                        <div class="card-header bg-primary text-white">
                            Edit Pengguna
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
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" wire:model="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" wire:model="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="peran">Peran</label>
                                    <select name="peran" id="peran" class="form-control" wire:model="peran">
                                        <option value="">Pilih Peran</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @error('peran')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" wire:click="batal">Batal</button>
                            </form>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'hapus')
                    <div class="card border-danger shadow">
                        <div class="card-header bg-danger text-white">
                            Hapus Pengguna
                        </div>
                        <div class="card-body">
                            <p>Apakah anda yakin untuk menghapus pengguna ini:</p>
                            <p>Nama: {{ $penggunaTerpilih->name }}</p>
                            <button class="btn btn-danger" wire:click="hapus">Hapus</button>
                            <button class="btn btn-secondary" wire:click="batal">Batal</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


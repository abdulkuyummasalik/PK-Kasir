<div>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                @if (!$transaksiAktif)
                    <button class="btn btn-primary" wire:click="transaksiBaru"> Transaksi Baru</button>
                @else
                    <button class="btn btn-danger" wire:click="batalTransaksi">Batal Transaksi</button>
                @endif
                <button class="btn btn-info" wire:loading>Loading...</button>
            </div>
            @if ($transaksiAktif)
                <div class="row mt-2">
                    <div class="col-8">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h4 class="card-title">No Invoice : {{ $transaksiAktif->kode }}</h4>
                                <input type="text" class="form-control" placeholder="No Invoice"
                                    wire:model.live="kode">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qyt</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semuaProduk as $produk)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $produk->produk->kode }}</td>
                                                <td>{{ $produk->produk->nama }}</td>
                                                <td>Rp {{ number_format($produk->produk->harga, 2, ',', '.') }}</td>
                                                <td>{{ $produk->jumlah }}</td>
                                                <td>Rp
                                                    {{ number_format($produk->produk->harga * $produk->jumlah, 2, ',', '.') }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger"
                                                        wire:click="hapusProduk({{ $produk->id }})">Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h4 class="card-title">Total Biaya</h4>
                                <div class="d-flex justify-content-between">
                                    <span>Rp </span>
                                    <span>{{ number_format($totalSemua, 2, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card border-primary mt-2">
                            <div class="card-body">
                                <h4 class="card-title">Bayar</h4>
                                <input type="number" class="form-control" placeholder="Bayar" wire:model.live="bayar">
                            </div>
                        </div>
                        <div class="card border-primary mt-2">
                            <div class="card-body">
                                <h4 class="card-title">Kembalian</h4>
                                <div class="d-flex justify-content-between">
                                    <span>Rp </span>
                                    <span>{{ number_format($kembalian), 2, ',', '.' }}</span>
                                </div>
                            </div>
                        </div>
                        @if ($bayar)
                            @if ($kembalian < 0)
                                <div class="alert alert-danger mt-2 w-100" role="alert">
                                    Uang Kurang {{ $kembalian }}
                                </div>
                            @else
                                <button class="btn btn-success mt-2 w-100" wire:click="transaksiSelesai">Bayar</button>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

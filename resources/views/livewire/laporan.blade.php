<div>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="card-body">
                        <h1 class="card-title">Laporan Transaksi</h1>
                        <a href="{{ url('/cetak') }}" target="_blank" class="btn btn-primary mb-3">cetak</a>
                        <table class="table table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No. Invoice</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                @foreach ($semuaTransaksi as $transaksi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaksi->created_at }}</td>
                                    <td>{{ $transaksi->kode }}</td>
                                    <td>Rp. {{ number_format($transaksi->total, 0, '', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

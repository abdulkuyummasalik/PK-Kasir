<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Produk as ModelProduk;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;


class Produk implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // dd($collection);
        foreach ($collection as $col) {
            $kodeYangAdaDiDatabase = ModelProduk::where('kode', $col[1])->first();
            if (!$kodeYangAdaDiDatabase) {
                $simpan = new ModelProduk();
                $simpan->kode = $col[1];
                $simpan->nama = $col[2];
                $simpan->harga = $col[3];
                $simpan->stok = 10;
                $simpan->save();
            }
        }
    }
}

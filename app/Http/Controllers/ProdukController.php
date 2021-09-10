<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Exception;

class ProdukController extends Controller
{
    public function create()
    {
        $data = [
            'kode_produk' => request()->post('kode_produk'),
            'nama_produk' => request()->post('nama_produk'),
            'harga' => request()->post('harga')
        ];

        try {
            $hasil = Produk::create($data);

            return $this->responseHasil(200, true, $hasil);
        } catch (Exception $e) {
            return $this->responseHasil(500, false, [
                'message' => $e->getMessage(),
                'data' => $data
            ]);
        }
    }
}
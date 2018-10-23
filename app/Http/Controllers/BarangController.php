<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class BarangController extends Controller
{
    //
    public function index()
    {
        $barang = new barang();
        $data['judul'] = 'Data Barang';
        $data['barangs'] = $barang->paginate(10);

        return view('barang_index', $data);
    }

    public function create()
    {
        return view('tambah_barang');
    }

    public function store(Request $request)
    {
        //rules validasi inputan users
        $rules = [
            'nama' => 'required|min:2|max:50',
            'harga_jual' => 'required|numeric|min:2',
            'stok' => 'required|numeric|min:2|max:50',
            'gambar' => 'required|min:2|max:100',
        ];

        //lakukan validasi rules
        $this->validate($request, $rules);

        //buat object dari model barang
        $barang = new barang();

        //isi tabel barang
        $barang->fill([
            'nama' => $request->nama,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'gambar' => 'barang/' . $request->gambar,
        ])->save();

        //oper data di database ke view
        $data['judul'] = 'Data Barang';
        $data['barangs'] = $barang->paginate(10);

        //redirect ke halaman index barang jika sudah berhasil dan berikan pesan
        return redirect()->route('barang_index', $data)->with('success', 'Berhasil menambah data barang');
    }
}

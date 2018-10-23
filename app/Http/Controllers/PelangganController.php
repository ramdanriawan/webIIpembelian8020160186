<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pelanggan;

class PelangganController extends Controller
{
    //
    public function index()
    {
    	$data['pelanggans'] = \App\Pelanggan::paginate(10);
  		$data['judul']  = "Data Pelanggan";
  		return view('pelanggan_index',$data);
    }

    public function create()
    {
        return view('tambah_pelanggan');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|min:2|max:50',
            'alamat' => 'required|min:2|max:255'
        ];

        //untuk memvalidasi form
        $this->validate($request, $rules);

        //inisialisasi object
        $pelanggan = new Pelanggan();

        //input data ke database
        $pelanggan->fill([
            'nama' => $request->nama,
            'alamat' => $request->alamat
        ])->save();

        //keluarkan data pelanggan ke index
    	$data['pelanggans'] = \App\Pelanggan::paginate(10);
	       $data['judul']  = "Data Pelanggan";

        return redirect()->route('pelanggan_index', $data)->with('success', 'Berhasil memasukkan data pelanggan');
    }
}

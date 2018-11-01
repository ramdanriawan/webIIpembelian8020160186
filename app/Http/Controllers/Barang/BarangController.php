<?php

namespace App\Http\Controllers\Barang;

use App\Settingan\Settingan;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{


    public function __construct()
    {
        $this->settingan = new Settingan('barang', new Barang());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->settingan->allData['judul'] = 'halaman gue';
        return $this->settingan->setIndex();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->settingan->allData['judul'] = 'entah apalah';
        return $this->settingan->setCreate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return $this->settingan->setStore($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
        return $this->settingan->setShow($barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
        $this->settingan->allData['judul'] = 'iyolah';
        return $this->settingan->setEdit($barang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        //
        return $this->settingan->setUpdate($request, $barang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        //
        return $this->settingan->setDestroy($barang);
    }

    public function loadBarang()
    {
        // dd('oke');
        $barang = new barang();
        $dataBarang = $barang->all();
        $dataBarang['token'] = csrf_token();
        return json_encode($dataBarang);
    }
}

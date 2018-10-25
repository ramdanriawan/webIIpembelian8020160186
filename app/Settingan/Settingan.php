<?php

namespace App\Settingan;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;


class Settingan extends Model
{
    public function __construct($halaman)
    {
        //default value untuk barang
        $this->halaman       = $halaman;

        //nilai untuk setting pagination setiap halaman dari kumpulan data
        $this->paginate      = 10;

        //nilai untuk setting pembuatan halaman
        $this->halamanCreate = "$this->halaman.create";

        //nilai untuk halaman index
        $this->halamanIndex  = "$this->halaman.index";

        //nilai untuk halaman menampilkan sebuah data secara spesifik
        $this->halamanShow   = "$this->halaman.show";

        //nilai untuk halaman edit
        $this->halamanEdit   = "$this->halaman.edit";

        //nilai untuk mengoper banyak data dari suatu halaman
        $this->datas         = "{$this->halaman}s";

        //nilai untuk mengoper satu data dari sebuah halamn
        $this->data          = $this->halaman;

        //data pesan success
        $this->success       = 'success';

        //data pesan errorr
        $this->error         = 'errorr';

        //nilai  untuk setting pesan jika berhasil menghapus data
        $this->successDelete = "Berhasil menghapus data $this->halaman";

        //nilai  untuk setting pesan jika berhasil menyimpan data
        $this->successStore  = "Berhasil menambah data $this->halaman";

        //nilai  untuk setting pesan jika berhasil mengedit data
        $this->successEdit   = "Berhasil mengedit data $this->halaman";

        //nilai untuk mendefinisikan nama inputan form untuk upload gambar
        $this->gambarInput = 'gambar';

        //nilai untuk mendefiniskan folder tempat dimana gambar akan diupload
        $this->gambarFolder = 'gambar/';

        //nilai untuk menyimpan url gambar
        $this->urlGambar = null;

        //nilai untuk menyimpan except data yang tidak harus diinput
        $this->except = ['_token', '_method'];

        //nilai untuk setting validasi di suatu controller
        $this->setValidateRules = [];

        //nilai untuk setting model suatu crud
        $this->model = null;

        //nilai untuk menyimpan controller
        $this->controller = new Controller();

        //nilai untuk redirect halaman setelah berhasil menyimpan data
        $this->redirectSetStore = view($this->halamanIndex);

        //nilai untuk redirect halaman setelah berhasil update
        $this->redirectSetUpdate = back();

        //nilai untuk redirect halaman setelah berhasil menghapus
        $this->redirectSetDestroy = back();
    }

    public function setIndex()
    {
        $this->indexDatas = $this->model->paginate($this->paginate);
        return view($this->halamanIndex, [$this->datas => $this->indexDatas]);
    }

    public function setCreate()
    {
        return view($this->halamanCreate);
    }

    public function setStore($request)
    {
        //simpan data inputan ke variable agar dapat diubah isinya
        $dataRequest = $request->all();

        //cek jika input mempunyai gambar
        if($request->has($this->gambarInput))
        {
            $this->urlGambar = $request->file($this->gambarInput)->move($this->gambarFolder, $dataRequest[$this->gambarInput]->getClientOriginalName());

            //ubah nilai bawaan gambar jika ada
            $dataRequest[$this->gambarInput] = $this->urlGambar;
        }

        $this->controller->validate($request, $this->setValidateRules);
        $this->model->create($dataRequest)->save();

        return $this->redirectSetStore->with($this->success, $this->successStore);
    }

    public function setEdit($modelId)
    {
        return view($this->halamanEdit, [$this->data => $modelId]);
    }

    public function setUpdate($request, $modelId)
    {
        //simpan data inputan ke variable agar dapat diubah isinya
        $dataRequest = $request->all();

        //cek jika input mempunyai gambar
        if($request->has($this->gambarInput))
        {
            $this->urlGambar = $request->file($this->gambarInput)->move($this->gambarFolder, $dataRequest[$this->gambarInput]->getClientOriginalName());

            //ubah nilai bawaan gambar jika ada
            $dataRequest[$this->gambarInput] = $this->urlGambar;
        }

        $this->controller->validate($request, $this->setValidateRules);

        //buang data yang mengandung excep input
        $dataRequest = array_diff_key($dataRequest, array_flip($this->except));

        //update datanya setelah diedit
        $this->model->findOrFail($modelId->id)->update($dataRequest);

        //kembali ke halaman edit
        return $this->redirectSetUpdate->with($this->success, $this->successEdit);
    }

    public function setDestroy($modelId)
    {
        //cari barang dengan id
        $this->model->findOrFail($modelId->id)->delete();

        return $this->redirectSetDestroy->with($this->success, $this->successDelete);
    }

}

<?php

namespace App\Settingan;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

class Settingan extends Model
{
    public function __construct($halaman, $model)
    {
        //default value untuk barang
        $this->halaman            = $halaman;

        //nilai untuk setting model suatu crud
        $this->model              = $model;

        //nilai untuk menyimpan controller
        $this->controller         = new Controller();

        //nilai untuk setting pagination setiap halaman dari kumpulan data
        $this->paginate           = 10;

        //nilai untuk setting halaman create data
        $this->halamanCreate      = "$this->halaman.create";

        //nilai untuk halaman index
        $this->halamanIndex       = "$this->halaman.index";

        //nilai untuk halaman menampilkan sebuah data secara spesifik
        $this->halamanShow        = "$this->halaman.show";

        //nilai untuk halaman edit
        $this->halamanEdit        = "$this->halaman.edit";

        //nilai untuk mengoper banyak data dari suatu halaman
        $this->datas              = "{$this->halaman}s";

        //nilai untuk mengoper satu data dari sebuah halamn
        $this->data               = $this->halaman;

        //data pesan success
        $this->success            = 'success';

        //data pesan errorr
        $this->error              = 'errorr';

        //nilai untuk setting pesan jika berhasil menghapus data
        $this->successDelete      = "Berhasil menghapus data $this->halaman";

        //nilai untuk setting pesan jika berhasil menyimpan data
        $this->successStore       = "Berhasil menambah data $this->halaman";

        //nilai untuk setting pesan jika berhasil mengedit data
        $this->successEdit        = "Berhasil mengedit data $this->halaman";

        //nilai untuk mendefinisikan nama inputan form untuk upload gambar
        $this->gambarInput        = 'gambar';

        //nilai untuk mendefiniskan folder tempat dimana gambar akan diupload
        $this->gambarFolder       = 'gambar/';


        //nilai untuk setting dimana folder root gambar
        $this->gambarIndexAt = '\\';

        //nilai untuk setting penyimpanan data dari semua gambar input multiple berupa array
        $this->gambarData = null;

        //nilai untuk menyimpan url gambar
        $this->urlGambar          = null;

        //nilai untuk menyimpan url gambar ke database
        $this->urlGambarDb          = 'url';

        //nilai untuk menentukan nama input upload untuk validasi
        $this->maxGambarUploadName = 'maxGambarUpload';

        //nilai untuk menentukan seberapa banyak gambar yang boleh di upload
        $this->maxGambarUploadValue = 2;

        //rules max gambar upload
        $this->maxGambarUploadValidate = "max:$this->maxGambarUploadValue";

        //nilai untuk menyimpan except data yang tidak harus diinput
        $this->except             = ['_token', '_method'];

        //nilai untuk setting validasi di suatu controller
        $this->setValidateRules   = null;

        //nilai untuk redirect halaman setelah berhasil create data
        $this->redirectSetStore   = view($this->halamanIndex, [$this->datas => $this->model->paginate($this->paginate)]);

        //nilai untuk redirect halaman setelah berhasil update data
        $this->redirectSetUpdate  = back();

        //nilai untuk redirect halaman setelah berhasil menghapus data
        $this->redirectSetDestroy = back();


    }

    //untuk mengantisipasi error has no effect pada array atau object yang tidak didefinisikan
    public function __Set($attribute, $value)
    {
        return $this->$attribute = $value;
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


        //validate harus di paling atas agar form validasi gambar berhasil
        $this->controller->validate($request, $this->setValidateRules);

        //simpan data inputan ke variable agar dapat diubah isinya
        $dataRequest = $request->all();

        //cek jika input mempunyai gambar
        if($request->has($this->gambarInput))
        {
            //lakukan perulangan untuk menyimpan gambar ke folder dan ke database
            foreach($request[$this->gambarInput] as $key => $value)
            {
                //simpan gambar di lokasi dan dapatkan string lokasinya
                $this->urlGambar = $this->gambarIndexAt . $request->file($this->gambarInput)[$key]->move($this->gambarFolder, $dataRequest[$this->gambarInput][$key]->getClientOriginalName());

                //simpan setiap lokasi gambarnya
                $this->gambarData[$this->urlGambarDb][] = $this->urlGambar;
            }

            //ubah nilai bawaan gambar menjadi json dan buang double backslashnya jika ada
            $dataRequest[$this->gambarInput] = str_replace('\\\\', '\\',  json_encode($this->gambarData));
        }

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

        $this->setValidateRules[$this->maxGambarUploadName] = $this->maxGambarUploadValidate;

        //perulangan untuk mengisi agar nilai validasi gambar upload jadi true
        if(count($dataRequest[$this->gambarInput]) > $this->maxGambarUploadValue){
            for($a = 0; $a < $this->maxGambarUploadValue; $a++)
            {
                $request[$this->maxGambarUploadName][] = array();
            }
        }

        dd($request->file($this->gambarInput));

        //validate harus sebelum penyimpanan gambar agar form validasi gambar berhasil
        $this->controller->validate($request, $this->setValidateRules);


        //cek jika input mempunyai gambar
        if($request->has($this->gambarInput))
        {
            //lakukan perulangan untuk menyimpan gambar ke folder dan ke database
            foreach($request[$this->gambarInput] as $key => $value)
            {
                //simpan gambar di lokasi dan dapatkan string lokasinya
                $this->urlGambar = $this->gambarIndexAt . $request->file($this->gambarInput)[$key]->move($this->gambarFolder, $dataRequest[$this->gambarInput][$key]->getClientOriginalName());

                //simpan setiap lokasi gambarnya
                $this->gambarData[$this->urlGambarDb][] = $this->urlGambar;
            }

            //ubah nilai bawaan gambar menjadi json dan buang double backslashnya jika ada
            $dataRequest[$this->gambarInput] = str_replace('\\\\', '\\',  json_encode($this->gambarData));
        }

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

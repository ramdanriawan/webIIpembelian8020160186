<?php

namespace App\Settingan;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

class Settingan extends Model
{
    public function __construct($halaman, $model)
    {
        //nilai untuk setting validasi di suatu controller
        $this->setValidateRules = [
            //untuk form barang
            'barang' => [
                'nama' => 'required|min:2|max:50|alpha_num|present:alpha', //alpha sebagai penanda saja untuk pembuangan spasi pada method setValidate();
                'harga_jual' => 'required|numeric|digits_between:3,8|min:500|max:10000000',
                'stok' => 'required|numeric|digits_between:1,4|min:1|max:1000',
                'gambar' => 'max:5',
                'gambar.*' => 'required|mimes:jpg,png,jpeg,gif|max:1000',
            ],
            //untuk form pelanggan
            'pelanggan' => [
                'nama' => 'required|min:2|max:50|alpha|present:alpha', //alpha sebagai penanda saja untuk pembuangan spasi pada method setValidate();
                'alamat' => 'required|min:30|max:255|present:address|regex:/[a-zA-Z0-9\.\,]/' //address sebagai penanda saja untuk pembuangan spasi pada method setValidate();
                ]
        ];

        //digunakan untuk memvalidasi data yang menggunakan banyak spasi misalnya data nama dan address users
        $this->setValidateSpaces = ['alpha', 'address'];

        //default value untuk barang
        $this->halaman            = $halaman;

        //nilai untuk setting model suatu crud
        $this->model              = $model;

        //nilai untuk menyimpan controller
        $this->controller         = new Controller();

        //nilai untuk setting pagination setiap halaman dari kumpulan data
        $this->paginate           = 0;

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
        $this->successDelete      = "Berhasil menghapus data $this->halaman {$this->model->nama}";

        //nilai untuk setting pesan jika berhasil menyimpan data
        $this->successStore       = "Berhasil menambah data $this->halaman {$this->model->nama}";

        //nilai untuk setting pesan jika berhasil mengedit data
        $this->successEdit        = "Berhasil mengedit data $this->halaman {$this->model->nama}";

        //nilai untuk mendefinisikan nama inputan form untuk upload gambar
        $this->gambarInput        = 'gambar';

        //nilai untuk mendefiniskan folder tempat dimana gambar akan diupload
        $this->gambarFolder       = 'gambar/';

        //nilai untuk mengganti slash pada url
        $this->slashUrl = '/';

        //nilai untuk setting dimana folder root gambar
        $this->gambarIndexAt = '\\';

        //nilai untuk setting penyimpanan data dari semua gambar input multiple berupa array
        $this->gambarData = null;

        //nilai untuk menyimpan url gambar
        $this->urlGambar          = null;

        //nilai untuk menyimpan url gambar ke database
        $this->urlGambarDb          = 'url';

        //nilai untuk menyimpan except data yang tidak harus diinput
        $this->except             = ['_token', '_method'];

        //variabel untuk menyimpan nilai dari model yang akan dioper ke view
        $this->indexDatas = null;

        //variabel untuk menyimpan nilai dari tambahan user yang akan dioper ke view
        $this->allData = [];

        //nilai untuk redirect halaman setelah berhasil create data
        $this->redirectSetStore   = redirect()->route("$halaman.index");

        //nilai untuk redirect halaman setelah berhasil update data
        $this->redirectSetUpdate  = back();#halaman index

        //nilai untuk redirect halaman setelah berhasil menghapus data
        $this->redirectSetDestroy = back();#->halaman index


    }

    //untuk mengantisipasi error has no effect pada array atau object yang tidak didefinisikan
    public function __Set($attribute, $value)
    {
        return $this->$attribute = $value;
    }

    public function __get($attribute)
    {
        return $this->$attribute;
    }

    public function setIndex()
    {
        $this->indexDatas = $this->model->paginate($this->paginate);

        $this->allData[$this->datas] = $this->indexDatas;

        return view($this->halamanIndex, $this->allData);
    }

    public function setCreate()
    {
        return view($this->halamanCreate, $this->allData);
    }

    public function setStore($request)
    {
        //validasi input
        $request = $this->setValidate($request);

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
            $dataRequest[$this->gambarInput] = str_replace('\\\\', $this->slashUrl,  json_encode($this->gambarData));
        }

        $this->model->create($dataRequest)->save();

        return $this->redirectSetStore->with($this->success, $this->successStore);
    }

    public function setEdit($modelId)
    {
        $this->allData[$this->data] = $modelId;
        return view($this->halamanEdit, $this->allData);
    }

    public function setUpdate($request, $modelId)
    {
        $request = $this->setValidate($request);

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

            //ubah nilai bawaan gambar menjadi json dan buang double backslashnya supaya bisa diinput ke database
            $dataRequest[$this->gambarInput] = str_replace('\\\\', $this->slashUrl,  json_encode($this->gambarData));
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

    public function setValidate($request)
    {

        //variabel sementara untuk menampung nilai request yang akan berubah (null supaya gak ikut ikutan sama $request kalo request berubah dia gak akan berubah)
        $requestTemp = null;

        //perulangan untuk memvalidasi input yang memiliki rules alpha (membuang semua spasi)
        foreach ($this->setValidateSpaces as $key => $value) {
            //buang satu persatu space berdasarkan halaman dari controllernya
            foreach ($this->setValidateRules[$this->halaman] as $key2 => $value2) {
                if(strpos($value2, $value))
                {
                    $requestTemp[$key2] = $request[$key2];
                    $request[$key2] = str_replace(' ', '', $request[$key2]);
                }
            }
        }


        //validate harus sebelum penyimpanan gambar agar form validasi gambar berhasil
         $this->controller->validate($request, $this->setValidateRules[$this->halaman]);

        foreach ($this->setValidateSpaces as $key => $value) {
            //buang satu persatu space berdasarkan halaman dari controllernya
            foreach ($this->setValidateRules[$this->halaman] as $key2 => $value2) {
                if(strpos($value2, $value))
                {
                    $request[$key2] = preg_replace('/\s\s+/', ' ', $requestTemp[$key2]);
                }
            }
        }
        // dd($request);

        return $request;
    }

}

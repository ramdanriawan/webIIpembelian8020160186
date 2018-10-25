@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah data barang</div>
                <div class="card-body">

                    @include('layouts.partials.errors')
                    @include('layouts.partials.success')

                    <form action='/admin/barang/{{$barang->id}}' method='post' enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label for="nama">Nama*</label>
                            <input class="form-control" type="text" name="nama" value="{{$barang->nama}}" placeholder="nama" required>
                            @if($errors->has('nama'))
                            <p class="alert alert-danger">{{$errors->first('nama')}}</p>
                            @endif;
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual*</label>
                            <input class="form-control" type="number" name="harga_jual" value="{{$barang->harga_jual}}" placeholder="Harga Jual" required>
                            @if($errors->has('harga_jual'))
                            <p class="alert alert-danger">{{$errors->first('harga_jual')}}</p>
                            @endif;
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok*</label>
                            <input class="form-control" type="number" name="stok" value="{{$barang->stok}}" placeholder="Stok" required>
                            @if($errors->has('stok'))
                            <p class="alert alert-danger">{{$errors->first('stok')}}</p>
                            @endif;
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar*</label>
                            <input class="form-control" type="file" name="gambar" value="{{$barang->gambar}}" placeholder="Stok" required>
                            @if($errors->has('gambar'))
                            <p class="alert alert-danger">{{$errors->first('gambar')}}</p>
                            @endif;
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Simpan data barang
                        </button>
                        <button type="reset" class="btn btn-danger"
                                onclick='
                                    if(!confirm("Apakah anda yakin akan mereset data ini?"))
                                    {
                                        return false;
                                    }
                                '
                        >
                            Reset
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

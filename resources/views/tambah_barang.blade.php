@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                @elseif (count($errors) > 0)
                    <div class="alert alert-success">
                        <li>Mohon periksa kembali inputan anda</li>
                    </div>
                @endif
                <div class="card-header">Tambah data barang</div>
                <div class="card-body">
                    <form action='/admin/barang/store' method='post'>
                        {{csrf_field()}}
                        <div class="form-group">
                            @if(count($errors) > 0)
                                <li class='alert alert-danger'>Mohon periksa kembali inputan anda</li>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama*</label>
                            <input class="form-control" type="text" name="nama" value="{{old('nama')}}" placeholder="nama" required>
                            @if($errors->has('nama'))
                            <p class="alert alert-danger">{{$errors->first('nama')}}</p>
                            @endif;
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual</label>
                            <input class="form-control" type="number" name="harga_jual" value="{{old('harga_jual')}}" placeholder="Harga Jual" required min='0'>
                            @if($errors->has('harga_jual'))
                                <p class="alert alert-danger">{{$errors->first('harga_jual')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok Barang</label>
                            <input  class="form-control" type="number" name="stok" value="{{old('stok')}}" placeholder="Stok Barang" required min='0' step='1'>
                            @if($errors->has('stok'))
                                <p class="alert alert-danger">{{$errors->first('stok')}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar*</label>
                            <input class="form-control" type="text" name="gambar" value="{{old('gambar')}}" placeholder="gambar" required placeholder="gambar/gambar.jpg">
                            @if($errors->has('gambar'))
                                <p class="alert alert-danger">{{$errors->first('gambar')}}</p>
                            @endif;
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan data Barang
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$judul}}</div>
                <div class="card-body">

                    @include('layouts.partials.errors')
                    @include('layouts.partials.success')

                    <form action='/admin/barang/{{$barang->id}}' method='post' enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label for="nama">Nama*</label>
                            <input class="form-control {{$errors->has('nama') ? 'is-invalid': ''}}" type="text" name="nama" value="{{$barang->nama}}" placeholder="nama" required>
                            @if($errors->has('nama'))
                            <p class="text-danger">{{$errors->first('nama')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual*</label>
                            <input class="form-control {{$errors->has('harga_jual') ? 'is-invalid': ''}}" type="number" name="harga_jual" value="{{$barang->harga_jual}}" placeholder="Harga Jual" required>
                            @if($errors->has('harga_jual'))
                            <p class="text-danger">{{$errors->first('harga_jual')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok*</label>
                            <input class="form-control  {{$errors->has('stok') ? 'is-invalid': ''}}" type="number" name="stok" value="{{$barang->stok}}" placeholder="Stok" required>
                            @if($errors->has('stok'))
                            <p class="text-danger">{{$errors->first('stok')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar (tandai beberapa sekaligus), max:5</label>
                            <input class="form-control  {{$errors->has('gambar') || $errors->has('gambar.*') ? 'is-invalid': ''}}" type="file" name="gambar[]" required multiple>
                            @if($errors->has('gambar.*'))
                            <p class="text-danger">{{$errors->first('gambar.*')}}</p>
                            <p class="text-danger">{{$errors->first('gambar')}}</p>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">
                            Simpan data barang
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm"
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

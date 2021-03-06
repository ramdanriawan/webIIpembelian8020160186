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

                    <form action='/admin/pelanggan/{{$pelanggan->id}}' method='post'>
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label for="nama">Nama*</label>
                            <input class="form-control" type="text" name="nama" value="{{$pelanggan->nama}}" placeholder="nama" required>
                            @if($errors->has('nama'))
                            <p class="text-danger" id='textdanger'>{{$errors->first('nama')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name='alamat' placeholder="Alamat lengkap" required>{{$pelanggan->alamat}}</textarea>
                            @if($errors->has('alamat'))
                            <p class="text-danger">{{$errors->first('alamat')}}</p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Simpan data pelanggan
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

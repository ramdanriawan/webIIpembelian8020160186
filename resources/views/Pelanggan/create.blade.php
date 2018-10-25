@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah data pelanggan</div>
                <div class="card-body">
                    
                    @include('layouts.partials.errors')
                    @include('layouts.partials.success')

                    <form action='/admin/pelanggan' method='post'>
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="nama">Nama*</label>
                            <input class="form-control" type="text" name="nama" value="{{old('nama')}}" placeholder="nama" required>
                            @if($errors->has('nama'))
                            <p class="alert alert-danger">{{$errors->first('nama')}}</p>
                            @endif;
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name='alamat' placeholder="Alamat lengkap" required> {{old('alamat')}}
                            </textarea>
                            @if($errors->has('alamat'))
                            <p class="alert alert-danger">{{$errors->first('alamat')}}</p>
                            @endif;
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan data pelanggan
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

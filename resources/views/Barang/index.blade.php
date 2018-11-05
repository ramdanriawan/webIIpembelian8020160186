@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')


                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class='card-title'>{{$judul}}</h4>
                        </div>
                        <div class="col-6">
                            <span class="float-right">
                                <button  id='loadBarang' class='btn btn-default btn-circle'>
                                    <i class='fas fa-sync fa-lg'></i>
                                </button>
                                <button  id='addBarang' class='btn btn-success btn-circle' data-toggle="modal" data-target="#addBarangModal">
                                    <i class='fas fa-plus-circle fa-lg'></i>
                                </button>
                                <button id='showBarang' class='btn btn-info btn-circle '>
                                    <i class='fas fa-eye fa-lg'></i>
                                </button>
                                <button  id='editBarang' class='btn btn-primary btn-circle'  data-toggle="modal" data-target="#editBarangModal">
                                    <i class='fas fa-edit fa-lg'></i>
                                </button>
                                <button id='removeBarang' class='btn btn-danger btn-circle '>
                                    <i class='fas fa-trash-alt fa-lg'></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive">
                   <table  id='dataTables' class="table table-bordered table-striped table-hover table-condensed table-sm">
                       <thead style='cursor:pointer;'>
                           <tr>
                               <th class="select-checkbox sorting_1"></th>
                               <th>No</th>
                               <th class='sort' data-sort='nama'>Nama</th>
                               <th class='sort' data-sort='harga_jual'>Harga Jual</th>
                               <th class='sort' data-sort='stok'>Stok</th>
                               <th>Gambar</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                         @foreach($barangs as $barang)
                           <tr>
                                <td></td>
                               <th class='text-center'>{{ $loop->iteration }}</th>
                               <td data-nama='{{ $barang->nama }}'><a href="/admin/barang/{{$barang->id}}">{{ $barang->nama }}</a></td>
                               <td data-harga-jual='{{ $barang->harga_jual }}' class='tdHargaJual'>{{ $barang->harga_jual }}</td>
                               <td data-stok='{{ $barang->stok }}' class='tdStok'>{{ $barang->stok }}</td>
                               <td>
                                   <button
                                    class="btn btn-default btn-sm btn-gambar"
                                    data-toggle="modal"
                                    data-target="#gambarModal"
                                    data-local='#carousel-generic'
                                    data-link='{{$barang->gambar}}'
                                    data-gambar-nama='{{$barang->nama}}' >
                                       <i class="far fa-eye"></i> Show
                                   </button>
                               </td>
                               <td>
                                   <span class="btn-group btn-group-sm">
                                       <a href='/admin/barang/{{$barang->id}}/edit' class="btn btn-primary btn-sm">
                                           <i class="far fa-edit"></i>
                                       </a>
                                       <form id='formDelete' action='/admin/barang/{{$barang->id}}' method='post'>
                                           {{csrf_field()}}
                                           <input type="hidden" name="_method" value="DELETE">
                                       </form>
                                       <button form='formDelete' class='btn btn-danger btn-sm btn-delete' type='submit' data-token='{{csrf_token()}}' data-nama='{{$barang->nama}}'> <i class="far fa-trash-alt"></i>

                                   </button>

                                   </span>

                               </td>
                           </tr>
                         @endforeach
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{--  ini adalah modal untuk menampilkan gambar --}}
<div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Gambar untuk <span id="dataGambarNama"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
          <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
              <li data-target="#demo" data-slide-to="0" class="active"></li>
              <li data-target="#demo" data-slide-to="1"></li>
              <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner" id='gambarItem'>
                {{--  nanti itemnya akan muncul disini --}}
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>

          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{--  ini adalah modal untuk menambah barang --}}
<div id="addBarangModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card">
                <div class="card-header">Tambah Barang</div>
                <div class="card-body">

                    @include('layouts.partials.errors')
                    @include('layouts.partials.success')

                    <form action='/admin/barang' method='post' enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="nama">Nama*</label>
                            <input class="form-control {{$errors->has('nama') ? 'is-invalid': ''}}" type="text" name="nama" value="{{old('nama')}}" placeholder="nama" required>
                            @if($errors->has('nama'))
                            <p class="text-danger">{{$errors->first('nama')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual*</label>
                            <input class="form-control {{$errors->has('harga_jual') ? 'is-invalid': ''}}" type="number" name="harga_jual" value="{{old('harga_jual')}}" placeholder="Harga Jual" required>
                            @if($errors->has('harga_jual'))
                            <p class="text-danger">{{$errors->first('harga_jual')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok*</label>
                            <input class="form-control  {{$errors->has('stok') ? 'is-invalid': ''}}" type="number" name="stok" value="{{old('stok')}}" placeholder="Stok" required>
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
</div>

{{--  ini adalah modal untuk edit barang --}}
<div id="editBarangModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
                <div class="card">
                    <div class="card-header">Edit Barang</div>
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
</div>



@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')


                <div class="card-header">{{$judul}}</div>
                {{-- <button id='hapussemua'>hapus</button> --}}

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
                                <td>{{ $loop->iteration }}</td>
                               <td><a href="/admin/barang/{{$barang->id}}">{{ $barang->nama }}</a></td>
                               <td>{{ $barang->harga_jual }}</td>
                               <td>{{ $barang->stok }}</td>
                               <td>
                                   <button class="btn btn-default btn-sm btn-gambar" data-toggle="modal"
                                    data-target="#gambarModal"
                                    data-local='#carousel-generic'
                                    data-link="{{$barang->gambar}}" data-gambar-nama='{{$barang->nama}}' >
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
                {{ $barangs->links() }}
            </div>
        </div>
    </div>
</div>


{{--  ini adalah modal --}}
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



@endsection

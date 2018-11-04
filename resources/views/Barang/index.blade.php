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
                                <button  id='addBarang' class='btn btn-success btn-circle'>
                                    <i class='fas fa-plus-circle fa-lg'></i>
                                </button>
                                <button id='showBarang' class='btn btn-info btn-circle '>
                                    <i class='fas fa-eye fa-lg'></i>
                                </button>
                                <button  id='editBarang' class='btn btn-primary btn-circle'>
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
                               <td><a href="/admin/barang/{{$barang->id}}">{{ $barang->nama }}</a></td>
                               <td class='tdHargaJual'>{{ $barang->harga_jual }}</td>
                               <td class='tdStok'>{{ $barang->stok }}</td>
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')


                <div class="card-header">Data Barang</div>

                <div class="card-body">
                   <table class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Nama</th>
                               <th>Harga Jual</th>
                               <th>Stok</th>
                               <th>Gambar</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                         @foreach($barangs as $barang)
                           <tr>
                                <td>{{ $loop->iteration }}</td>
                               <td>{{ $barang->nama }}</td>
                               <td>{{ $barang->harga_jual }}</td>
                               <td>{{ $barang->stok }}</td>
                               <td><a href='{{ $barang->gambar }}'>{{$barang->gambar}}</a></td>
                               <td>
                                   <a href='/admin/barang/{{$barang->id}}/edit' class="btn btn-primary btn-sm">
                                       Edit
                                   </a>
                                   <form id='formDelete' action='/admin/barang/{{$barang->id}}' method='post'>
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                   </form>
                                   <button form='formDelete' class='btn btn-danger btn-sm' type='submit'
                                   onclick='
                                   if(!confirm("Hapus data {{$barang->nama}} ?")){
                                       return false
                                   }

                                   '
                                   >
                                   DELETE
                               </button>

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
@endsection

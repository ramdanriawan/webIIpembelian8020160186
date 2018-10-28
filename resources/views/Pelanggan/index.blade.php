@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @include('layouts.partials.errors')
                @include('layouts.partials.success')


                <div class="card-header">{{$judul}}</div>

                <div class="card-body">
                   <table class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Nama</th>
                               <th>Alamat</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                         @foreach($pelanggans as $pelanggan)
                           <tr>
                                <td>{{ $loop->iteration }}</td>
                               <td>{{ $pelanggan->nama }}</td>
                               <td>{{ $pelanggan->alamat }}</td>
                               <td>
                                   <a href='/admin/pelanggan/{{$pelanggan->id}}/edit' class="btn btn-primary btn-sm">
                                       Edit
                                   </a>
                                   <form id='formDelete' action='/admin/pelanggan/{{$pelanggan->id}}' method='post'>
                                       {{csrf_field()}}
                                       <input type="hidden" name="_method" value="DELETE">
                                   </form>
                                   <button form='formDelete' class='btn btn-danger btn-sm' type='submit'
                                   onclick='
                                   if(!confirm("Hapus data {{$pelanggan->nama}} ?")){
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
                {{ $pelanggans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

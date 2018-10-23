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
                @endif

                <div class="card-header">{{ $judul }}</div>

                <div class="card-body">
                   <table class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <th>No</th>
                               <th>Nama</th>
                               <th>Harga Jual</th>
                               <th>Stok</th>
                               <th>Gambar</th>
                           </tr>
                       </thead>
                       <tbody>
                         @foreach($barangs as $barang)
                           <tr>
                               <td>{{ $loop->iteration }}</td>
                               <td>{{ $barang->nama }}</td>
                               <td>{{ $barang->harga_jual }}</td>
                               <td>{{ $barang->stok }}</td>
                               <td><a href='{{asset($barang->gambar)}}'>{{ $barang->gambar }}</a></td>
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

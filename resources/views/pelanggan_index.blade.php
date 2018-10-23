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
                               <th>Alamat</th>
                           </tr>
                       </thead>
                       <tbody>
                         @foreach($pelanggans as $pelanggan)
                           <tr>
                                <td>{{ $loop->iteration }}</td>
                               <td>{{ $pelanggan->nama }}</td>
                               <td>{{ $pelanggan->alamat }}</td>
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

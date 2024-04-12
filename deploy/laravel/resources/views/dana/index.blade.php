@extends('layout.main')


@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">Sumber Dana</h1>

<div class="row">
    <div class="col-lg-4 col-sm-6">
        <form action="/dana" method="post" autocomplete="off">
            @csrf
            <div class="input-group mb-4">
                <input type="text" class="form-control mr-2" name="nama" id="nama" placeholder="Tambah Sumber Dana">
                <button class="btn btn-dark" type="submit" id="button-addon2">Simpan</button>
            </div>
        </form>
    </div>
</div>


@if (session()->has('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
@endif
@if (session()->has('gagal'))
    <div class="alert alert-danger" role="alert">
        {{ session('gagal') }} Periksaa <a href="/transaksi/history">Riwayat Transaksi</a> dan coba lagi.
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow mb-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Sumber Dana</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($dana as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align:left ;">{{ $data->nama }}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{ $data->id }}"><span><i class="fa fa-pencil"></i></span></a>
                                    </td>
                                </tr>
        
                                <div class="modal fade" id="edit-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="/dana/{{ $data->id }}" method="post" autocomplete="off">
                                                @method('put')
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-pencil-square-o"></i></span>
                                                        <input required class="form-control" type="text" name="nama" id="nama" value="{{ $data->nama }}" placeholder="Masukkan Sumber Dana">
                                                    </div>
                                                <div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary mr-0" type="submit">Lanjutkan</button>
                                                    </form>
                                                    <form action="/dana/{{ $data->id }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger ml-0">Hapus</button>
                                                    </form>                                           
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
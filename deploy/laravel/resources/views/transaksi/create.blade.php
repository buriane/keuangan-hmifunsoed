@extends('layout.main')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800 text-center">Tambah Transaksi</h1>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow mb-5">
            <div class="card-body">
                <form method="post" action="/transaksi" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-8">
                            <label for="keterangan">Keterangan</label>
                            <select class="form-control form-control-user" name="keterangan" id="keterangan" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="Pemasukan">Pemasukan</option>
                                <option value="Pengeluaran">Pengeluaran</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail">Detail Transaksi</label>
                        <input type="text" class="form-control form-control-user" id="detail" name="detail" placeholder="Masukkan Detail Transaksi" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="dana_id">Sumber Dana</label>
                            <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($dana as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="nominal">Nominal</label>
                            <input type="number" class="form-control form-control-user" id="nominal" name="nominal" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
                    <div class="form-group text-center my-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection
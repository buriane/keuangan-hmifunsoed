@extends('layout.main')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800 text-center">Perbarui Transaksi</h1>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow mb-5">
            <div class="card-body">
                <form method="post" action="/transaksi/{{ $transaksi->id }}" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" value="{{ $transaksi->tanggal }}" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-8">
                            <label for="keterangan">Keterangan</label>
                            <select class="form-control form-control-user" name="keterangan" id="keterangan" required>
                                <option {{ ($transaksi->keterangan == 'Pemasukan') ? 'selected' : '' }} value="Pemasukan">Pemasukan</option>
                                <option {{ ($transaksi->keterangan == 'Pengeluaran') ? 'selected' : '' }} value="Pengeluaran">Pengeluaran</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail">Detail Transaksi</label>
                        <input type="text" class="form-control form-control-user" value="{{ $transaksi->detail }}" id="detail" name="detail" placeholder="Masukkan Detail Transaksi" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="dana_id">Sumber Dana</label>
                            <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                @foreach ($dana as $data)
                                    <option {{ ($transaksi->dana->nama == $data->nama) ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="nominal">Nominal</label>
                            <input type="number" class="form-control form-control-user" value="{{ $transaksi->nominal }}" id="nominal" name="nominal" placeholder="Masukkan Nominal" required>
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
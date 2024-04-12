@extends('layout.main')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800 text-center">Tambah Data Pengurangan Deposit</h1>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow mb-5">
            <div class="card-body">
                <form method="post" action="/deposit" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-8">
                            <label for="dana_id">Nama Pengurus</label>
                            <select class="deposit_id form-control form-control-user" name="deposit_id" id="deposit_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($divisi as $div)
                                    <?php $d = $nama->where('divisi', $div->divisi) ?>
                                    <option value="" class="font-weight-bold" disabled>{{ $div->divisi }}</option>
                                    @foreach ($d as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="keterangan">Keterangan</label>
                            <select class="form-control form-control-user" name="keterangan" id="keterangan" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="Tidak mengikuti rapat pleno">Tidak mengikuti rapat pleno</option>
                                <option value="Terlambat mengikuti rapat pleno">Terlambat mengikuti rapat pleno</option>
                                <option value="Tidak menggunakan jahim ketika jahim day">Tidak menggunakan jahim ketika jahim day</option>
                                <option value="Tidak mengikuti wisuda offline">Tidak mengikuti wisuda offline</option>
                                <option value="Tidak mengikuti piket pesek">Tidak mengikuti piket pesek</option>
                                <option value="Tidak ada kabar saat menjalankan proker">Tidak ada kabar saat menjalankan proker</option>
                                <option value="Lainya">Lainya</option>
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
@extends('layout.main')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800 text-center">Tambah Data</h1>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary text-center">Pemasukan Divisi Kreasi dan Usaha</h5>
            </div>
            <div class="card-body">
                <form method="post" action="/laporan-kreus" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <input type="text" name="kategori" id="kategori" value="Pemasukan" hidden>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="bulan">Bulan</label>
                            <select class="form-control form-control-user" name="bulan" id="bulan" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <label for="proker">Program Kerja</label>
                            <input type="text" class="form-control form-control-user" id="proker" name="proker" placeholder="Masukkan Program Kerja" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="sumber">Sumber Dana</label>
                            <input type="text" class="form-control form-control-user" id="sumber" name="sumber" placeholder="Masukkan Sumber Dana" required>
                        </div>
                        <div class="col-sm-5">
                            <label for="pemasukan">Nominal</label>
                            <input type="number" class="form-control form-control-user" id="pemasukan" name="pemasukan" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pj">Penanggung Jawab</label>
                        <input type="text" class="form-control form-control-user" id="pj" name="pj" placeholder="Masukkan Penanggung Jawab" required>
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
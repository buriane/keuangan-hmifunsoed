@extends('layout.add')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800 text-center">Tambah Data Pembayaran Uang Kas</h1>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow mb-5">
            <div class="card-body">
                <form method="post" action="/kas" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="dana_id">Media</label>
                            <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                <option value="" selected hidden>Pilih</option>
                                @foreach ($dana as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="dana_id">Nama Pengurus</label>
                            <select class="deposit_id form-control form-control-user" name="kas_id" id="kas_id" required>
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
                            <label for="bulan">Bulan</label>
                            <select class="form-control form-control-user" name="bulan-1" id="bulan-1" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="nominal">Denda</label>
                            <select class="form-control form-control-user" name="nominal-1" id="nominal-1" required>
                                <option selected value="15000">Tidak</option>
                                <option value="17000">2.000</option>
                                <option value="19000">4.000</option>
                                <option value="21000">6.000</option>
                                <option value="23000">8.000</option>
                                <option value="25000">10.000</option>
                                <option value="27000">12.000</option>
                                <option value="29000">14.000</option>
                                <option value="31000">16.000</option>
                                <option value="33000">18.000</option>
                            </select>
                        </div>
                    </div>
                    <div id='setB'></div>
                    <div class="form-group text-center my-4">
                        <a href="#up" class="DEL btn btn-danger">x</a>
                        <a href="#up" id="ADD" class="btn btn-secondary">+</a>
                    </div>
                    <div class="form-group text-center my-4">
                        <button id="up" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection


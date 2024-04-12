@extends('layout.main')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800 text-center">Perbarui Data Pembayaran Uang Kas</h1>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow mb-5">
            <div class="card-body">
                <form method="post" action="/kas/{{ $edit->id }}" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control form-control-user" value="{{ $edit->tanggal }}" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="dana_id">Media</label>
                            <select class="form-control form-control-user" name="dana_id" id="dana_id" required>
                                @foreach ($dana as $data)
                                    <option {{ ($edit->dana_id == $data->id) ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="dana_id">Nama Pengurus</label>
                            <input type="text" disabled value="{{ $edit->kas->nama }}" class="deposit_id form-control form-control-user" required>
                            <input type="text" hidden value="{{ $edit->kas_id }}" name="kas_id" id="kas_id" class="deposit_id form-control form-control-user" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="bulan">Bulan</label>
                            <select class="form-control form-control-user" name="bulan" id="bulan" required>
                                <option {{ ($edit->bulan == 'April') ? 'selected' : '' }} value="April">April</option>
                                <option {{ ($edit->bulan == 'Mei') ? 'selected' : '' }} value="Mei">Mei</option>
                                <option {{ ($edit->bulan == 'Juni') ? 'selected' : '' }} value="Juni">Juni</option>
                                <option {{ ($edit->bulan == 'Juli') ? 'selected' : '' }} value="Juli">Juli</option>
                                <option {{ ($edit->bulan == 'Agustus') ? 'selected' : '' }} value="Agustus">Agustus</option>
                                <option {{ ($edit->bulan == 'September') ? 'selected' : '' }} value="September">September</option>
                                <option {{ ($edit->bulan == 'Oktober') ? 'selected' : '' }} value="Oktober">Oktober</option>
                                <option {{ ($edit->bulan == 'November') ? 'selected' : '' }} value="November">November</option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <label for="nominal">Denda</label>
                            <select class="form-control form-control-user" name="nominal" id="nominal-1" required>
                                <option {{ ($edit->nominal == 15000) ? 'selected' : '' }} value="15000">Tidak</option>
                                <option {{ ($edit->nominal == 17000) ? 'selected' : '' }} value="17000">2.000</option>
                                <option {{ ($edit->nominal == 19000) ? 'selected' : '' }} value="19000">4.000</option>
                                <option {{ ($edit->nominal == 21000) ? 'selected' : '' }} value="21000">6.000</option>
                                <option {{ ($edit->nominal == 23000) ? 'selected' : '' }} value="23000">8.000</option>
                                <option {{ ($edit->nominal == 25000) ? 'selected' : '' }} value="25000">10.000</option>
                                <option {{ ($edit->nominal == 27000) ? 'selected' : '' }} value="27000">12.000</option>
                                <option {{ ($edit->nominal == 29000) ? 'selected' : '' }} value="29000">14.000</option>
                                <option {{ ($edit->nominal == 31000) ? 'selected' : '' }} value="31000">16.000</option>
                                <option {{ ($edit->nominal == 33000) ? 'selected' : '' }} value="33000">18.000</option>
                            </select>
                        </div>
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
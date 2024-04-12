@extends('layout.main')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800 text-center">Perbarui Data</h1>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary text-center">Pemasukan Divisi Kreasi dan Usaha</h5>
            </div>
            <div class="card-body">
                <form method="post" action="/laporan-kreus/{{ $data->id }}" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <input type="text" name="kategori" id="kategori" value="Pemasukan" hidden>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label for="bulan">Bulan</label>
                            <select class="form-control form-control-user" name="bulan" id="bulan" required>
                                <option value="1" {{ ($data->bulan === 1) ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ ($data->bulan === 2) ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ ($data->bulan === 3) ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ ($data->bulan === 4) ? 'selected' : '' }}>April</option>
                                <option value="5" {{ ($data->bulan === 5) ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ ($data->bulan === 6) ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ ($data->bulan === 7) ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ ($data->bulan === 8) ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ ($data->bulan === 9) ? 'selected' : '' }}>September</option>
                                <option value="10" {{ ($data->bulan === 10) ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ ($data->bulan === 11) ? 'selected' : '' }}>November</option>
                                <option value="12" {{ ($data->bulan === 12) ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <label for="proker">Program Kerja</label>
                            <input type="text" class="form-control form-control-user" id="proker" value="{{ $data->proker }}" name="proker" placeholder="Masukkan Program Kerja" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 mb-3 mb-sm-0">
                            <label for="sumber">Sumber Dana</label>
                            <input type="text" class="form-control form-control-user" id="sumber" value="{{ $data->sumber }}" name="sumber" placeholder="Masukkan Sumber Dana" required>
                        </div>
                        <div class="col-sm-5">
                            <label for="pemasukan">Nominal</label>
                            <input type="number" class="form-control form-control-user" id="pemasukan" value="{{ $data->pemasukan }}" name="pemasukan" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pj">Penanggung Jawab</label>
                        <input type="text" class="form-control form-control-user" id="pj" value="{{ $data->pj }}" name="pj" placeholder="Masukkan Penanggung Jawab" required>
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
@extends('layout.main')


@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-3 text-gray-800 text-center">Ubah Kata Sandi</h1>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow mb-5">
            <div class="card-body">
                <form method="post" action="/ubah-kata-sandi" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="lama">Kata Sandi Lama</label>
                            <input type="password" class="{{ (session('gagal1') != '') ? 'is-invalid' : '' }} form-control form-control-user" id="lama" name="lama" required>
                            @if (session()->has('gagal1'))
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ session('gagal1') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="baru">Kata Sandi Baru</label>
                            <input type="password" class="{{ (session('gagal2') != '') ? 'is-invalid' : '' }} @error('baru') is-invalid @enderror form-control form-control-user" id="baru" name="baru" required>
                            @error('baru')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Kata sandi baru minimal terdiri dari 8 karakter.
                            </div>
                            @enderror
                            @if (session()->has('gagal2'))
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ session('gagal2') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <label for="konfirmasi">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" class="{{ (session('gagal3') != '') ? 'is-invalid' : '' }} form-control form-control-user" id="konfirmasi" name="konfirmasi" required>
                            @if (session()->has('gagal2'))
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ session('gagal2') }}
                                </div>
                            @endif
                            @if (session()->has('gagal3'))
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ session('gagal3') }}
                                </div>
                            @endif
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
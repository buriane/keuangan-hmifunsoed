<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}">

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{asset('assets/css/sb-admin-2.css')}}" />

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="px-3 py-1 card-body">
                        <!-- Nested Row within Card Body -->
                        <div class="row align-items-center" style="height: 520px">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="height: 520px"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900"><b>Selamat Datang!</b></h1>
                                        <h1 class="h6 text-gray-900">Silahkan masuk untuk melanjutkan</h1>
                                        @if (session()->has('gagal'))
                                            <h1 class="h6 text-danger mt-3">
                                                {{ session('gagal') }}
                                            </h1>
                                        @endif
                                    </div>
                                    <form class="user" method="post" action="/login" autocomplete="off">
                                        @csrf
                                        <div class="form-group mt-5">
                                            <input autofocus type="text" class="form-control form-control-user"
                                                id="username" name="username" aria-describedby="emailHelp"
                                                placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password">
                                        </div>
                                        <hr class="my-4">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                        <a href="/" class="btn btn-success btn-user btn-block">Kembali ke home</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <script src="https://use.fontawesome.com/b95cc617a5.js"></script>

</body>

</html>
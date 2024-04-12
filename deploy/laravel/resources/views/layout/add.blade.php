<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}">

    <title>{{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{asset('assets/css/sb-admin-2.min.css')}}" />

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- Thousand divider --}}
    <script>
        function ribuan (x) {
            return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
        }
        function rp (x) {
            var rp = x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
            return 'Rp' + rp + ',00';
        }
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper"> 

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/" active>
                <div class="sidebar-brand-icon">
                    <i class="fa fa-pie-chart"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Keuangan HMIF</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - General -->
            <li class="nav-item {{ ($active === 'kas') ? 'active' : '' }}">
                <a class="nav-link" href="/">
                    <i class="fa fa-calculator"></i>
                    <span>Uang Kas</span></a>
            </li>
            <li class="nav-item {{ ($active === 'deposit') ? 'active' : '' }}">
                <a class="nav-link" href="/deposit">
                    <i class="fa fa-book"></i>
                    <span>Uang Deposit</span></a>
            </li>

            @can('kreus')
                <!-- Divider -->
                <hr class="sidebar-divider">
                
                <!-- Heading -->
                <div class="sidebar-heading">
                    Kreus
                </div>

                <!-- Nav Item - Kreus -->
                <li class="nav-item {{ ($active === 'laporan') ? 'active' : '' }}">
                    <a class="nav-link" href="/laporan-kreus">
                        <i class="fa fa-bar-chart"></i>
                        <span>Laporan</span></a>
                </li>
            @endcan

            @can('bendahara')
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Bendahara
                </div>

                <!-- Nav Item - Bendahara -->
                <li class="nav-item {{ ($active === 'transaksi') ? 'active' : '' }}">
                    <a class="nav-link" href="/transaksi">
                        <i class="fa fa-area-chart"></i>
                        <span>Transaksi</span></a>
                </li>
                <li class="nav-item {{ ($active === 'saldo') ? 'active' : '' }}">
                    <a class="nav-link" href="/saldo">
                        <i class="fa fa-money"></i>
                        <span>Saldo</span></a>
                </li>
                <li class="nav-item {{ ($active === 'dana') ? 'active' : '' }}">
                    <a class="nav-link" href="/dana">
                        <i class="fa fa-list"></i>
                        <span>Sumber Dana</span></a>
                </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        @auth
                            <li class="nav-item dropdown no-arrow">    
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">          
                                    <span class="mr-2 d-none d-lg-inline text-gray-600">{{ auth()->user()->nama }}</span>        
                                    <img class="img-profile rounded-circle"src="{{ asset('assets/img/undraw_profile.svg') }}">    
                                </a>    
                                <!-- Dropdown - User Information -->    
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="/ubah-kata-sandi"><i class="fa fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>Ubah Kata Sandi</a>        
                                    <div class="dropdown-divider"></div>        
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>Keluar</a>
                                </div>
                            </li>
                        @else
                            <li>
                                <a href="/login" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fa fa-sign-in"></i>
                                    </span>
                                    <span class="text">Masuk</span>
                                </a>
                            </li>
                        @endauth
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; HMIF 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Log Out</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan tombol lanjutkan jika anda ingin keluar dan mengakhiri sesi.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="btn btn-primary">Lanjutkan</button>
                    </form>
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

    <!-- Custom scripts for search pages-->
    <script src="{{ asset('assets/js/search.js') }}"></script>

    {{-- Multiple Add --}}
    <script>
        let num = 2;
        //ADD button
        $('#ADD').on('click', function(e) {
            var str = `<div id='SET'><hr class='mt-4 '><div class=' form-group row'><div class='col-sm-7 mb-3 mb-sm-0'><label for='bulan'>Bulan</label><select class='form-control form-control-user' name='bulan-${num}' id='bulan-${num}' required><option value='' selected hidden>Pilih</option><option value='April'>April</option><option value='Mei'>Mei</option><option value='Juni'>Juni</option><option value='Juli'>Juli</option><option value='Agustus'>Agustus</option><option value='September'>September</option><option value='Oktober'>Oktober</option><option value='November'>November</option></select></div><div class=' col-sm-5'><label for='nominal'>Denda</label><select class='form-control form-control-user' name='nominal-${num}' id='nominal-${num}' required><option selected value='15000'>Tidak</option> <option value='17000'>2.000</option> <option value='19000'>4.000</option> <option value='21000'>6.000</option> <option value='23000'>8.000</option> <option value='25000'>10.000</option> <option value='27000'>12.000</option> <option value='29000'>14.000</option> <option value='31000'>16.000</option> <option value='33000'>18.000</option></select></div></div></div>`;
            $('#setB').append(str);
            num++;
        }); 
        //DEL button
        $('.DEL').on('click', function (e) {
            const element = document.getElementById("SET");
            element.remove();
        });
    </script>

</body>

</html>

{{-- https://fontawesome.com/v4/icons/#currency --}}
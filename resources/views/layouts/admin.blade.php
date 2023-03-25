<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Halaman Admin') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/88326c05f7.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styleAdmin.css') }}">
    <style >
        .nav-item .nav-link.active {
        /* color: #2E2A61; */
        /* background-color: rgba(196, 196, 196, 0.3); */
        font-weight: bold;
        text-shadow: 0 0 1px #ffff;
        }
        </style>

    <!-- Favicon -->
    @yield('css')

    <link href="{{ asset('img/mpoksiti.png') }}" rel="icon" type="image/png">
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul style="background-color:#3C5C94" class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-text mx-3" style="font-size:28px">Mpok Siti</div>
        </a>

        <!-- Nav Item - Management User -->
        <li class="nav-item">
            <a class="nav-link {{ $title==='Management'? 'active' : '' }}" href="{{ route('admin.manage') }}">
            <i class="fas fa-fw fa-user-circle {{ $title==='Management'? 'active' : '' }}"></i>
                <span>Management User</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed {{ ($title==='Menu'||$title==='Publikasi')? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#MobilecollapsePages" aria-expanded="false" aria-controls="MobilecollapsePages">
                <i class="fas fa-fw fa-mobile"></i>
                <span>Mobile</span>
            </a>
            <div id="MobilecollapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <style>
                        .collapse-item.active {
                        color: #3C5C94;
                        /* background-color: rgba(196, 196, 196, 0.3); */
                        font-weight: bold;
                        }
                        </style>
                    <a class="collapse-item {{ $title==='Menu'? 'active' : '' }}" href="{{ route('admin.menu') }}">Menu</a>
                    <a class="collapse-item {{ $title==='Publikasi'? 'active' : '' }}" href="{{ route('admin.publikasi') }}">Publikasi</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pemeriksaan Klinis Virtual-->
        <li class="nav-item">
            <a class="nav-link {{ $title==='PKVirtual'? 'active' : '' }}" href="{{ route('admin.PK-pemeriksaan_klinis') }}">
            <i class="fas fa-fw fa-file-medical"></i>
            <span>Pemeriksaan Klinis</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed {{ ($title==='PKJasper'||$title==='PKKurir')? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#JPPcollapsePages" aria-expanded="false" aria-controls="JPPcollapsePages">
                <i class="fas fa-fw fa-shipping-fast"></i>
                <span>Management Jasper</span>
            </a>
            <div id="JPPcollapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <style>
                        .collapse-item.active {
                        color: #3C5C94;
                        /* background-color: rgba(196, 196, 196, 0.3); */
                        font-weight: bold;
                        }
                        </style>
                    <a class="collapse-item {{ $title==='PKJasper'? 'active' : '' }}" href="{{ route('admin.PK-jasper_management') }}">Konter Jasa Pengiriman</a>
                    <a class="collapse-item {{ $title==='PKKurir'? 'active' : '' }}" href="{{ route('admin.PK-kurir_management') }}">Jenis Kurir</a>
                </div>
            </div>
        </li>
        <!-- Nav Item - PPK EKSPOR -->
        <li class="nav-item">
                <a class="nav-link collapsed {{ ($title==='Stuffing'||$title==='Master Dokumen Trader' || $title==='Kategori Dokumen' || $title==='Master Subform'|| $title==='Organoleptik')? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-map-signs"></i>
                    <span>Ekspor</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <style>
                            .collapse-item.active {
                            color: #3C5C94;
                            /* background-color: rgba(196, 196, 196, 0.3); */
                            font-weight: bold;
                            }
                            </style>
                        <h6 class="collapse-header">Bagian Ekspor:</h6>
                        <a class="collapse-item {{ $title==='Stuffing'? 'active' : '' }}" href="{{route('admin.stuffing')}}">Stuffing</a>
                        <a class="collapse-item {{ $title==='Master Dokumen Trader'? 'active' : '' }}" href="{{route('admin.master_dokumen_trader')}}">Master Dokumen Trader</a>
                        <a class="collapse-item {{ $title==='Kategori Dokumen'? 'active' : '' }}" href="{{route('admin.kategori_dokumen')}}">Kategori Dokumen</a>
                        <a class="collapse-item {{ $title==='Master Subform'? 'active' : '' }}" href="{{route('admin.master_subform')}}">Master Subform</a>
                        <a class="collapse-item {{ $title==='Organoleptik'? 'active' : '' }}" href="{{route('admin.organoleptik')}}">Organoleptik</a>
                    </div>
                </div>
        </li>

        <li class="nav-item">
                <a class="nav-link collapsed {{ ($title==='Chatbot Command'||$title==='Chatbot Admin')? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#chatbotCollapsePages" aria-expanded="false" aria-controls="chatbotCollapsePages">
                    <i class="fas fa-fw fa-robot"></i>
                    <span>Chatbot</span>
                </a>
                <div id="chatbotCollapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <style>
                            .collapse-item.active {
                            color: #3C5C94;
                            /* background-color: rgba(196, 196, 196, 0.3); */
                            font-weight: bold;
                            }
                            </style>
                        <h6 class="collapse-header">Pengelolaan Chatbot:</h6>
                        {{-- href="{{route('admin.master_subform')}}" --}}
                        <a class="collapse-item {{ $title==='Chatbot Command'? 'active' : '' }}" href="{{route('admin.tabelCommand')}}">Command Chatbot</a>
                        <a class="collapse-item {{ $title==='Chatbot Admin'? 'active' : '' }}" href="{{route('admin.tabelDaftarAdmin')}}">Admin Chatbot</a>
                        
                    </div>
                </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ $title==='ActivityLog'? 'active' : '' }}" href="{{ route('admin.log') }}">
            <i class="fas fa-fw fa-user-circle {{ $title==='ActivityLog'? 'active' : '' }}"></i>
                <span>Activity Logs</span></a>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed {{ ($title==='ActivityLog'||$title==='ActivityLogTraders')? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#LogCollapsePages" aria-expanded="false" aria-controls="LogCollapsePages">
                <i class="fas fa-fw fa-eye"></i>
                <span>Activity Logs</span>
            </a>
            <div id="LogCollapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <style>
                        .collapse-item.active {
                        color: #3C5C94;
                        /* background-color: rgba(196, 196, 196, 0.3); */
                        font-weight: bold;
                        }
                        </style>
                    <h6 class="collapse-header">Pilih Activity Logs:</h6>
                    <a class="collapse-item {{ $title==='ActivityLog'? 'active' : '' }}" href="{{route('admin.log')}}">Activity Log Admin</a>
                    <a class="collapse-item {{ $title==='ActivityLogTraders'? 'active' : '' }}" href="{{route('admin.logTraders')}}">Activity Log Traders</a>
                    
                </div>
            </div>
    </li>
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
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow ">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <figure class="mr-3 img-profile rounded-circle avatar font-weight-bold" data-initial="{{ strtoupper(Auth::user()->email[0]) }}"></figure>
                            <span class="mr-3 d-none d-lg-inline" style="color:#2E2A61;font-weight:bold;font-size:18px">{{ Auth::user()->email }}</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('logoutadmin') }}" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
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
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready To Leave</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="{{ route('logoutadmin') }}" >Logout</a>
                <form id="logout-form" action="" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

@stack('scripts')

</body>
</html>

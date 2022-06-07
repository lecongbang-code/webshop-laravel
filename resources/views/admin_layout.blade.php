<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản lý của hàng</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/admin/assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('public/admin/assets/vendors/iconly/bold.css')}}">

    <link rel="stylesheet" href="{{asset('public/admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('public/admin/assets/images/favicon.svg')}}" type="image/x-icon">
</head>

<body>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ url('/') }}"><img src="{{asset('public/admin/assets/images/logo/logo.png')}}" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Xin chào : {{Session::get('admin_name')}}</li>

                        <li class="sidebar-item {{('admin' == request()->path()? 'active' : '')}}">
                            <a href="{{ url('/admin') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>

                        <li class="sidebar-item @php
                        if(request()->path() == 'list-category' || request()->path() == 'add-category' || request()->is('edit-category/*'))
                        {
                            echo "active";
                        }
                        @endphp">
                            <a href="{{ url('/list-category') }}" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Thể loại</span>
                            </a>
                        </li>

                        <li class="sidebar-item @php
                        if(request()->path() == 'list-product' || request()->path() == 'add-product' || request()->is('edit-product/*'))
                        {
                            echo "active";
                        }
                        @endphp">
                            <a href="{{ url('/list-product') }}" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Sản phẩm</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{('list-banner' == request()->path()? 'active' : '')}}">
                            <a href="{{ url('/list-banner') }}" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Quảng cáo</span>
                            </a>
                        </li>

                        <li class="sidebar-item @php
                        if(request()->path() == 'list-event' || request()->path() == 'add-event' || request()->is('edit-event/*'))
                        {
                            echo "active";
                        }
                        @endphp">
                            <a href="{{ url('/list-event') }}" class='sidebar-link'>
                                <i class="bi bi-gift"></i>
                                <span>Sự kiện</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{url('/admin-logout')}}" class='sidebar-link'>
                                <i class="bi bi-x-octagon-fill"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        @yield('admin_content')
    </div>
    
    <script type="text/javascript" language="javascript" src="{{asset('public/ckeditor/ckeditor.js')}}"></script>

    <script src="{{asset('public/admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('public/admin/assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/pages/dashboard.js')}}"></script>

    <script src="{{asset('public/admin/assets/js/main.js')}}"></script>

</body>

</html>
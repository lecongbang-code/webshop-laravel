<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Trang tổng quan quản trị</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{('public/admin/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{('public/admin/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{('public/admin/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{('public/admin/assets/css/pages/auth.css')}}">
</head>

<body>
    <div id="app">
        <div id="auth">
            <div class="row h-100">
                <div class="col-lg-5 col-12">
                    <div id="auth-left">
                        <div class="auth-logo">
                            {{-- <a href="index.html"><img src="{{('public/admin/assets/images/logo/logo1.png')}}" alt="Logo"></a> --}}
                        </div>
                        <h1 class="auth-title">Đăng nhập</h1>
                        <p class="auth-subtitle mb-5">Đăng nhập để tiếm tục quản lý của hàng.</p>
                        <?php
                            $message = Session::get('message_error');
                            if($message){
                                echo '<div class="alert alert-danger" role="alert">'.$message.'</div>';
                                Session::put('message_error',null);
                            }
                        ?>
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<div class="alert alert-info" role="alert">'.$message.'</div>';
                                Session::put('message',null);
                            }
                        ?>
                        <form action="{{URL::to('/post-admin-login')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl" name="username" placeholder="Tài khoản email">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" class="form-control form-control-xl" name="password" placeholder="Mật khẩu">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <div class="form-check form-check-lg d-flex align-items-end">
                                <input class="form-check-input me-2" type="checkbox" id="flexCheckDefault">
                                <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                    Ghi nhớ mật khẩu
                                </label>
                            </div>
                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="login">Đăng nhập</button>
                        </form>
                        <div class="text-center mt-5 text-lg fs-4">
                            <p class="text-gray-600">Chưa có tài khoản? <a href="{{url('/admin-signup')}}"
                                    class="font-bold">Đăng ký</a>.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div id="auth-right">
    
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Trang tổng quan quản trị</title>
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
                        <h1 class="auth-title">Đăng ký</h1>
                        <p class="auth-subtitle mb-5">Đăng ký để tiếp tục.</p>
                        <?php
                            $message_error = Session::get('message_error');
                            if($message_error){
                                echo '<div class="alert alert-danger" role="alert">'.$message_error.'</div>';
                                Session::put('message_error',null);
                            }
                        ?>
                        <form action="{{URL::to('/post-admin-signup')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="email" class="form-control form-control-xl" required name="username" placeholder="Tài khoản email">
                                <div class="form-control-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl" required name="name" placeholder="Tên người dùng">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" class="form-control form-control-xl" required name="password" placeholder="Mật khẩu">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" class="form-control form-control-xl" required name="rpassword" placeholder="Nhập lại mật khẩu">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="signup">Đăng ký</button>
                        </form>
                        <div class="text-center mt-5 text-lg fs-4">
                            <p class='text-gray-600'>Đã có tài khoản? <a href="{{url('/admin-login')}}"
                                    class="font-bold">Đăng nhập</a>.</p>
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
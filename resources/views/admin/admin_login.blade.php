<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{asset('public/login/css/login.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    
</head>

<body>
    <div class="main">
        <div class="container a-container" id="a-container">
            <form class="form" id="a-form" method="" action="">
                <h2 class="form_title title">Đăng ký</h2>
                <div class="form__icons">
                    <img class="form__icon" src="{{asset('public/login/images/facebook.png')}}" alt="facebook">
                    <img class="form__icon" src="{{asset('public/login/images/email.png')}}" alt="email">
                </div>
                <span class="form__span">hoặc sử dụng tài khoản email của bạn</span>
                <input class="form__input" type="text" placeholder="Tên người dùng">
                <input class="form__input" type="email" placeholder="Tài khoản Email">
                <input class="form__input" type="password" placeholder="Mật khẩu">
                <button class="form__button button submit" name="signup">Đăng ký</button>
            </form>
        </div>

        <div class="container b-container" id="b-container">
            <form class="form" id="b-form" action="{{URL::to('/post-admin-login')}}" method="post">
                {{ csrf_field() }}
                <h2 class="form_title title">Đăng nhập</h2>
                <div class="form__icons">
                    <img class="form__icon" src="{{asset('public/login/images/facebook.png')}}" alt="facebook">
                    <img class="form__icon" src="{{asset('public/login/images/email.png')}}" alt="email">
                </div>
                <span class="form__span">hoặc sử dụng tài khoản email của bạn</span>
                <input class="form__input" type="email" name="username" placeholder="Tài khoản Email">
                <input class="form__input" type="password" name="password" placeholder="Mật khẩu"><a class="form__link">Quên mật khẩu?</a>
                <button class="form__button button" name="login">Đăng nhập</button>
            </form>
        </div>

        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>

            <div class="switch__container" id="switch-c1">
                <h2 class="switch__title title">Admin!</h2>
                <p class="switch__description description">
                    Để giữ kết nối với chúng tôi, vui lòng đăng nhập bằng thông tin cá nhân của bạn
                </p>
                <button class="switch__button button switch-btn">Đăng nhập</button>
            </div>

            <div class="switch__container is-hidden" id="switch-c2">
                <h2 class="switch__title title">Xin chào!</h2>
                <p class="switch__description description">
                    Nhập thông tin cá nhân của bạn và bắt đầu hành trình
                </p>
                <button class="switch__button button switch-btn">Đăng ký</button>
            </div>

        </div>

    </div>

    <script src="{{asset('public/login/js/js_login.js')}}"></script>
</body>

</html>
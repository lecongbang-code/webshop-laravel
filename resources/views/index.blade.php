<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Lựa chọn các sản phẩm giảm giá tốt nhất đến cho bạn.</title>

  <meta name="description" content="Website bán hàng thông qua liên kết các của hàng,su tập một số sản phẩm được giới thiệu đem đến cho người dùng những sản phẩm giá rẻ bất ngời.
  website hỗ trợ khach hàng mua các sản phẩm một cách nhanh nhất gia tăng trải nguyện người dùng thông qua các cách nhìn trực quan về sản phẩm thao tac đơn giản khi tìm kiếm sản phẩm.">
  <meta name="keywords" content="affiliate marketing,affiliate,marketing,của hàng,giảm giá,giá rẻ,quần áo,quân,áo,mua sản phẩm giá rẻ,sản phamgiamr giá">
  <meta name="author" content="Bang">

  <meta name="csrf-token" content="{{csrf_token()}}">

  <!-- Favicons -->
  <link href="{{asset('public/user/img/favicon.png')}}" rel="icon">
  <link href="{{asset('public/user/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('public/user/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/user/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/user/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/user/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('public/user/vendor/owl.carousel/public/user/owl.carousel.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('public/user/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('public/user/css/styleslider.css')}}" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">

  <style>

    .search-input{
      width: 250px;
      margin-top: 5px;
      margin-left: 20px;
      float: left;
    }
    .search-submit{
      width: 50px;
      margin-top: 5px;
      float: left;
    }

    #hero {
    background-image: url();
    }

    #hero:before {
    content: "";
    background: rgba(255, 255, 255, 0.7);
    }

    #footer .footer-newsletter form{
      padding: 0px;
    }

    #footer .footer-newsletter form input[type="submit"]{
      height: 100%;
    }
    
  </style>

</head>

<style>
  .portfolio-wrap-top {
    width: 100%;
    position: relative;
  }

  .category-product {
    position: absolute;
    z-index: 1;
    top: 0px;
    left: 0px;
    margin: 5px;
  }

  .sale-product {
    position: absolute;
    z-index: 1;
    top: 0px;
    right: 0px;
    margin: 5px;
  }

  .bang a {
      display: block;
      position: relative;
      transition: all 0.4s ease-out 0s;
  }

  .bang a:before,
  .bang a:after {
      content: attr(data-tip);
      color: white;
      background-color: gray;
      font-size: 12px;
      font-weight: 500;
      line-height: 18px;
      padding: 5px 10px;
      white-space: nowrap;
      display: none;
      transform: translateX(-50%);
      position: absolute;
      left: 50%;
      top: -40px;
      transition: all 0.3s ease 0s;
  }

  .bang a:after {
      content: '';
      height: 10px;
      width: 10px;
      padding: 0;
      transform: translateX(-50%) rotate(45deg);
      top: -18px;
      z-index: -1;
  }

  .bang a:hover:before,
  .bang a:hover:after {
      display: block;
  }

</style>  

<script>
    function copyToClipboard(element) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val($(element).html()).select();
      document.execCommand("copy");
      $temp.remove();}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<body>

  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


  <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex align-items-center">

        <div class="logo mr-auto">
          <h1><a href="{{url('/')}}">R.A.O.V.A.T</a></h1>
        </div>

        <nav class="nav-menu d-none d-lg-block">
          <ul>

            <li class="@php
              if(request()->path() == '/' || request()->path() == 'home')
              {
                  echo "active";
              }
          @endphp"><a href="{{url('/home')}}">Trang chủ</a></li>
            <li class="drop-down @php
              if(request()->is('search-category/*'))
              {
                  echo "active";
              }
        @endphp"><a style="cursor: default">Thể loại</a>
              <ul>
                @foreach($list_category as $key => $category)
                <li><a href="{{URL::to('/search-category/'.$category->id)}}">{{$category->name}}</a></li>
                @endforeach
              </ul>
            </li>
            <li class="@php
              if(request()->path() == 'search/list-product-discount-code')
              {
                  echo "active";
              }
            @endphp">
            <a href="{{URL::to('/search/list-product-discount-code')}}">Mã Giảm giá</a></li>
            <li class="@php
              if(request()->path() == 'search/super-discount')
              {
                  echo "active";
              }
          @endphp">
              <a href="{{url('/search/super-discount')}}">Siêu giảm giá</a></li>

            <li>
              <form action="{{URL::to('/search-product')}}" method="post">
                {{ csrf_field() }}
                <input type="search" name="key" class="form-control search-input"/>
                <button type="submit" name="btn_search" class="form-control search-submit btn btn-outline-primary">
                  <i class="bx bx-search-alt-2"></i>
                </button>
              </form>
            </li>

          </ul>
        </nav><!-- .nav-menu -->

      </div>
    </header>
  <!-- End Header -->
    
    @yield('index_event')

  <!-- ======= Main ======= -->
    <main id="main">

      @yield('index_represent')
      @yield('index_content')
      @yield('product_more')

    </main>
  <!-- End #main -->

  <!-- ======= Slider ======= -->
    <section id="portfolio" class="portfolio" style="padding:0px 0px 5px 0px;">
      <div class="container">
        <div class="row">
          <div class="col-6">
              <h3 class="mb-3">Sản phẩm đề xuất</h3>
          </div>
          <div class="col-6 text-right">
              <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                  <i class="fa fa-arrow-left"></i>
              </a>
              <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                  <i class="fa fa-arrow-right"></i>
              </a>
          </div>
          <div class="col-12" style="padding-bottom: 10px; padding-top: 10px;">
            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

              <div class="carousel-inner">

                <div class="carousel-item active">
                  <div class="row">
                    
                    @php
                        $slider_i = 0;
                        $slider_j = 0;
                    @endphp
                    @foreach($product_slider as $key => $slider)
                      <?php 
                      if($slider_i <= 3)
                      {
                        ?>

                          <div class="col-lg-3 col-md-6 portfolio-item" style="height: 420px">
                            <div class="portfolio-wrap" style="height: 390px">
                    
                              <div class="portfolio-wrap-top">
                                <div class="category-product"><a href="{{URL::to('/search-category/'.$slider->category_id)}}" class="btn btn-light" style="font-size: 13px;">
                                  <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> {{$slider->id_category}}</a></div>
                    
                                <div class="sale-product"><a href="" class="btn btn-warning" style="font-size: 13px; font-weight:900">
                                  <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> Giảm {{$slider->ratio}}%</a></div>
                              </div>

                              <?php 
                                if($slider->discount_code)
                                {
                                  ?>
                                    <div class="portfolio-wrap-top bang">
                                      <div class="category-product" style="top: 40px"><a data-tip='Click to copy "<?php echo $slider->discount_code?>"' onclick="copyToClipboard('#copy<?php echo $slider->id ?>')" class="btn btn-danger" style="font-size: 13px;">
                                        <i style="font-size: 14px" class="bx bx-barcode-reader"></i> Mã giảm : <span id="copy<?php echo $slider->id ?>">{{ $slider->discount_code }}</span> </a></div>
                                    </div>
                                  <?php
                                }
                              ?>

                              <figure style="height: 320px;">
                                <img src="{{$slider->url_image}}" class="img-fluid" alt="">
                                <a href="{{$slider->url_image}}" data-gall="portfolioGallery" class="link-preview venobox" title="Xem ảnh"><i class="bx bx-plus"></i></a>
                                <a href="{{$slider->url_product}}" target="_blank" class="link-details" title="Thông tin"><i class="bx bx-link"></i></a>
                              </figure>
                    
                              <div class="portfolio-info" style="padding: 5px">
                                <a style="font-size: 15px" href="{{$slider->url_product}}" target="_blank">{{substr($slider->name, 0, 25)}}</a>
                                <p style="font-size: 10px">Đánh giá : 
                                  <?php 
                                      $star_slider = $slider->rating;
                                      $rating_slider = floor($slider->rating);
                                      $unrating_slider = 5-$rating_slider;
                                      for ($i=0; $i< $rating_slider ; $i++) { 
                                        ?>
                                          <i class="bx bxs-star" style="font-size: 18px; color:rgb(255, 241, 47);"></i>
                                        <?php
                                      }
                                      $a=0;
                                      for ($j=0; $j < $unrating_slider ; $j++) { 
                                        if ($a==0) {
                                          if ($star_slider == '0.5' || $star_slider == '1.5' || $star_slider == '2.5' || $star_slider == '3.5' || $star_slider == '4.5') {
                                            ?>
                                              <i class="bx bxs-star-half" style="font-size: 18px; color:rgb(255, 241, 47);"></i>
                                            <?php
                                          }
                                          else {
                                            ?>
                                            <i class="bx bx-star" style="font-size: 18px; color:rgb(255, 241, 47);"></i>
                                            <?php
                                          }
                                        }
                                        else 
                                        {
                                          ?>
                                            <i class="bx bx-star" style="font-size: 18px; color:rgb(255, 241, 47);"></i>
                                          <?php
                                        }
                                        $a++;
                                      }
                                      ?>
                                  <span>({{$slider->rating}})</span>
                                </p>
                                <h6>Giá: <del>{{$slider->old_price}}</del> <span style="font-size: 20px; color:rgb(241, 101, 7); font-weight:900 ">{{$slider->new_price}}</span></h6>
                              </div>
      
                            </div>
                          </div>

                        <?php
                      }$slider_i++;
                      ?>
                    @endforeach

                  </div>
                </div>

                <div class="carousel-item">
                  <div class="row">

                    @foreach($product_slider as $key => $slider)
                    <?php 
                    if($slider_j > 3 && $slider_j < 8 )
                    {
                    ?>

                      <div class="col-lg-3 col-md-6 portfolio-item" style="height: 420px">
                        <div class="portfolio-wrap" style="height: 390px">
                
                          <div class="portfolio-wrap-top">
                            <div class="category-product"><a href="" class="btn btn-light" style="font-size: 13px;">
                              <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> {{$slider->id_category}}</a></div>
                
                            <div class="sale-product"><a href="" class="btn btn-warning" style="font-size: 13px; font-weight:900">
                              <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> Giảm {{$slider->ratio}}%</a></div>
                          </div>

                            <?php 
                              if($slider->discount_code)
                              {
                                ?>
                                  <div class="portfolio-wrap-top bang">
                                    <div class="category-product" style="top: 40px"><a  data-tip='Click to copy "<?php echo $slider->discount_code?>"' onclick="copyToClipboard('#copy<?php echo $slider->id ?>')" class="btn btn-danger" style="font-size: 13px;">
                                      <i style="font-size: 14px" class="bx bx-barcode-reader"></i> Mã giảm : <span id="copy<?php echo $slider->id ?>">{{ $slider->discount_code }}</span> </a></div>
                                  </div>
                                <?php
                              }
                            ?>

                          <figure style="height: 320px;">
                            <img src="{{$slider->url_image}}" style="height: 100%" class="img-fluid" alt="">
                            <a href="{{$slider->url_image}}" data-gall="portfolioGallery" class="link-preview venobox" title="Xem ảnh"><i class="bx bx-plus"></i></a>
                            <a href="{{$slider->url_product}}" target="_blank" class="link-details" title="Thông tin"><i class="bx bx-link"></i></a>
                          </figure>
                
                          <div class="portfolio-info" style="padding: 5px">
                            <a style="font-size: 15px" href="{{$slider->url_product}}" target="_blank">{{substr($slider->name, 0, 25)}}</a>
                            <p style="font-size: 10px">Đánh giá : 
                              <?php 
                                  $star_slider = $slider->rating;
                                  $rating_slider = floor($slider->rating);
                                  $unrating_slider = 5-$rating_slider;
                                  for ($i=0; $i< $rating_slider ; $i++) { 
                                    ?>
                                      <i class="bx bxs-star" style="font-size: 18px; color:rgb(255, 241, 47);"></i>
                                    <?php
                                  }
                                  $a=0;
                                  for ($j=0; $j < $unrating_slider ; $j++) { 
                                    if ($a==0) {
                                      if ($star_slider == '0.5' || $star_slider == '1.5' || $star_slider == '2.5' || $star_slider == '3.5' || $star_slider == '4.5') {
                                        ?>
                                          <i class="bx bxs-star-half" style="font-size: 18px; color:rgb(255, 241, 47);"></i>
                                        <?php
                                      }
                                      else {
                                        ?>
                                        <i class="bx bx-star" style="font-size: 18px; color:rgb(255, 241, 47);"></i>
                                        <?php
                                      }
                                    }
                                    else 
                                    {
                                      ?>
                                        <i class="bx bx-star" style="font-size: 18px; color:rgb(255, 241, 47);"></i>
                                      <?php
                                    }
                                    $a++;
                                  }
                                  ?>
                              <span>({{$slider->rating}})</span>
                            </p>
                            <h6>Giá: <del>{{$slider->old_price}}</del> <span style="font-size: 20px; color:rgb(241, 101, 7); font-weight:900 ">{{$slider->new_price}}</span></h6>
                          </div>

                        </div>
                      </div>

                    <?php
                    }
                    $slider_j++;
                    ?>
                    @endforeach

                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- End Slider -->

    <hr>

  <!-- ======= Footer ======= -->
    <footer id="footer">

      <div class="footer-top">
        <div class="container">
          <div class="row">

            <div class="col-lg-3 col-md-6 footer-contact">
              <h3>B.A.N.G</h3>
              <p>
                  VIỆT NAM<br><br>
                <strong>Phone:</strong> +(84)<br>
                <strong>Email:</strong> panqconq2018@gmail.com<br>
              </p>
            </div>

            <div class="col-lg-2 col-md-6 footer-links">
              <h4>Liên kết hữu ích</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="{{url('/home')}}">Trang Chủ</a></li>
                <li><i class="bx bx-chevron-right"></i> <a>Về chúng tôi</a></li>
                <li><i class="bx bx-chevron-right"></i> <a>Dịch vụ</a></li>
                <li><i class="bx bx-chevron-right"></i> <a>Điều khoản dịch vụ</a></li>
                <li><i class="bx bx-chevron-right"></i> <a>Chính sách bảo mật</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Dịch vụ của chúng tôi</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a>Thiết kế web</a></li>
                <li><i class="bx bx-chevron-right"></i> <a>Phát triển web</a></li>
                <li><i class="bx bx-chevron-right"></i> <a>Quản lý sản phẩm</a></li>
                <li><i class="bx bx-chevron-right"></i> <a>Tiếp thị</a></li>
                <li><i class="bx bx-chevron-right"></i> <a>Thiết kế đồ họa</a></li>
              </ul>
            </div>

            <div class="col-lg-4 col-md-6 footer-newsletter">
              <h4>Tham gia bản tin của chúng tôi</h4>
              <p>Tìm kiếm sản phẩm của mọi thời đại.</p>
              <form action="{{URL::to('/search-product')}}" method="post">
                {{ csrf_field() }}
                <input type="search" class="form-control" name="key"><input type="submit" value="Tìm kiếm">
              </form>
            </div>

          </div>
        </div>
      </div>

      <div class="container d-md-flex py-4">

        <div class="mr-md-auto text-center text-md-left">
          <div class="copyright">
            &copy;2021 <strong><span>B.A.N.G</span></strong>
          </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
          <a style="cursor:no-drop" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a style="cursor:no-drop" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a style="cursor:no-drop" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a style="cursor:no-drop" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a style="cursor:no-drop" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>
    </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  
  <!-- Vendor JS Files -->
    <script src="{{asset('public/user/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/user/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/user/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('public/user/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('public/user/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('public/user/vendor/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('public/user/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('public/user/vendor/venobox/venobox.min.js')}}"></script>
    <script src="{{asset('public/user/vendor/owl.carousel/owl.carousel.min.js')}}"></script>

  <!-- Template Main JS File -->
    <script src="{{asset('public/user/js/main.js')}}"></script>

</body>

</html>
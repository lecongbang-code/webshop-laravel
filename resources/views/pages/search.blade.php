@extends('index')

  @section('index_represent')
  <div style="height: 80px"></div>
    @foreach($product_event as $key => $product_event)
    <!-- ======= About Section ======= -->
      <section id="about" class="about">
          <div class="section-title">
              <h2>Đề xuất cho bạn</h2>
            </div>
        <div class="container">

          <div class="row">

            <div class="col-lg-6">

              <div class="portfolio-wrap-top">
                <div class="category-product"><a href="{{URL::to('/search-category/'.$product_event->category_id)}}" class="btn btn-light" style="font-size: 13px;">
                  <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> {{ $product_event->id_category }}</a></div>
    
                <div class="sale-product"><a class="btn btn-warning" style="font-size: 13px; font-weight:900">
                  <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> Giảm {{ $product_event->ratio }}%</a></div>
              </div>

              <?php 
                if($product_event->discount_code)
                {
                  ?>
                    <div class="portfolio-wrap-top bang">
                      <div class="category-product" style="top: 40px"><a data-tip='Click to copy "<?php echo $product_event->discount_code?>"' onclick="copyToClipboard('#copy<?php echo $product_event->id ?>')" class="btn btn-danger" style="font-size: 13px;">
                        <i style="font-size: 14px" class="bx bx-barcode-reader"></i> Mã giảm : <span id="copy<?php echo $product_event->id ?>">{{ $product_event->discount_code }}</span> </a></div>
                    </div>
                  <?php
                }
              ?>

              <a href="{{ $product_event->url_product }}" target="_blank"><img width="100%" src="{{ $product_event->url_image }}" class="img-fluid" alt=""></a>
            </div>

            <div class="col-lg-6 pt-4 pt-lg-0">
              <a href="{{ $product_event->url_product }}" style="color: black">
                <h3><span>
                  <a href="" style="color: #3498db; font-size:18px"><i class="bx bx-purchase-tag-alt"></i> {{ $product_event->id_category }}</a> </span><a href=" {{ $product_event->url_product }} " target="_blank" style="color: black">{{$product_event->name}}</a></h3>
              </a>
              <p>
                Mô tả sản phẩm
              </p>

              <ul>
                <li><i class="bx bx-check-double"></i> @php
                    echo $product_event->description
                @endphp </li>
              </ul>

              <div class="row icon-boxes">
                <div class="col-md-6">
                  <h6>Đánh giá <span>({{ $product_event->assessor }})</span></h6>
                  <i class="bx bx-check-square" style="font-size: 20px; color:#3498db;"></i>
                  <?php 
                    $star = $product_event->rating;
                    $rating = floor($product_event->rating);
                    $unrating = 5-$rating;
                    for ($i=0; $i< $rating ; $i++) { 
                      ?>
                        <i class="bx bxs-star" style="font-size: 22px; color:rgb(255, 241, 47);"></i>
                      <?php
                    }
                    $a=0;
                    for ($j=0; $j < $unrating ; $j++) { 
                      if ($a==0) {
                        if ($star == '0.5' || $star == '1.5' || $star == '2.5' || $star == '3.5' || $star == '4.5') {
                          ?>
                            <i class="bx bxs-star-half" style="font-size: 22px; color:rgb(255, 241, 47);"></i>
                          <?php
                        }
                        else {
                          ?>
                          <i class="bx bx-star" style="font-size: 22px; color:rgb(255, 241, 47);"></i>
                          <?php
                        }
                      }
                      else 
                      {
                        ?>
                          <i class="bx bx-star" style="font-size: 22px; color:rgb(255, 241, 47);"></i>
                        <?php
                      }
                      $a++;
                    }
                  ?>

                  <span>({{ $product_event->rating }})</span>
                  <h6>Giá: <del>{{ $product_event->old_price }}</del> <span style="font-size: 30px; color:rgb(241, 101, 7); font-weight:900 ">{{ $product_event->new_price }}</span></h6>

                </div>
                
                <div class="col-md-6">
                    <a href="{{ $product_event->url_product }}" target="_blank" class="btn btn-primary" style="width:100%; margin: 50px 0px 0px 0px;">Mua ngay</a>
                  </div>
                </div>
                <hr>
                <div class="row icon-boxes">
                  @php
                      $b=0;
                  @endphp
                  @foreach ($list_category_more as $key => $cate)
                    <?php
                      if ($b <= 7) 
                      {
                        ?>
                        <div style="margin:2px">
                          <a href="{{URL::to('/search-category/'.$cate->id)}}" class="btn btn-light" style="font-size: 13px;">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> {{$cate->name}}</a>
                        </div>
                        <?php
                      }
                      $b++;
                    ?>
                  @endforeach
                  
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
      <!-- End About Section -->

    @endforeach

  @endsection

  @section('index_content')

  <section id="portfolio" class="portfolio" style="padding-bottom: 20px; padding-top: 20px;">
    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <ul id="portfolio-flters">
            <li data-filter="*" class="@php
            if(request()->path() == 'home' || request()->path() == 'search/list-product-discount-code' || request()->path() == 'search/super-discount' || request()->path() == 'search-product' || request()->path() == '/')
            {
                echo "filter-active";
            }
          @endphp">Tất cả</li>
            @foreach($list_category as $key => $category)
              <a href="{{URL::to('/search-category/'.$category->id)}}">
                <li data-filter=".filter-{{$category->id}}"
                  class="@php
                    if(request()->path() == 'search-category/'.$category->id)
                    {
                        echo "filter-active";
                    }
                  @endphp"
                  >{{$category->name}}</li>
              </a>
              @endforeach
          </ul>
        </div>
      </div>

    <div class="row">
      @foreach($list_product as $key => $product)

      <div class="col-lg-3 col-md-6 portfolio-item filter-{{$product->category_id}} wow fadeInUp list-product" style="height: 480px; padding-right: 5px; padding-left: 5px;">
        <div class="portfolio-wrap" style="height: 470px">

          <div class="portfolio-wrap-top">
            <div class="category-product"><a href="{{URL::to('/search-category/'.$product->category_id)}}" class="btn btn-light" style="font-size: 13px;">
              <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> {{ $product->id_category }}</a></div>

            <div class="sale-product"><a href="" class="btn btn-warning" style="font-size: 13px; font-weight:900">
              <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> Giảm {{ $product->ratio }}%</a></div>
          </div>

          <?php 
            if($product->discount_code)
            {
              ?>
                <div class="portfolio-wrap-top bang">
                  <div class="category-product" style="top: 40px"><a data-tip='Click to copy "<?php echo $product->discount_code?>"' onclick="copyToClipboard('#copy<?php echo $product->id ?>')" class="btn btn-danger" style="font-size: 13px;">
                    <i style="font-size: 14px" class="bx bx-barcode-reader"></i> Mã giảm : <span id="copy<?php echo $product->id ?>">{{ $product->discount_code }}</span> </a></div>
                </div>
              <?php
            }
          ?>
          
          <figure style="height: 320px;">
            <img src="{{ $product->url_image }}" class="img-fluid" style="height: 100%" width="100%" alt="">
            <a href="{{ $product->url_image }}" data-gall="portfolioGallery" class="link-preview venobox" title="Xem ảnh"><i class="bx bx-plus"></i></a>
            <a href="{{ $product->url_product }} "target="_blank" class="link-details" title="Thông tin"><i class="bx bx-link"></i></a>
          </figure>

          <div class="portfolio-info" style="padding: 5px">
            <a style="font-size: 16px" href="{{ $product->url_product }} "target="_blank" >{{substr($product->name, 0, 35)}}</a>
            <p style="font-size: 12px">Đánh giá : 
              <?php 
                  $star_p = $product->rating;
                  $rating_p = floor($product->rating);
                  $unrating_p = 5-$rating_p;
                  for ($i=0; $i< $rating_p ; $i++) { 
                    ?>
                      <i class="bx bxs-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>
                    <?php
                  }
                  $a=0;
                  for ($j=0; $j < $unrating_p ; $j++) { 
                    if ($a==0) {
                      if ($star_p == '0.5' || $star_p == '1.5' || $star_p == '2.5' || $star_p == '3.5' || $star_p == '4.5') {
                        ?>
                          <i class="bx bxs-star-half" style="font-size: 16px; color:rgb(255, 241, 47);"></i>
                        <?php
                      }
                      else {
                        ?>
                        <i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>
                        <?php
                      }
                    }
                    else 
                    {
                      ?>
                        <i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>
                      <?php
                    }
                    $a++;
                  }
                ?>
              <span>({{ $product->rating }})</span>
            </p>
            <h6>Giá: <del>{{ $product->old_price }}</del> <span style="font-size: 22px; color:rgb(241, 101, 7); font-weight:900 ">{{ $product->new_price }}</span></h6>
            <a href="{{ $product->url_product }} "target="_blank" class="btn btn-outline-primary" style="width: 80%"><span>Mua ngay</span></a>
          </div>
        </div>
      </div>

      @endforeach
    </div>

    </div>
    </section>

  @endsection
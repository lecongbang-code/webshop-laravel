<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use RealRashid\SweetAlert\Facades\Alert;

// use Alert;

session_start();

class UserController extends Controller
{

    public function view(){
        $data = array();
        $list_view = DB::table('tbl_view')->where('id',1)->get();
        foreach($list_view as $key => $view)
        {
            $data['count'] = $view->count;
            $data['count']++;
        }
        DB::table('tbl_view')->where('id',1)->update($data);
    }

    public function index(){

        $this->view();
        $list_category = DB::table('tbl_category')->where('status','on')->orderby('id','desc')->get();
        $list_category_more = DB::table('tbl_category')->where('status','on')->inRandomOrder()->get();
        $list_event = DB::table('tbl_banner')->where('status','on')->orderby('id','desc')->limit(3)->get();
        $product_slider = DB::table('tbl_product')->where('status','on')->inRandomOrder()->limit(8)->get();
        $product_event = DB::table('tbl_product')->where('status','on')->where('status_adv','on')->inRandomOrder()->limit(1)->get();
        $list_product = DB::table('tbl_product')->where('status','on')->orderby('id','desc')->limit(30)->get();
    	return view('pages.home')
        ->with('list_category', $list_category)
        ->with('list_event', $list_event)
        ->with('product_event', $product_event)
        ->with('product_slider', $product_slider)
        ->with('list_category_more', $list_category_more)
        ->with('list_product', $list_product);

    }

    public function loadMoreProduct(Request $request){        
        $data = $request->all();
        $all_product = DB::table('tbl_product')
        ->where('status','on')
        ->where('id','<',$data['id'])
        ->orderby('id','desc')
        ->take(20)
        ->get();

        if(!$all_product->isEmpty())
        {
            foreach($all_product as $key => $product)
            {
                $text= '#copy'.$product->id;
     
                $dicount_code = '';
                if($product->discount_code)
                {
                    $dicount_code = '
                    <div class="portfolio-wrap-top bang">
                    <div class="category-product" style="top: 40px"><a data-tip="Click to copy "'.$product->discount_code.'" onclick=copyToClipboard("'.$text.'") class="btn btn-danger" style="font-size: 13px;">
                        <i style="font-size: 14px" class="bx bx-barcode-reader"></i> Mã giảm : <span id="copy'.$product->id.'">'. $product->discount_code .'</span> </a></div>
                    </div>
                    ';
                }

                $star_p = $product->rating;
                $rating_p = floor($product->rating);
                $unrating_p = 5-$rating_p;

                $array_star = array();
                $array_star_v2 = array();

                for ($i=0; $i< $rating_p ; $i++) { 
                    $array_star[$i] = '<i class="bx bxs-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                }

                for ($i=$rating_p; $i< 5 ; $i++) { 
                    $array_star[$i] = '';
                }

                $a=0;
                for ($j=0; $j < $unrating_p ; $j++) { 

                    if ($a==0) {
                        if ($star_p == '0.5' || $star_p == '1.5' || $star_p == '2.5' || $star_p == '3.5' || $star_p == '4.5') {
        
                            $array_star_v2[$j] = '<i class="bx bxs-star-half" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                
                        }
                        else {
            
                            $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
        
                        }
                    }
                    else {
                        $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                    }
                    $a++;
                }
                for ($j=$unrating_p; $j < 5 ; $j++) { 
                    $array_star_v2[$j] = '';
                }
                $print = '
                    <div class=" col-lg-3 col-md-6 portfolio-item filter-'.$product->category_id.' wow fadeInUp list-product" style="height: 480px; padding-right: 5px; padding-left: 5px;">
                        <div class="portfolio-wrap" style="height: 470px">

                        <div class="portfolio-wrap-top">
                            <div class="category-product"><a href="'.url('/search-category/'.$product->category_id).'" class="btn btn-light" style="font-size: 13px;">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> '.$product->id_category.'</a></div>

                            <div class="sale-product"><a href="" class="btn btn-warning" style="font-size: 13px; font-weight:900">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> Giảm '.$product->ratio.'%</a></div>
                        </div>

                        '.$dicount_code.'

                        <figure style="height: 320px;">
                            <img src="'.$product->url_image .'" class="img-fluid" style="height: 100%" width="100%" alt="">
                            <a href="'.$product->url_image .'" data-gall="portfolioGallery" class="link-preview venobox" title="Xem ảnh"><i class="bx bx-plus"></i></a>
                            <a href="'.$product->url_product .' "target="_blank" class="link-details" title="Thông tin"><i class="bx bx-link"></i></a>
                        </figure>

                        <div class="portfolio-info" style="padding: 5px">
                            <a style="font-size: 16px" href="'. $product->url_product .' "target="_blank" >'.substr($product->name, 0, 35).'</a>
                            <p style="font-size: 12px">Đánh giá : 
                            '.$array_star[0].$array_star[1].$array_star[2].$array_star[3].$array_star[4].$array_star_v2[0].$array_star_v2[1].$array_star_v2[2].$array_star_v2[3].$array_star_v2[4].'
                            <span>('. $product->rating .')</span>
                            </p>
                            <h6>Giá: <del>'. $product->old_price .'</del> <span style="font-size: 22px; color:rgb(241, 101, 7); font-weight:900 ">'. $product->new_price .'</span></h6>
                            <a href="'. $product->url_product .' "target="_blank" class="btn btn-outline-primary" style="width: 80%"><span>Mua ngay</span></a>
                        </div>

                        </div>
                    </div>
                ';
                $last_id = $product->id;
                echo $print;
            }
            $btn_more='
                <div id="btn_remove" class="container">
                    <div style="margin: auto;  width: 200px; text-align: center;">
                        <button id="load_more_button" style="margin-top: 30px" onclick="clickMoreProduct()" name="'.$last_id.'" class="btn btn-primary">Xem thêm</button>
                    </div>
                </div>';
            echo $btn_more;
        }else{
            echo '
            <div id="btn_remove" class="container">
                <span style="cursor: wait"> Đang tải thêm sản phẩm...!</span>
            </div>';
        }
    }

    public function loadMoreProductCategory(Request $request){        
        $data = $request->all();
        $all_product = DB::table('tbl_product')
        ->where('status','on')
        ->where('id','<',$data['id'])
        ->orderby('id','desc')
        ->take(20)
        ->get();

        if(!$all_product->isEmpty())
        {
            foreach($all_product as $key => $product)
            {
                $text= '#copy'.$product->id;
     
                $dicount_code = '';
                if($product->discount_code)
                {
                    $dicount_code = '
                    <div class="portfolio-wrap-top bang">
                    <div class="category-product" style="top: 40px"><a data-tip="Click to copy "'.$product->discount_code.'" onclick=copyToClipboard("'.$text.'") class="btn btn-danger" style="font-size: 13px;">
                        <i style="font-size: 14px" class="bx bx-barcode-reader"></i> Mã giảm : <span id="copy'.$product->id.'">'. $product->discount_code .'</span> </a></div>
                    </div>
                    ';
                }

                $star_p = $product->rating;
                $rating_p = floor($product->rating);
                $unrating_p = 5-$rating_p;

                $array_star = array();
                $array_star_v2 = array();

                for ($i=0; $i< $rating_p ; $i++) { 
                    $array_star[$i] = '<i class="bx bxs-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                }

                for ($i=$rating_p; $i< 5 ; $i++) { 
                    $array_star[$i] = '';
                }

                $a=0;
                for ($j=0; $j < $unrating_p ; $j++) { 

                    if ($a==0) {
                        if ($star_p == '0.5' || $star_p == '1.5' || $star_p == '2.5' || $star_p == '3.5' || $star_p == '4.5') {
        
                            $array_star_v2[$j] = '<i class="bx bxs-star-half" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                
                        }
                        else {
            
                            $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
        
                        }
                    }
                    else {
                        $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                    }
                    $a++;
                }
                for ($j=$unrating_p; $j < 5 ; $j++) { 
                    $array_star_v2[$j] = '';
                }
                $print = '
                    <div class=" col-lg-3 col-md-6 portfolio-item filter-'.$product->category_id.' wow fadeInUp list-product" style="height: 480px; padding-right: 5px; padding-left: 5px;">
                        <div class="portfolio-wrap" style="height: 470px">

                        <div class="portfolio-wrap-top">
                            <div class="category-product"><a href="'.url('/search-category/'.$product->category_id).'" class="btn btn-light" style="font-size: 13px;">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> '.$product->id_category.'</a></div>

                            <div class="sale-product"><a href="" class="btn btn-warning" style="font-size: 13px; font-weight:900">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> Giảm '.$product->ratio.'%</a></div>
                        </div>

                        '.$dicount_code.'

                        <figure style="height: 320px;">
                            <img src="'.$product->url_image .'" class="img-fluid" style="height: 100%" width="100%" alt="">
                            <a href="'.$product->url_image .'" data-gall="portfolioGallery" class="link-preview venobox" title="Xem ảnh"><i class="bx bx-plus"></i></a>
                            <a href="'.$product->url_product .' "target="_blank" class="link-details" title="Thông tin"><i class="bx bx-link"></i></a>
                        </figure>

                        <div class="portfolio-info" style="padding: 5px">
                            <a style="font-size: 16px" href="'. $product->url_product .' "target="_blank" >'.substr($product->name, 0, 35).'</a>
                            <p style="font-size: 12px">Đánh giá : 
                            '.$array_star[0].$array_star[1].$array_star[2].$array_star[3].$array_star[4].$array_star_v2[0].$array_star_v2[1].$array_star_v2[2].$array_star_v2[3].$array_star_v2[4].'
                            <span>('. $product->rating .')</span>
                            </p>
                            <h6>Giá: <del>'. $product->old_price .'</del> <span style="font-size: 22px; color:rgb(241, 101, 7); font-weight:900 ">'. $product->new_price .'</span></h6>
                            <a href="'. $product->url_product .' "target="_blank" class="btn btn-outline-primary" style="width: 80%"><span>Mua ngay</span></a>
                        </div>

                        </div>
                    </div>
                ';
                $last_id2 = $product->id;
                echo $print;
            }
            $btn_more='
            <div id="btn_remove_category2" class="container">
            <div style="margin: auto;  width: 200px; text-align: center;">
                <button type="button" id="load_more_button_category2" class="btn btn-primary" style="margin-top: 30px" data-sample-id="'.$last_id2.'" onclick="myFunction2()"> Xem thêm </button>
              </div>
          </div>';
            echo $btn_more;
        }else{
            echo '
            <div id="btn_remove" class="container">
                <span style="cursor: wait"> Đang tải thêm sản phẩm...!</span>
            </div>';
        }
    }

    public function loadMoreProductDiscountCode(Request $request){        
        $data = $request->all();
        $all_product = DB::table('tbl_product')
        ->where('status','on')
        ->where('id','<',$data['id'])
        ->orderby('id','desc')
        ->take(20)
        ->get();

        if(!$all_product->isEmpty())
        {
            foreach($all_product as $key => $product)
            {
                $text= '#copy'.$product->id;
     
                $dicount_code = '';
                if($product->discount_code)
                {
                    $dicount_code = '
                    <div class="portfolio-wrap-top bang">
                    <div class="category-product" style="top: 40px"><a data-tip="Click to copy "'.$product->discount_code.'" onclick=copyToClipboard("'.$text.'") class="btn btn-danger" style="font-size: 13px;">
                        <i style="font-size: 14px" class="bx bx-barcode-reader"></i> Mã giảm : <span id="copy'.$product->id.'">'. $product->discount_code .'</span> </a></div>
                    </div>
                    ';
                }

                $star_p = $product->rating;
                $rating_p = floor($product->rating);
                $unrating_p = 5-$rating_p;

                $array_star = array();
                $array_star_v2 = array();

                for ($i=0; $i< $rating_p ; $i++) { 
                    $array_star[$i] = '<i class="bx bxs-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                }

                for ($i=$rating_p; $i< 5 ; $i++) { 
                    $array_star[$i] = '';
                }

                $a=0;
                for ($j=0; $j < $unrating_p ; $j++) { 

                    if ($a==0) {
                        if ($star_p == '0.5' || $star_p == '1.5' || $star_p == '2.5' || $star_p == '3.5' || $star_p == '4.5') {
        
                            $array_star_v2[$j] = '<i class="bx bxs-star-half" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                
                        }
                        else {
            
                            $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
        
                        }
                    }
                    else {
                        $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                    }
                    $a++;
                }
                for ($j=$unrating_p; $j < 5 ; $j++) { 
                    $array_star_v2[$j] = '';
                }
                $print = '
                    <div class=" col-lg-3 col-md-6 portfolio-item filter-'.$product->category_id.' wow fadeInUp list-product" style="height: 480px; padding-right: 5px; padding-left: 5px;">
                        <div class="portfolio-wrap" style="height: 470px">

                        <div class="portfolio-wrap-top">
                            <div class="category-product"><a href="'.url('/search-category/'.$product->category_id).'" class="btn btn-light" style="font-size: 13px;">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> '.$product->id_category.'</a></div>

                            <div class="sale-product"><a href="" class="btn btn-warning" style="font-size: 13px; font-weight:900">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> Giảm '.$product->ratio.'%</a></div>
                        </div>

                        '.$dicount_code.'

                        <figure style="height: 320px;">
                            <img src="'.$product->url_image .'" class="img-fluid" style="height: 100%" width="100%" alt="">
                            <a href="'.$product->url_image .'" data-gall="portfolioGallery" class="link-preview venobox" title="Xem ảnh"><i class="bx bx-plus"></i></a>
                            <a href="'.$product->url_product .' "target="_blank" class="link-details" title="Thông tin"><i class="bx bx-link"></i></a>
                        </figure>

                        <div class="portfolio-info" style="padding: 5px">
                            <a style="font-size: 16px" href="'. $product->url_product .' "target="_blank" >'.substr($product->name, 0, 35).'</a>
                            <p style="font-size: 12px">Đánh giá : 
                            '.$array_star[0].$array_star[1].$array_star[2].$array_star[3].$array_star[4].$array_star_v2[0].$array_star_v2[1].$array_star_v2[2].$array_star_v2[3].$array_star_v2[4].'
                            <span>('. $product->rating .')</span>
                            </p>
                            <h6>Giá: <del>'. $product->old_price .'</del> <span style="font-size: 22px; color:rgb(241, 101, 7); font-weight:900 ">'. $product->new_price .'</span></h6>
                            <a href="'. $product->url_product .' "target="_blank" class="btn btn-outline-primary" style="width: 80%"><span>Mua ngay</span></a>
                        </div>

                        </div>
                    </div>
                ';
                $last_id = $product->id;
                if($product->discount_code)
                {
                    echo $print;
                }
            }
            $btn_more='
            <div class="container" id="btn_remove_discount_code">
                <div style="margin: auto;  width: 200px; text-align: center;">
                    <button id="load_more_product_discount_code" style="margin-top: 30px" class="btn btn-primary" onclick="myFunction()" data-sample-id="'.$last_id.'">Xem thêm</button>
                </div>
            </div>';
            echo $btn_more;
        }else{
            echo '
            <div id="btn_remove" class="container">
                <span style="cursor: wait"> Đang tải thêm sản phẩm...!</span>
            </div>';
        }
    }

    public function loadMoreProductAllCategory(Request $request){        
        $data = $request->all();
        $all_product = DB::table('tbl_product')
        ->where('status','on')
        ->where('id','<',$data['id'])
        ->orderby('id','desc')
        ->take(20)
        ->get();

        if(!$all_product->isEmpty())
        {
            foreach($all_product as $key => $product)
            {
                $text= '#copy'.$product->id;
     
                $dicount_code = '';
                if($product->discount_code)
                {
                    $dicount_code = '
                    <div class="portfolio-wrap-top bang">
                    <div class="category-product" style="top: 40px"><a data-tip="Click to copy "'.$product->discount_code.'" onclick=copyToClipboard("'.$text.'") class="btn btn-danger" style="font-size: 13px;">
                        <i style="font-size: 14px" class="bx bx-barcode-reader"></i> Mã giảm : <span id="copy'.$product->id.'">'. $product->discount_code .'</span> </a></div>
                    </div>
                    ';
                }

                $star_p = $product->rating;
                $rating_p = floor($product->rating);
                $unrating_p = 5-$rating_p;

                $array_star = array();
                $array_star_v2 = array();

                for ($i=0; $i< $rating_p ; $i++) { 
                    $array_star[$i] = '<i class="bx bxs-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                }

                for ($i=$rating_p; $i< 5 ; $i++) { 
                    $array_star[$i] = '';
                }

                $a=0;
                for ($j=0; $j < $unrating_p ; $j++) { 

                    if ($a==0) {
                        if ($star_p == '0.5' || $star_p == '1.5' || $star_p == '2.5' || $star_p == '3.5' || $star_p == '4.5') {
        
                            $array_star_v2[$j] = '<i class="bx bxs-star-half" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                
                        }
                        else {
            
                            $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
        
                        }
                    }
                    else {
                        $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                    }
                    $a++;
                }
                for ($j=$unrating_p; $j < 5 ; $j++) { 
                    $array_star_v2[$j] = '';
                }
                $print = '
                    <div class=" col-lg-3 col-md-6 portfolio-item filter-'.$product->category_id.' wow fadeInUp list-product" style="height: 480px; padding-right: 5px; padding-left: 5px;">
                        <div class="portfolio-wrap" style="height: 470px">

                        <div class="portfolio-wrap-top">
                            <div class="category-product"><a href="'.url('/search-category/'.$product->category_id).'" class="btn btn-light" style="font-size: 13px;">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> '.$product->id_category.'</a></div>

                            <div class="sale-product"><a href="" class="btn btn-warning" style="font-size: 13px; font-weight:900">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> Giảm '.$product->ratio.'%</a></div>
                        </div>

                        '.$dicount_code.'

                        <figure style="height: 320px;">
                            <img src="'.$product->url_image .'" class="img-fluid" style="height: 100%" width="100%" alt="">
                            <a href="'.$product->url_image .'" data-gall="portfolioGallery" class="link-preview venobox" title="Xem ảnh"><i class="bx bx-plus"></i></a>
                            <a href="'.$product->url_product .' "target="_blank" class="link-details" title="Thông tin"><i class="bx bx-link"></i></a>
                        </figure>

                        <div class="portfolio-info" style="padding: 5px">
                            <a style="font-size: 16px" href="'. $product->url_product .' "target="_blank" >'.substr($product->name, 0, 35).'</a>
                            <p style="font-size: 12px">Đánh giá : 
                            '.$array_star[0].$array_star[1].$array_star[2].$array_star[3].$array_star[4].$array_star_v2[0].$array_star_v2[1].$array_star_v2[2].$array_star_v2[3].$array_star_v2[4].'
                            <span>('. $product->rating .')</span>
                            </p>
                            <h6>Giá: <del>'. $product->old_price .'</del> <span style="font-size: 22px; color:rgb(241, 101, 7); font-weight:900 ">'. $product->new_price .'</span></h6>
                            <a href="'. $product->url_product .' "target="_blank" class="btn btn-outline-primary" style="width: 80%"><span>Mua ngay</span></a>
                        </div>

                        </div>
                    </div>
                ';
                $last_id = $product->id;
                echo $print;
            }
            $btn_more='
            <div id="btn_remove2" class="container">
          <div style="margin: auto;  width: 200px; text-align: center;">
              <button id="load_more_button2" style="margin-top: 30px" onclick="clickMoreProduct2()" name="'.$last_id.'" class="btn btn-primary">Xem thêm</button>
          </div>
        </div>';
            echo $btn_more;
        }else{
            echo '
            <div id="btn_remove" class="container">
                <span style="cursor: wait"> Đang tải thêm sản phẩm...!</span>
            </div>';
        }
    }

    public function loadMoreProductSearch(Request $request){        
        $data = $request->all();
        $all_product = DB::table('tbl_product')
        ->where('status','on')
        ->where('id','<',$data['id'])
        ->orderby('id','desc')
        ->take(20)
        ->get();

        if(!$all_product->isEmpty())
        {
            foreach($all_product as $key => $product)
            {
                $text= '#copy'.$product->id;
     
                $dicount_code = '';
                if($product->discount_code)
                {
                    $dicount_code = '
                    <div class="portfolio-wrap-top bang">
                    <div class="category-product" style="top: 40px"><a data-tip="Click to copy "'.$product->discount_code.'" onclick=copyToClipboard("'.$text.'") class="btn btn-danger" style="font-size: 13px;">
                        <i style="font-size: 14px" class="bx bx-barcode-reader"></i> Mã giảm : <span id="copy'.$product->id.'">'. $product->discount_code .'</span> </a></div>
                    </div>
                    ';
                }

                $star_p = $product->rating;
                $rating_p = floor($product->rating);
                $unrating_p = 5-$rating_p;

                $array_star = array();
                $array_star_v2 = array();

                for ($i=0; $i< $rating_p ; $i++) { 
                    $array_star[$i] = '<i class="bx bxs-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                }

                for ($i=$rating_p; $i< 5 ; $i++) { 
                    $array_star[$i] = '';
                }

                $a=0;
                for ($j=0; $j < $unrating_p ; $j++) { 

                    if ($a==0) {
                        if ($star_p == '0.5' || $star_p == '1.5' || $star_p == '2.5' || $star_p == '3.5' || $star_p == '4.5') {
        
                            $array_star_v2[$j] = '<i class="bx bxs-star-half" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                
                        }
                        else {
            
                            $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
        
                        }
                    }
                    else {
                        $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                    }
                    $a++;
                }
                for ($j=$unrating_p; $j < 5 ; $j++) { 
                    $array_star_v2[$j] = '';
                }
                $print = '
                    <div class=" col-lg-3 col-md-6 portfolio-item filter-'.$product->category_id.' wow fadeInUp list-product" style="height: 480px; padding-right: 5px; padding-left: 5px;">
                        <div class="portfolio-wrap" style="height: 470px">

                        <div class="portfolio-wrap-top">
                            <div class="category-product"><a href="'.url('/search-category/'.$product->category_id).'" class="btn btn-light" style="font-size: 13px;">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> '.$product->id_category.'</a></div>

                            <div class="sale-product"><a href="" class="btn btn-warning" style="font-size: 13px; font-weight:900">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> Giảm '.$product->ratio.'%</a></div>
                        </div>

                        '.$dicount_code.'

                        <figure style="height: 320px;">
                            <img src="'.$product->url_image .'" class="img-fluid" style="height: 100%" width="100%" alt="">
                            <a href="'.$product->url_image .'" data-gall="portfolioGallery" class="link-preview venobox" title="Xem ảnh"><i class="bx bx-plus"></i></a>
                            <a href="'.$product->url_product .' "target="_blank" class="link-details" title="Thông tin"><i class="bx bx-link"></i></a>
                        </figure>

                        <div class="portfolio-info" style="padding: 5px">
                            <a style="font-size: 16px" href="'. $product->url_product .' "target="_blank" >'.substr($product->name, 0, 35).'</a>
                            <p style="font-size: 12px">Đánh giá : 
                            '.$array_star[0].$array_star[1].$array_star[2].$array_star[3].$array_star[4].$array_star_v2[0].$array_star_v2[1].$array_star_v2[2].$array_star_v2[3].$array_star_v2[4].'
                            <span>('. $product->rating .')</span>
                            </p>
                            <h6>Giá: <del>'. $product->old_price .'</del> <span style="font-size: 22px; color:rgb(241, 101, 7); font-weight:900 ">'. $product->new_price .'</span></h6>
                            <a href="'. $product->url_product .' "target="_blank" class="btn btn-outline-primary" style="width: 80%"><span>Mua ngay</span></a>
                        </div>

                        </div>
                    </div>
                ';
                $last_id = $product->id;
                echo $print;
            }
            $btn_more='
            <div id="btn_remove_search" class="container">
        <div style="margin: auto;  width: 200px; text-align: center;">
            <button type="button" style="margin-top: 30px" id="load_more_button_search" class="btn btn-primary" style="margin-top: 30px" data-sample-id="'.$last_id.'" onclick="myFunction()"> Xem thêm </button>
          </div>
      </div>';
            echo $btn_more;
        }else{
            echo '
            <div id="btn_remove" class="container">
                <span style="cursor: wait"> Đang tải thêm sản phẩm...!</span>
            </div>';
        }
    }

    public function menuSearchSuperDiscount(){
        $list_category = DB::table('tbl_category')->where('status','on')->orderby('id','desc')->get();
        $list_category_more = DB::table('tbl_category')->where('status','on')->inRandomOrder()->get();
        $product_slider = DB::table('tbl_product')->where('status','on')->inRandomOrder()->limit(8)->get();
        $product_event = DB::table('tbl_product')->where('status','on')->where('status_adv','on')->inRandomOrder()->limit(1)->get();
        $list_product = DB::table('tbl_product')->where('status','on')->orderby('ratio','desc')->limit(30)->get();
        return view('pages.search')
        ->with('list_category', $list_category)
        ->with('product_event', $product_event)
        ->with('product_slider', $product_slider)
        ->with('list_category_more', $list_category_more)
        ->with('list_product', $list_product);
    }

    public function menuSearchDiscountCode(){
        $list_category = DB::table('tbl_category')->where('status','on')->orderby('id','desc')->get();
        $list_category_more = DB::table('tbl_category')->where('status','on')->inRandomOrder()->get();
        $product_slider = DB::table('tbl_product')->where('status','on')->inRandomOrder()->limit(8)->get();
        $product_event = DB::table('tbl_product')->where('status','on')->where('status_adv','on')->inRandomOrder()->limit(1)->get();
        $list_product = DB::table('tbl_product')->where('status','on')->orderby('id','desc')->limit(30)->get();
        return view('pages.search_discount_code')
        ->with('list_category', $list_category)
        ->with('product_event', $product_event)
        ->with('product_slider', $product_slider)
        ->with('list_category_more', $list_category_more)
        ->with('list_product', $list_product);
    }

    public function categorySearchAll(){
        $list_category = DB::table('tbl_category')->where('status','on')->orderby('id','desc')->get();
        $list_category_more = DB::table('tbl_category')->where('status','on')->inRandomOrder()->get();
        $product_slider = DB::table('tbl_product')->where('status','on')->inRandomOrder()->limit(8)->get();
        $list_product_more = DB::table('tbl_product')->where('status','on')->inRandomOrder()->limit(20)->get(); 
        $product_event = DB::table('tbl_product')->where('status','on')->where('status_adv','on')
        ->inRandomOrder()->limit(1)->get();

        $list_product = DB::table('tbl_product')->where('status','on')->orderby('id','desc')->limit(30)->get();
        return view('pages.search_category_all')
        ->with('list_category', $list_category)
        ->with('product_event', $product_event)
        ->with('product_slider', $product_slider)
        ->with('list_product_more', $list_product_more)
        ->with('list_category_more', $list_category_more)
        ->with('list_product', $list_product);
    }

    public function categorySearch($parameter){
        $list_category = DB::table('tbl_category')->where('status','on')->orderby('id','desc')->get();
        $list_category_more = DB::table('tbl_category')->where('status','on')->inRandomOrder()->get();
        $product_slider = DB::table('tbl_product')->where('status','on')->inRandomOrder()->limit(8)->get();
        $list_product_more = DB::table('tbl_product')->where('status','on')->orderby('id','desc')->limit(4)->get(); 
        $product_event = DB::table('tbl_product')->where('status','on')->where('status_adv','on')
        ->where('category_id',$parameter)->inRandomOrder()->limit(1)->get();

        $list_product = DB::table('tbl_product')->where('status','on')->where('category_id',$parameter)->orderby('id','desc')->limit(30)->get();
        return view('pages.search_category')
        ->with('list_category', $list_category)
        ->with('product_event', $product_event)
        ->with('product_slider', $product_slider)
        ->with('list_product_more', $list_product_more)
        ->with('list_category_more', $list_category_more)
        ->with('list_product', $list_product);
    }

    public function loadMoreCategoryProduct(Request $request){        
        $data = $request->all();
        $all_product = DB::table('tbl_product')->where('status','on')
        ->where('category_id',$data['parameter'])
        ->where('id','<',$data['id'])
        ->orderby('id','desc')
        ->take(20)
        ->get();


        if(!$all_product->isEmpty())
        {
            foreach($all_product as $key => $product)
            {
                $text= '#copy'.$product->id;
     
                $dicount_code = '';
                if($product->discount_code)
                {
                    $dicount_code = '
                    <div class="portfolio-wrap-top bang">
                    <div class="category-product" style="top: 40px"><a data-tip="Click to copy "'.$product->discount_code.'" onclick=copyToClipboard("'.$text.'") class="btn btn-danger" style="font-size: 13px;">
                        <i style="font-size: 14px" class="bx bx-barcode-reader"></i> Mã giảm : <span id="copy'.$product->id.'">'. $product->discount_code .'</span> </a></div>
                    </div>
                    ';
                }

                $star_p = $product->rating;
                $rating_p = floor($product->rating);
                $unrating_p = 5-$rating_p;

                $array_star = array();
                $array_star_v2 = array();

                for ($i=0; $i< $rating_p ; $i++) { 
                    $array_star[$i] = '<i class="bx bxs-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                }

                for ($i=$rating_p; $i< 5 ; $i++) { 
                    $array_star[$i] = '';
                }

                $a=0;
                for ($j=0; $j < $unrating_p ; $j++) { 

                    if ($a==0) {
                        if ($star_p == '0.5' || $star_p == '1.5' || $star_p == '2.5' || $star_p == '3.5' || $star_p == '4.5') {
        
                            $array_star_v2[$j] = '<i class="bx bxs-star-half" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                
                        }
                        else {
            
                            $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
        
                        }
                    }
                    else {
                        $array_star_v2[$j] = '<i class="bx bx-star" style="font-size: 16px; color:rgb(255, 241, 47);"></i>';
                    }
                    $a++;
                }
                for ($j=$unrating_p; $j < 5 ; $j++) { 
                    $array_star_v2[$j] = '';
                }
                $print = '
                    <div class=" col-lg-3 col-md-6 portfolio-item filter-'.$product->category_id.' wow fadeInUp list-product" style="height: 480px; padding-right: 5px; padding-left: 5px;">
                        <div class="portfolio-wrap" style="height: 470px">

                        <div class="portfolio-wrap-top">
                            <div class="category-product"><a href="'.url('/search-category/'.$product->category_id).'" class="btn btn-light" style="font-size: 13px;">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> '.$product->id_category.'</a></div>

                            <div class="sale-product"><a href="" class="btn btn-warning" style="font-size: 13px; font-weight:900">
                            <i style="font-size: 14px" class="bx bx-purchase-tag-alt"></i> Giảm '.$product->ratio.'%</a></div>
                        </div>

                        '.$dicount_code.'

                        <figure style="height: 320px;">
                            <img src="'.$product->url_image .'" class="img-fluid" style="height: 100%" width="100%" alt="">
                            <a href="'.$product->url_image .'" data-gall="portfolioGallery" class="link-preview venobox" title="Xem ảnh"><i class="bx bx-plus"></i></a>
                            <a href="'.$product->url_product .' "target="_blank" class="link-details" title="Thông tin"><i class="bx bx-link"></i></a>
                        </figure>

                        <div class="portfolio-info" style="padding: 5px">
                            <a style="font-size: 16px" href="'. $product->url_product .' "target="_blank" >'.substr($product->name, 0, 35).'</a>
                            <p style="font-size: 12px">Đánh giá : 
                            '.$array_star[0].$array_star[1].$array_star[2].$array_star[3].$array_star[4].$array_star_v2[0].$array_star_v2[1].$array_star_v2[2].$array_star_v2[3].$array_star_v2[4].'
                            <span>('. $product->rating .')</span>
                            </p>
                            <h6>Giá: <del>'. $product->old_price .'</del> <span style="font-size: 22px; color:rgb(241, 101, 7); font-weight:900 ">'. $product->new_price .'</span></h6>
                            <a href="'. $product->url_product .' "target="_blank" class="btn btn-outline-primary" style="width: 80%"><span>Mua ngay</span></a>
                        </div>

                        </div>
                    </div>
                ';
                $last_id = $product->id;
                echo $print;
            }
            $btn_more='
            <div id="btn_remove_category1" class="container">
                <div style="margin: auto;  width: 200px; text-align: center;">
                    <button type="button" id="load_more_button_category1" class="btn btn-primary" style="margin-top: 30px" data-sample-par="'.$product->category_id.'" data-sample-id="'.$last_id.'" onclick="myFunction()"> Xem thêm </button>
                </div>
            </div>';
            echo $btn_more;
        }else{
            echo '
            <div id="btn_remove" class="container">
                <span style="cursor: wait"> Đang tải thêm sản phẩm...!</span>
            </div>';
        }
    }

    public function productSearch(Request $request){
        $keywords = $request->key;

        $list_category = DB::table('tbl_category')->where('status','on')->orderby('id','desc')->get();
        $list_category_more = DB::table('tbl_category')->where('status','on')->inRandomOrder()->get();
        $product_slider = DB::table('tbl_product')->where('status','on')->inRandomOrder()->limit(8)->get();
        $product_event = DB::table('tbl_product')->where('status','on')->where('status_adv','on')->where('name','like','%'.$keywords.'%')->inRandomOrder()->limit(1)->get();

        $list_product = DB::table('tbl_product')->where('status','on')->where('name','like','%'.$keywords.'%')->inRandomOrder()->limit(30)->get(); 

        Session::put('msg_user','Kết quả tìm kiếm của "'.$keywords.'"');

        if(count($list_product) == 0)
        {
            Session::put('msg_user','Không tìm thấy kết quả tìm kiếm của "'.$keywords.'"');
            $list_product = DB::table('tbl_product')->where('status','on')->inRandomOrder()->limit(30)->get(); 
        }

        $list_product_more = DB::table('tbl_product')->where('status','on')->orderby('id','desc')->limit(20)->get(); 

        return view('pages.search_product')
        ->with('list_category', $list_category)
        ->with('product_event', $product_event)
        ->with('product_slider', $product_slider)
        ->with('list_category_more', $list_category_more)
        ->with('list_product_more', $list_product_more)
        ->with('list_product', $list_product);
    }
}
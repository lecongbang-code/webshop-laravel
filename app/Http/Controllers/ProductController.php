<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function authLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id)
        {
            return Redirect::to('admin');
        }
        else
        {
            return Redirect::to('admin-login')->send();
        }
    }

    public function listProduct(){
        $this->authLogin();
        $list_product = DB::table('tbl_product')->orderby('id','desc')->get();
    	$manager_product = view('admin.list_product')->with('list_product',$list_product);
    	return view('admin_layout')->with('admin.list_product', $manager_product);
    }

    public function deleteProduct($id){
        $this->authLogin();
        DB::table('tbl_product')->where('id',$id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('list-product');
    }

    public function addProduct(){
        $this->authLogin();
        $list_category = DB::table('tbl_category')->orderby('id','desc')->get();
        return view('admin.add_product')->with('list_category', $list_category);
    }

    public function postAddProduct(Request $request){
        $this->authLogin();
    	$data = array();
        
    	$data['id_category'] = $request->id_category;
    	$data['category_id'] = $request->category_id;
    	$data['trademark'] = $request->name_trademark;
    	$data['name'] = $request->name_product;
    	$data['url_image'] = $request->url_image;
    	$data['url_product'] = $request->url_product;
    	$data['description'] = $request->description;
    	$data['old_price'] = $request->old_price;
    	$data['new_price'] = $request->new_price;
    	$data['discount_code'] = $request->discount_code;
        $data['ratio'] = $request->ratio;
        $data['assessor'] = $request->assessor;
        $data['rating'] = $request->rating;
        $data['status'] = $request->status;
        $data['status_adv'] = 'off';

        if($data['status'] == "")
        {
            $data['status'] = "off";
        }

        if($data['discount_code'] == "")
        {
            $data['discount_code'] = "";
        }

        if($data['trademark'] == "")
        {
            $data['trademark'] = "";
        }

        if($data['description'] == "")
        {
            Session::put('message_error','Cần cung cấp mô tả sản phẩm! Bạn đã để trống thông tin này.');
            return Redirect::to('add-product');
        }
        else
        {
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công!');
            return Redirect::to('add-product');
        }
    }

    public function unactiveProductAdv($id){
        $this->authLogin();
        $data['status_adv'] = 'off';

        DB::table('tbl_product')->where('id',$id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công!');
        return Redirect::to('list-product');
    }

    public function activeProductAdv($id){
        $this->authLogin();
        $data['status_adv'] = 'on';

        DB::table('tbl_product')->where('id',$id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công!');
        return Redirect::to('list-product');
    }

    public function unactiveProduct($id){
        $this->authLogin();
        $data['status'] = 'off';

        DB::table('tbl_product')->where('id',$id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công!');
        return Redirect::to('list-product');
    }

    public function activeProduct($id){
        $this->authLogin();
        $data['status'] = 'on';

        DB::table('tbl_product')->where('id',$id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công!');
        return Redirect::to('list-product');
    }

    public function editProduct($id){
        $this->authLogin();
        // lấy dữ liệu bởi id
        $edit_product = DB::table('tbl_product')->where('id',$id)->get();
        $list_category = DB::table('tbl_category')->orderby('id','desc')->get();
        return view('admin.edit_product')->with('edit_product', $edit_product)->with('list_category', $list_category);
    }

    public function updateProduct(Request $request,$id){
        $this->authLogin();
        // cập nhật dữ liệu
        $data = array();
        
    	$data['id_category'] = $request->id_category;
    	$data['category_id'] = $request->category_id;
    	$data['trademark'] = $request->name_trademark;
    	$data['name'] = $request->name_product;
    	$data['url_image'] = $request->url_image;
    	$data['url_product'] = $request->url_product;
    	$data['description'] = $request->description;
    	$data['old_price'] = $request->old_price;
    	$data['new_price'] = $request->new_price;
    	$data['discount_code'] = $request->discount_code;
        $data['ratio'] = $request->ratio;
        $data['assessor'] = $request->assessor;
        $data['rating'] = $request->rating;
        $data['status'] = $request->status;

        if($data['status'] == "")
        {
            $data['status'] = "off";
        }

        if($data['discount_code'] == "")
        {
            $data['discount_code'] = "";
        }

        if($data['trademark'] == "")
        {
            $data['trademark'] = "";
        }

        if($data['description'] == "")
        {
            Session::put('message_error','Cần cung cấp mô tả sản phẩm! Bạn đã để trống thông tin này.');
            return Redirect::to('edit-product/'.$id);
        }
        else
        {
            DB::table('tbl_product')->where('id',$id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công!');
            return Redirect::to('list-product');
        }
    }
    
}

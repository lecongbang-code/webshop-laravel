<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BannerController extends Controller
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

    public function listBanner(){
        $this->authLogin();
        $list_banner = DB::table('tbl_product')->where('status_adv','on')->get();
        $manager_banner = view('admin.list_banner')->with('list_banner',$list_banner);
        return view('admin_layout')->with('admin.list_banner', $manager_banner);
    }

    public function addBanner(){
        $this->authLogin();
    	return view('admin.add_banner');
    }

    public function unactiveProductAdv($id){
        $this->authLogin();
        $data['status_adv'] = 'off';

        DB::table('tbl_product')->where('id',$id)->update($data);
        Session::put('message','Cập nhật thành công!');
        return Redirect::to('list-banner');
    }

    public function unactiveProduct($id){
        $this->authLogin();
        $data['status'] = 'off';

        DB::table('tbl_product')->where('id',$id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công!');
        return Redirect::to('list-banner');
    }

    public function activeProduct($id){
        $this->authLogin();
        $data['status'] = 'on';

        DB::table('tbl_product')->where('id',$id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công!');
        return Redirect::to('list-banner');
    }

    public function deleteProduct($id){
        $this->authLogin();
        DB::table('tbl_product')->where('id',$id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('list-banner');
    }
}

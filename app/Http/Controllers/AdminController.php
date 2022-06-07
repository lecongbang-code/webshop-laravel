<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Social;
use Socialite;
use App\Login;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
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

    public function admin(){
        $this->authLogin();
        $list_view = DB::table('tbl_view')->where('id',1)->get();
    	return view('admin.admin')
        ->with('list_view', $list_view);
    }

    public function adminLogin(){
    	return view('admin.admin_login');
    }

    public function postAdminLogin(Request $request){
        $data = array();
        
    	$data['username'] = $request->username;
        $data['password'] = md5($request->password);

        $result = DB::table('tbl_user')->where('username',$data['username'])->where('password',$data['password'])->first();
        if($result)
        {
            Session::put('admin_id',$result->id);
            Session::put('admin_name',$result->name);
            Session::put('admin_username',$result->username);
            Alert::success('Đăng nhập thành công', 'Nhấp "OK" để tiếp tục');
            Session::put('message','Đăng nhập thành công!');
            return Redirect::to('admin');
        }
        else{
            Session::put('message_error_login','Tài khoản hoặc mật khẩu không đúng!');
            return Redirect::to('admin-login');
        }
    }

    public function adminSignup(){
    	return view('admin.admin_signup');
    }

    public function postAdminSignup(Request $request){
    	$data = array();

    	$data['name'] = $request->name;
    	$data['username'] = $request->username;
    	$data['password'] = $request->password;
    	$data['level'] = 1;
        $rpassword = $request->rpassword;

        if($rpassword != $data['password'])
        {
            Session::put('message_error','Mật khẩu nhập lại không đúng!');
            return Redirect::to('admin-signup');
        }
        else
        {
            $result = DB::table('tbl_user')->where('username',$data['username'])->first();

            if($result)
            {
                Session::put('message_error','Tài khoản đã tồn tại!');
                return Redirect::to('admin-signup');
            }
            else
            {
                $data['password'] = md5($request->password);
                DB::table('tbl_user')->insert($data);
                Session::put('message','Đăng ký thành công!');
                return Redirect::to('admin-login');
            } 
        }
    }

    public function logOut(){
        $this->authLogin();
        Session::put('admin_name',null);
        Session::put('admin_username',null);
        Session::put('admin_id',null);
        return Redirect::to('/');
    }
}
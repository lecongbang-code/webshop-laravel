<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryController extends Controller
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

    public function listCategory(){
        $this->authLogin();
        $list_category = DB::table('tbl_category')->get();
    	$manager_category = view('admin.list_category')->with('list_category',$list_category);
    	return view('admin_layout')->with('admin.list_category', $manager_category);
    }

    public function addCategory(){
        $this->authLogin();
    	return view('admin.add_category');
    }

    public function postAddCategory(Request $request){
        $this->authLogin();
    	$data = array();
        
    	$data['name'] = $request->name_category;
        $data['description'] = $request->des_category;
        $data['status'] = $request->status_category;

        if($data['status'] == "")
        {
            $data['status'] = "off";
        }

    	DB::table('tbl_category')->insert($data);
    	Session::put('message','Thêm danh mục sản phẩm thành công!');
    	return Redirect::to('add-category');
    }

    public function deleteCategory($id){
        $this->authLogin();
        DB::table('tbl_category')->where('id',$id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('list-category');
    }

    public function editCategory($id){
        $this->authLogin();
        // lấy dữ liệu bởi id
        $edit_category = DB::table('tbl_category')->where('id',$id)->get();
        $manager_category  = view('admin.edit_category')->with('edit_category',$edit_category);
        return view('admin_layout')->with('admin.edit_category', $manager_category);
        // return view('/admin.edit_category');
    }

    public function updateCategory(Request $request,$id){
        $this->authLogin();
        // cập nhật dữ liệu
        $data = array();

    	$data['name'] = $request->name_category;
        $data['description'] = $request->des_category;
        $data['status'] = $request->status_category;

        if($data['status'] == "")
        {
            $data['status'] = "off";
        }
    	
        DB::table('tbl_category')->where('id',$id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công!');
        return Redirect::to('list-category');
    }

    public function unactiveCategory($id){
        $this->authLogin();
        $data['status'] = 'off';

        DB::table('tbl_category')->where('id',$id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công!');
        return Redirect::to('list-category');
    }

    public function activeCategory($id){
        $this->authLogin();
        $data['status'] = 'on';

        DB::table('tbl_category')->where('id',$id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công!');
        return Redirect::to('list-category');
    }
}
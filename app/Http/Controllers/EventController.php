<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class EventController extends Controller
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

    public function listEvent(){
        $this->authLogin();
        $list_event = DB::table('tbl_banner')->get();
    	$manager_event = view('admin.list_event')->with('list_event',$list_event);
    	return view('admin_layout')->with('admin.list_event', $manager_event);
    }

    public function deleteEvent($id){
        $this->authLogin();
        DB::table('tbl_banner')->where('id',$id)->delete();
        Session::put('message','Xóa sự kiện thành công');
        return Redirect::to('list-event');
    }

    public function addEvent(){
        $this->authLogin();
        return view('admin.add_event');
    }

    public function postAddEvent(Request $request){
        $this->authLogin();
    	$data = array();
        
    	$data['title'] = $request->title;
    	$data['content'] = $request->content;
    	$data['url_image'] = $request->url_image;
    	$data['image'] = $request->image;
    	$data['url_event'] = $request->url_event;
        $data['status'] = $request->status;
        $get_image = $request->file('image');

        if($data['status'] == "")
        {
            $data['status'] = "off";
        }

        if($data['url_image'] == "")
        {
            $data['url_image']=="bang.png";
        }

        if($data['title'] == "")
        {
            Session::put('message_error','Tiêu đề sự kiện không được để trống!');
        }
        else
        {
            if($data['content'] == "")
            {
                Session::put('message_error','Nội dung sự kiện không được để trống!');
            }
        }
        

        if($data['content']!="" && $data['title']!="" )
        {
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/banner',$new_image);
                $data['image'] = $new_image;
    
                DB::table('tbl_banner')->insert($data);
                Session::put('message','Thêm sự kiện thành công!');
                return Redirect::to('list-event');
            }
            else
            {
                $data['image'] = '';
                DB::table('tbl_banner')->insert($data);
                Session::put('message','Thêm sự kiện thành công!');
                return Redirect::to('list-event');
            }
        }
        else
        {
            return Redirect::to('add-event');
        }
        
    }

    public function unactiveEvent($id){
        $this->authLogin();
        $data['status'] = 'off';

        DB::table('tbl_banner')->where('id',$id)->update($data);
        Session::put('message','Cập nhật sự kiện thành công!');
        return Redirect::to('list-event');
    }

    public function activeEvent($id){
        $this->authLogin();
        $data['status'] = 'on';

        DB::table('tbl_banner')->where('id',$id)->update($data);
        Session::put('message','Cập nhật sự kiện thành công!');
        return Redirect::to('list-event');
    }

    public function editEvent($id){
        $this->authLogin();
        // lấy dữ liệu bởi id
        $edit_event = DB::table('tbl_banner')->where('id',$id)->get();
        return view('admin.edit_event')->with('edit_event', $edit_event);
    }

    public function updateEvent(Request $request,$id){
        $this->authLogin();
        // cập nhật dữ liệu
        $data = array();
        
    	$data['title'] = $request->title;
    	$data['content'] = $request->content;
    	$data['url_image'] = $request->url_image;
    	$data['url_event'] = $request->url_event;
        $data['status'] = $request->status;
        $get_image = $request->file('image');

        if($data['status'] == "")
        {
            $data['status'] = "off";
        }

        if($data['title'] == "")
        {
            Session::put('message_error','Tiêu đề sự kiện không được để trống!');
        }
        else
        {
            if($data['content'] == "")
            {
                Session::put('message_error','Nội dung sự kiện không được để trống!');
            }
        }

        if($data['content']!="" && $data['title']!="" )
        {

            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/banner',$new_image);
                $data['image'] = $new_image;

                DB::table('tbl_banner')->where('id',$id)->update($data);
                Session::put('message','Cập nhật sự kiện thành công!');
                return Redirect::to('list-event');
            }
            else
            {
                DB::table('tbl_banner')->where('id',$id)->update($data);
                Session::put('message','Cập nhật sự kiện thành công!');
                return Redirect::to('list-event');
            }
            
        }
        else
        {
            return Redirect::to('edit-event/'.$id);
        }
    }
}
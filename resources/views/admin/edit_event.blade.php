@extends('admin_layout')
@section('admin_content')

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Sự kiện - Cập nhật kiện</h3>
                    <p class="text-subtitle text-muted">Cần thực hiện điền đầy đủ thông tin</p>
                </div>
            </div>
        </div>

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<div class="alert alert-info" role="alert">'.$message.'</div>';
                                    Session::put('message',null);
                                }
                            ?>
                            <?php
                                $message_error = Session::get('message_error');
                                if($message_error){
                                    echo '<div class="alert alert-danger" role="alert">'.$message_error.'</div>';
                                    Session::put('message_error',null);
                                }
                            ?>
                            <h4 class="card-title">Cập nhật sự kiện</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @foreach($edit_event as $key => $value_edit)
                                <form class="form form-horizontal" action="{{URL::to('/update-event/'.$value_edit->id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-2">
                                                <label>Tiêu đề sự kiện</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <textarea id="demo" required class="ckeditor" cols="30" rows="10" name="title">@php
                                                    echo $value_edit->title
                                                @endphp</textarea>
                                            </div>

                                            <div class="col-md-2">
                                                <label>URL hình ảnh sự kiện</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    name="url_image" value="{{($value_edit->url_image)}}" required placeholder="URL ảnh đang trống">
                                            </div>

                                            <div class="col-md-2">
                                                <label>URL sự kiện</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    name="url_event" value="{{($value_edit->url_event)}}" required placeholder="URL sự kiện đang trống">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Nội dung sự kiện</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <textarea id="demo" required class="ckeditor" cols="30" rows="10" name="content">@php
                                                    echo $value_edit->content
                                                @endphp</textarea>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label>Tải lên hình ảnh</label>
                                            </div>

                                            <div class="col-md-10 form-group">
                                                <img width="700" height="300" style="margin-bottom: 10px" src="{{asset('public/uploads/banner/'.$value_edit->image)}}" alt="">
                                                <input type="file" class="form-control"
                                                    name="image" placeholder="Giá cũ đang trống">
                                            </div>

                                            <div class="col-12 col-md-8 offset-md-2 form-group">
                                                <div class='form-check'>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="checkbox1"
                                                            class='form-check-input' name="status" @php
                                                            if($value_edit->status == 'on')
                                                            echo 'checked';
                                                        @endphp>
                                                        <label for="checkbox1">Trạng thái</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="button"
                                                    class="btn btn-light-secondary me-1 mb-1"><a href="{{url('/list-event')}}">Quay lại</a></button>
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1" name="edit_event">Cập nhật sự kiện</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Nhập lại</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2021 &copy; Bang</p>
            </div>
        </div>
    </footer>
</div>

@endsection
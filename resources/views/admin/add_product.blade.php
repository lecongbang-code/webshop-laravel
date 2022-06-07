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
                    <h3>Sản phẩm - Thêm sản phẩm mới</h3>
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
                            <h4 class="card-title">Thêm sản phẩm mới</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" action="{{URL::to('/post-add-product')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Thể loại sản phẩm</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <select class="choices form-select" name="id_category">
                                                    @foreach($list_category as $key => $category)
                                                        @php
                                                            if($category->status == 'on')
                                                            {
                                                                echo '<option value="'.$category->name.'">'.$category->name.'</option>' ;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Xác nhận lại thể loại sản phẩm</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <select class="choices form-select" name="category_id">
                                                    @foreach($list_category as $key => $category)
                                                        @php
                                                            if($category->status == 'on')
                                                            {
                                                                echo '<option value="'.$category->id.'">'.$category->name.'</option>' ;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Tên thương hiệu của sản phẩm</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    name="name_trademark" placeholder="(Nếu có)">
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label>Tên sản phẩm</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    name="name_product" required placeholder="Tên sản phẩm đang trống">
                                            </div>

                                            <div class="col-md-2">
                                                <label>URL hình ảnh sản phẩm</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    name="url_image" required placeholder="URL ảnh đang trống">
                                            </div>

                                            <div class="col-md-2">
                                                <label>URL sản phẩm</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    name="url_product" required placeholder="URL sản phẩm đang trống">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Mô tả sản phẩm</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <textarea id="demo" required class="ckeditor" cols="30" rows="10" name="description"></textarea>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label>Giá cũ</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    name="old_price" required placeholder="Giá cũ đang trống">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Giá mới</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    name="new_price" required placeholder="Giá mới đang trống">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Mã giảm</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    name="discount_code" placeholder="(Nếu có)">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Giảm (%)</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="number" class="form-control"
                                                    name="ratio" required placeholder="Tỉ lệ giảm giá đang trống">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Số người đánh giá</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="number" class="form-control"
                                                    name="assessor" required placeholder="Số người đánh giá đang trống">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Xếp hạng sao</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control"
                                                    name="rating" required placeholder="Lưu ý số sao từ (1-5)">
                                            </div>

                                            <div class="col-12 col-md-8 offset-md-2 form-group">
                                                <div class='form-check'>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="checkbox1"
                                                            class='form-check-input' name="status" checked>
                                                        <label for="checkbox1">Trạng thái</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="button"
                                                    class="btn btn-light-secondary me-1 mb-1"><a href="{{url('/list-product')}}">Quay lại</a></button>
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1" name="add_product">Thêm sản phẩm</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Nhập lại</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
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
                    <h3>Thể loại - Thêm thể loại sản phẩm mới</h3>
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
                            <h4 class="card-title">Thêm thể loại sản phẩm mới</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" action="{{URL::to('/post-add-category')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="row">
                                           
                                            <div class="col-md-2">
                                                <label>Tên thể loại sản phẩm</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <input type="text" class="form-control" required
                                                    name="name_category" placeholder="Tên sản thể loại phẩm đang trống">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Mô tả thể loại sản phẩm</label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" name="des_category" required
                                                        rows="3" placeholder="Hãy mô tả thông tin thể loại sản phẩm"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-8 offset-md-2 form-group">
                                                <div class='form-check'>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="checkbox1" name="status_category"
                                                            class='form-check-input' checked>
                                                        <label for="checkbox1">Trạng thái</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="button"
                                                    class="btn btn-light-secondary me-1 mb-1"><a href="{{url('/list-category')}}">Quay lại</a></button>
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1" name="add_category">Thêm thể loại</button>
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
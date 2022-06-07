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
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<div class="alert alert-info" role="alert">'.$message.'</div>';
                            Session::put('message',null);
                        }
                    ?>
                    <h3>Thể loại - Danh sách thể loại</h3>
                    <p class="text-subtitle text-muted">Thống kê tất cả các thể loại sản phẩm</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/add-category') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Thêm thể loại mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Mã ID</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach($list_category as $key => $category)
                            @php
                                $i ++;
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><h6>TL00{{ $category->id }}</h6></td>
                                <td><h6>{{substr($category->name, 0, 80)}}</h6></td>
                                <td><h6>{{substr($category->description, 0, 100)}}</h6></td>
                                <td>
                                    <?php
                                        if($category->status=='on'){
                                            ?>
                                            <a href="{{URL::to('/unactive-category/'.$category->id)}}"><span class="btn btn-success"><i class="bi bi-eye"></i> </span></a>
                                            <?php
                                            }else{
                                            ?>  
                                            <a href="{{URL::to('/active-category/'.$category->id)}}"><span class="btn btn-dark"><i class="bi bi-eye"></i> </span></a>
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a href="{{url('/edit-category/'.$category->id)}}"><span class="btn btn-warning"><i class="bi bi-pencil-square"></i></span></a>
                                    <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{URL::to('/delete-category/'.$category->id)}}">
                                        <span class="btn btn-danger"><i class="bi bi-trash"></i></span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
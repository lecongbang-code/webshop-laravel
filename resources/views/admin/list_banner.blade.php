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
                    <h3>Quảng cáo - Danh sách sản phẩm</h3>
                    <p class="text-subtitle text-muted">Thống kê tất cả các sản phẩm đang quảng cáo</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/list-product') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Thêm quảng cáo mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Hình ảnh</th>
                                <th>Thể loại</th>
                                <th>Tên sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Giá cũ</th>
                                <th>Giá mới</th>
                                <th>Mã giảm</th>
                                <th>Giảm (%)</th>
                                <th colspan="2">Trạng thái</th>
                                <th colspan="2">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach($list_banner as $key => $product)
                            @php
                                $i ++;
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><div style="width: 220px; height:220px; background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRY7_ZjEsouGOxfokCzK8guzMrRXN-_C7iz2w&usqp=CAU')">
                                    <a href="{{$product->url_product}}"><img width="220" height="220" src="{{$product->url_image}}" alt="{{$product->name}}"></a>
                                </div></td>
                                <td>{{$product->id_category}}</td>
                                <td><a href="{{$product->url_product}}"><h6>{{substr($product->name, 0, 80)}}</h6></a></td>
                                <td><h6>@php
                                    echo (substr($product->description, 0, 100));
                                @endphp</h6></td>
                                <td><del><h6>{{$product->old_price}}</h6></del></td>
                                <td><h6>{{$product->new_price}}</h6></td>
                                <td><h6>{{$product->discount_code}}</h6></td>
                                <td><span class="btn btn-secondary">{{$product->ratio}}%</span></td>
                                <td>
                                    <?php
                                        if($product->status_adv=='on'){
                                            ?>
                                            <a href="{{URL::to('/unactive-product-adv-in/'.$product->id)}}"><span class="btn btn-primary"><i class="bi bi-badge-ad"></i></span></a>
                                            <?php
                                            } ?>
                                </td>
                                <td>
                                    <?php
                                        if($product->status=='on'){
                                            ?>
                                            <a href="{{URL::to('/unactive-product-in/'.$product->id)}}"><span class="btn btn-success"><i class="bi bi-eye"></i></span></a>
                                            <?php
                                            }else{
                                            ?>  
                                            <a href="{{URL::to('/active-product-in/'.$product->id)}}"><span class="btn btn-dark"><i class="bi bi-eye"></i></span></a>
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a href="{{URL::to('/edit-product/'.$product->id)}}"><span class="btn btn-warning"><i class="bi bi-pencil-square"></i></span></a>
                                </td>
                                <td>
                                    <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{URL::to('/delete-product-in/'.$product->id)}}"><span class="btn btn-danger"><i class="bi bi-trash"></i></span></a>
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
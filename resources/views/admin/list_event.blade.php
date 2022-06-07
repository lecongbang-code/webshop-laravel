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
                    <h3>Sản phẩm - Danh sách sản phẩm</h3>
                    <p class="text-subtitle text-muted">Thống kê tất cả các sản phẩm</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/add-event') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Thêm sự kiện mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Hình ảnh</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Trạng thái</th>
                                <th colspan="2">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach($list_event as $key => $event)
                            @php
                                $i ++;
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><div style="width: 500px; height:220px; background-image: 
                                url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRY7_ZjEsouGOxfokCzK8guzMrRXN-_C7iz2w&usqp=CAU')">
                                    <a href="{{$event->url_event}}"><img width="500" height="220" src="{{asset('public/uploads/banner/'.$event->image)}}" alt="{{$event->title}}"></a>
                                </div></td>
                                
                                <td><a href="{{$event->url_event}}">@php
                                    echo $event->title;
                                @endphp</a></td>

                                <td><h6>@php
                                    echo (substr($event->content, 0, 100));
                                @endphp</h6></td>
                                <td>
                                    <?php
                                        if($event->status=='on'){
                                            ?>
                                            <a href="{{URL::to('/unactive-event/'.$event->id)}}"><span class="btn btn-success"><i class="bi bi-eye"></i></span></a>
                                            <?php
                                            }else{
                                            ?>  
                                            <a href="{{URL::to('/active-event/'.$event->id)}}"><span class="btn btn-dark"><i class="bi bi-eye"></i></span></a>
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a href="{{URL::to('/edit-event/'.$event->id)}}"><span class="btn btn-warning"><i class="bi bi-pencil-square"></i></span></a>
                                </td>
                                <td>
                                    <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{URL::to('/delete-event/'.$event->id)}}"><span class="btn btn-danger"><i class="bi bi-trash"></i></span></a>
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
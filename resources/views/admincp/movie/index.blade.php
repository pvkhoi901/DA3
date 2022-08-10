@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <a href="{{route('movie.create')}}" class="btn btn-primary">Thêm phim</a>
        <br></br>
            <table class="table" id="tablePhim">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Image</th>
                        <th scope="col">Hot</th>
                        <th scope="col">Resolution</th>
                        <th scope="col">Vietsub</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Active/Inactive</th>
                        <th scope="col">Category</th>
                        <th scope="col">Country</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Update_at</th>
                        <th scope="col">Year</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $cate) 
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td>{{$cate->title}}</td>
                            <td>{{$cate->duration}}</td>
                            <td><img width = "60%" src="{{asset('uploads/movie/'.$cate->image)}}"></td>
                            <td>
                                @if($cate->phim_hot)
                                    Có
                                @else
                                    Không
                                @endif
                            </td>
                            <td>
                                @if($cate->resolution==1)
                                    SD
                                @elseif($cate->resolution==0)
                                    HD
                                @elseif($cate->resolution==2)
                                    HDCam
                                @elseif($cate->resolution==3)
                                    Cam
                                @elseif($cate->resolution==4)
                                    FullHD
                                @else
                                    Trailer
                                @endif
                            </td>
                            <td>
                                @if($cate->vietsub)
                                    Thuyết minh                      
                                @else
                                    Phụ đề
                                @endif
                            </td>
                            <td>{{$cate->slug}}</td>
                            <td>
                                @if($cate->status)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td>{{$cate->category->title}}</td>
                            <td>{{$cate->country->title}}</td>
                            <td>{{$cate->genre->title}}</td>
                            <td>{{$cate->created_at}}</td>
                            <td>{{$cate->updated_at}}</td>
                            <td>
                                {!! Form::selectYear('year', 2005, 2022, isset($cate->year) ? $cate->year : ' ', ['class'=>'select-year', 'id'=>$cate->id]) !!}
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE','route'=>['movie.destroy', $cate->id], 'onsubmit'=>'return confirm("Xóa?")']) !!}
                                {!! Form::submit('Xóa', ['class'=> 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                <a href="{{route('movie.edit', $cate->id)}}" class="btn btn-warning">Sửa</a>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
             </table>
        </div>
    </div>
</div>
@endsection

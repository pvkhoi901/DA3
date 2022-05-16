@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý danh muc</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($category))
                        {!! Form::open(['route' => 'category.store', 'method'=>'POST']) !!}
                    @else
                        {!! Form::open(['route' => ['category.update', $category->id],'method'=>'PUT']) !!}
                    @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($category) ? $category->title :'', ['class' => 'form-control', 'placeholder'=>'Nhập vào dữ liệu', 'id'=>'title_danh muc'])!!}
                            @error('title')
                                <span style = "color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($category) ? $category->description :'', ['style'=> 'resize:none', 'class' => 'form-control', 'placeholder'=>'Nhập vào dữ liệu', 'id'=>'title_danh muc'])!!}
                            @error('description')
                                <span style = "color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('active', 'Active', []) !!}
                            {!! Form::select('status', ['1'=>'Hiển thị', '0'=>'Không hiển thị'], isset($category) ? $category->status :'', ['class' => 'form-control']) !!}
                        </div>
                        @if(!isset($category)) 
                            {!! Form::submit('Thêm dữ liệu', ['class'=> 'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class'=> 'btn btn-success']) !!}
                        @endif

                    {!! Form::close() !!}
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Manage</th>
                    

                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $key => $cate) 
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td>{{$cate->title}}</td>
                            <td>{{$cate->description}}</td>
                            <td>
                                @if($cate->status)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE','route'=>['category.destroy', $cate->id], 'onsubmit'=>'return confirm("Xóa?")']) !!}
                                {!! Form::submit('Xóa', ['class'=> 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                <a href="{{route('category.edit', $cate->id)}}" class="btn btn-warning">Sửa</a>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
             </table>
        </div>
    </div>
</div>
@endsection

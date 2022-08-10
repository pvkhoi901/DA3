@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{route('movie.index')}}" class="btn btn-primary">Liệt kê phim</a>
                <div class="card-header">Quản lý phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($movie))
                        {!! Form::open(['route' => 'movie.store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route' => ['movie.update', $movie->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}
                    @endif
                    <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title :'', ['class' => 'form-control', 'placeholder'=>'Nhập vào dữ liệu', 'id'=>'slug', 'onkeyup' => 'ChangeToSlug()'])!!}
                            @error('title')
                                <span style = "color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('duration', 'Duration', []) !!}
                            {!! Form::text('duration', isset($movie) ? $movie->duration :'', ['class' => 'form-control', 'placeholder'=>'Nhập vào dữ liệu'])!!}
                            @error('duration')
                                <span style = "color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug :'', ['class' => 'form-control', 'placeholder'=>'Nhập vào dữ liệu', 'id'=>'convert_slug'])!!}                         
                        </div>
                        <div class="form-group">
                            {!! Form::label('name_eng', 'English', []) !!}
                            {!! Form::text('name_eng', isset($movie) ? $movie->name_eng :'', ['class' => 'form-control', 'placeholder'=>'Nhập vào dữ liệu', 'id'=>'convert_slug'])!!}                         
                        </div>     
                        <div class="form-group">
                            {!! Form::label('link', 'Link phim', []) !!}
                            {!! Form::text('link', isset($movie) ? $movie->link :'', ['class' => 'form-control', 'placeholder'=>'Nhập link phim'])!!}                         
                        </div> 
                        <div class="form-group">
                            {!! Form::label('trailer', 'Trailer', []) !!}
                            {!! Form::text('trailer', isset($movie) ? $movie->trailer :'', ['class' => 'form-control', 'placeholder'=>'Nhập vào dữ liệu'])!!}                         
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description :'', ['style'=> 'resize:none', 'class' => 'form-control', 'placeholder'=>'Nhập vào dữ liệu', 'id'=>'title_danh muc'])!!}
                            @error('description')
                                <span style = "color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('tags', 'Tags', []) !!}
                            {!! Form::textarea('tags', isset($movie) ? $movie->tags :'', ['style'=> 'resize:none', 'class' => 'form-control', 'placeholder'=>'Nhập vào dữ liệu'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('active', 'Active', []) !!}
                            {!! Form::select('status', ['1'=>'Hiển thị', '0'=>'Không hiển thị'], isset($movie) ? $movie->status :'', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('resolution', 'Resolution', []) !!}
                            {!! Form::select('resolution', ['0'=>'HD', '1'=>'SD', '2'=>'HDCam', '3'=>'Cam', '4'=>'FulHD', '5'=>'Trailer'], isset($movie) ? $movie->resolution :'', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('vietsub', 'Vietsub', []) !!}
                            {!! Form::select('vietsub', ['0'=>'Phụ đề', '1'=>'Thuyết minh'], isset($movie) ? $movie->vietsub :'', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category', 'Category', []) !!}
                            {!! Form::select('category_id', $category , isset($movie) ? $movie->category_id :'', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('country', 'Country', []) !!}
                            {!! Form::select('country_id', $country , isset($movie) ? $movie->country_id :'', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('genre', 'Genre', []) !!} <br>
                            {!! Form::select('genre_id', $genre , isset($movie) ? $movie->genre_id :'', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('hot', 'Hot', []) !!}
                            {!! Form::select('phim_hot', ['1'=>'Có', '0'=>'Không'], isset($movie) ? $movie->phim_hot :'', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('image', 'Image', []) !!}
                            {!! Form::file('image', ['class' => 'form-control-file']) !!}
                            
                        </div>
                        
                        @if(!isset($movie)) 
                            {!! Form::submit('Thêm dữ liệu', ['class'=> 'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class'=> 'btn btn-success']) !!}
                        @endif

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

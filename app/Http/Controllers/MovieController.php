<?php

namespace App\Http\Controllers;
use App\Http\Requests\Movie\StoreRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Http\Requests\Movie\UpdateYearRequest;
use App\Http\Requests\Movie\UpdateTopViewRequest;
use File;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category', 'genre', 'country')->orderBy('id', 'DESC')->get();
        $path = public_path()."/json/";
        if(!is_dir($path)) { mkdir($path,0777,true); }
        File::put($path.'movies.json', json_encode($list)); 
        return view('admincp.movie.index',[
            'list'=> $list,
            
        ]);
    }
    public function updateYear(UpdateYearRequest $request){
        $data = $request->only(['year']);
    
        $movie = Movie::find($request->id_movie);
        $movie->update($data);
        
        // $movie->year = $data['year'];
        // $movie->save();      
    }
    public function updateTopView(UpdateTopViewRequest $request){
        $data = $request->only(['topview']);
    
        $movie = Movie::find($request->id_movie);
        $movie->update($data);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $list_genre = Genre::all();
        $list = Movie::with('category', 'genre', 'country')->orderBy('id', 'DESC')->get();
        
    
        return view('admincp.movie.form',[
            'category' => $category,
            'country' => $country,
            'genre' => $genre,
            'list_genre' => $list_genre,
            'list'=> $list,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $get_image = $request->file('image');

        if($get_image){    
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/', $new_image);
            $data['image'] = $new_image;  
             
        }
        $movie = Movie::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $list = Movie::with('category', 'genre', 'country')->orderBy('id', 'DESC')->get();
        return view('admincp.movie.form',[
            'category' => $category,
            'country' => $country,
            'genre' => $genre,
            'list'=> $list,
            'movie' => $movie,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Movie $movie)
    {
        $data = $request->all();
        $get_image = $request->file('image');
        if($get_image){   
            if(!empty($movie->image)){
                unlink('uploads/movie/'.$movie->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/', $new_image);
            $data['image'] = $new_image;   
             
        }
        
        $movie->update($data); 
        return redirect()->back();
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        
        if(!empty($movie->image)){
            unlink('uploads/movie/'.$movie->image);
        }
        $movie->delete();
        return redirect()->back();
    }
}

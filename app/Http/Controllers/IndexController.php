<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie;

class IndexController extends Controller
{
    public function home(){
        $phimhot = Movie::where('phim_hot', config('phimhot.hot'))->where('status',config('status.showLayout'))->get();
        $category = Category::orderBy('position', 'ASC')->where('status',config('status.showLayout'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $category_home = Category::with('movies')->orderBy('id', 'DESC')->where('status',config('status.showLayout'))->get();

        return view('pages.home', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'category_home' => $category_home,
            'phimhot' => $phimhot,
        ]);
    }
    public function category($slug){
        $category = Category::orderBy('position', 'ASC')->where('status', config('status.showLayout'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $category_slug = Category::where('slug', $slug)->firstOrFail();
        $movie = Movie::where('category_id', $category_slug->id)->paginate(40);
        return view('pages.category', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'category_slug' => $category_slug,
            'movie' => $movie,
        ]);
    }
    public function genre($slug){
        $category = Category::orderBy('position', 'ASC')->where('status', config('status.showLayout'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $genre_slug = Genre::where('slug', $slug)->firstOrFail();
        $movie = Movie::where('genre_id', $genre_slug->id)->paginate(40);


        return view('pages.genre', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'genre_slug' => $genre_slug,
            'movie' => $movie,


        ]);
    }
    public function country($slug){
        $category = Category::orderBy('position', 'ASC')->where('status', config('status.showLayout'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $country_slug = Country::where('slug', $slug)->firstOrFail();
        $movie = Movie::where('country_id', $country_slug->id)->paginate(40);


        return view('pages.country', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'country_slug' => $country_slug,
            'movie' => $movie,


        ]);
    }
    public function movie(){
        return view('pages.movie');
    }
    public function watch(){
        return view('pages.watch');
    }
    public function episode(){
        return view('pages.episode');
    }
}

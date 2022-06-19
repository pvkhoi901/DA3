<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie;
use DB;

class IndexController extends Controller
{
    public function home(){
        $phimhot = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->get();
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
        $movie = Movie::where('category_id', $category_slug->id)->orderBy('updated_at', 'DESC')->paginate(40);
        return view('pages.category', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'category_slug' => $category_slug,
            'movie' => $movie,
        ]);
    }
    public function year($year){
        $category = Category::orderBy('position', 'ASC')->where('status', config('status.showLayout'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $year = $year;
        $movie = Movie::where('year', $year)->orderBy('updated_at', 'DESC')->paginate(40);
        return view('pages.year', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'year' => $year,
            'movie' => $movie,
        ]);
    }
    public function genre($slug){
        $category = Category::orderBy('position', 'ASC')->where('status', config('status.showLayout'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $genre_slug = Genre::where('slug', $slug)->firstOrFail();
        $movie = Movie::where('genre_id', $genre_slug->id)->orderBy('updated_at', 'DESC')->paginate(40);


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
        $movie = Movie::where('country_id', $country_slug->id)->orderBy('updated_at', 'DESC')->paginate(40);


        return view('pages.country', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'country_slug' => $country_slug,
            'movie' => $movie,


        ]);
    }
    public function movie($slug){
        $category = Category::orderBy('position', 'ASC')->where('status', config('status.showLayout'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $movie = Movie::with('category', 'country', 'genre')->where('slug', $slug)->where('status', config('status.showLayout'))->firstOrFail();
        $related = Movie::with('category', 'country', 'genre')->where('category_id', $movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        return view('pages.movie',  [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'movie' => $movie,
            'related' =>$related,
        ]);
    }
    public function watch(){
        return view('pages.watch');
    }
    public function episode(){
        return view('pages.episode');
    }
}

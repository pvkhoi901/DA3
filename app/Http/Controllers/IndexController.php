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
        $category = Category::orderBy('id', 'DESC')->where('status',config('status.status'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();

        return view('pages.home', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
        ]);
    }
    public function category($slug){
        $category = Category::orderBy('id', 'DESC')->where('status', config('status.status'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $category_slug = Category::where('slug', $slug)->firstOrFail();
        return view('pages.category', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'category_slug' => $category_slug,
        ]);
    }
    public function genre($slug){
        $category = Category::orderBy('id', 'DESC')->where('status', config('status.status'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $genre_slug = Genre::where('slug', $slug)->firstOrFail();

        return view('pages.genre', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'genre_slug' => $genre_slug,

        ]);
    }
    public function country($slug){
        $category = Category::orderBy('id', 'DESC')->where('status', config('status.status'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $country_slug = Country::where('slug', $slug)->firstOrFail();

        return view('pages.country', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'country_slug' => $country_slug,

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

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
        $category = Category::orderBy('id', 'DESC')->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();

        return view('pages.home', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
        ]);
    }
    public function category(){
        return view('pages.category');
    }
    public function genre(){
        return view('pages.genre');
    }
    public function country(){
        return view('pages.country');
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

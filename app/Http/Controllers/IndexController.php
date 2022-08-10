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
    public function timKiem(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $phimhot_sidebar = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->take('20')->get();
            $category = Category::orderBy('position', 'ASC')->where('status', config('status.showLayout'))->get();
            $genre = Genre::orderBy('id', 'DESC')->get();
            $country = Country::orderBy('id', 'DESC')->get();
            $movie = Movie::where('title', 'LIKE', '%'.$search.'%')->orderBy('updated_at', 'DESC')->paginate(40);
            return view('pages.search', [
                'category' => $category,
                'genre' => $genre,
                'country' => $country,
                'search' => $search,
                'movie' => $movie,
                'phimhot_sidebar' => $phimhot_sidebar,
            ]);
        }else{
            return redirect()->to('/');
        }
    }
    public function home(){
        $phimhot = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->take('10')->get();
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
            'phimhot_sidebar' => $phimhot_sidebar,
        ]);
    }
    public function category($slug){
        $phimhot_sidebar = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->take('20')->get();
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
            'phimhot_sidebar' => $phimhot_sidebar,
        ]);
    }
    public function year($year){
        $phimhot_sidebar = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->take('20')->get();
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
            'phimhot_sidebar' => $phimhot_sidebar,
        ]);
    }
    public function tag($tag){
        $phimhot_sidebar = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->take('20')->get();
        $category = Category::orderBy('position', 'ASC')->where('status', config('status.showLayout'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $tag = $tag;
        $movie = Movie::where('tags', 'LIKE', '%' .$tag. '%')->orderBy('updated_at', 'DESC')->paginate(40);
        return view('pages.tag', [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'tag' => $tag,
            'movie' => $movie,
            'phimhot_sidebar' => $phimhot_sidebar,
        ]);
    }
    public function genre($slug){
        $phimhot_sidebar = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->take('20')->get();
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
            'phimhot_sidebar' => $phimhot_sidebar,


        ]);
    }
    public function country($slug){
        $phimhot_sidebar = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->take('20')->get();
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
            'phimhot_sidebar' => $phimhot_sidebar,


        ]);
    }
    public function movie($slug){
        $phimhot_sidebar = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->take('5')->get();
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
            'phimhot_sidebar' => $phimhot_sidebar,
        ]);
    }
    public function watch($slug){
        $phimhot_sidebar = Movie::where('phim_hot', config('phim.phimhot'))->where('status',config('status.showLayout'))->orderBy('updated_at', 'DESC')->take('5')->get();
        $category = Category::orderBy('position', 'ASC')->where('status', config('status.showLayout'))->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $movie = Movie::with('category', 'country', 'genre')->where('slug', $slug)->where('status', config('status.showLayout'))->firstOrFail();
        $related = Movie::with('category', 'country', 'genre')->where('category_id', $movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        return view('pages.watch',  [
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'related' => $related,
            'movie' => $movie,
            'phimhot_sidebar' => $phimhot_sidebar,
        ]);
    }
    public function episode(){
        return view('pages.episode');
    }
}

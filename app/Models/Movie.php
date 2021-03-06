<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function genre(){
        return $this->belongsTo(Genre::class);
    }
    use HasFactory;
}

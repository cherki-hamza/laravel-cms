<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
use App\Tag;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','description','content','image','category_id'];

    // relationship One To Many
    public function category(){
        return $this->belongsTo('App\Category');
    }

    // relationship Many To Many
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    // check if tag selected in laravel collection and also check if tag in arry of collection tags
    public function hasTag($tagId){
        return in_array($tagId , $this->tags->pluck('id')->toArray());
    }
}

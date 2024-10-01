<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Support\Str;

class Category extends Model implements  TranslatableContract
{
    use Translatable , HasFactory , SoftDeletes, HasEagerLimit;

    public $translatedAttributes = ['title', 'content', 'slug'];
    protected $fillable = [ 'id', 'image', 'parent', 'created_at', 'updated_at', 'deleted_at'];

    // protected static function booted(){
    //     static::creating(function(Category $category) {
    //         // dd(category->titel)
    //         $category->slug = Str::slug($category->title);
    //     });
    // }

    public function parents()
    {
        return $this->belongsTo(Category::class,'parent');
    }
    
    public function children()
    {
        return $this->hasMany(Category::class,'parent');
    }

    public function posts()
    {
       return $this->hasMany(Post::class);
    }

}

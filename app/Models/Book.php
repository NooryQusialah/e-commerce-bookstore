<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['title','description','isBn','coverImage','price','publishYear','numberOfPages','numberOfCopies','category_id','publisher_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);

    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function author()
    {
        return $this->belongsToMany(Author::class,'book_authors','book_id','author_id');

    }


    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


}

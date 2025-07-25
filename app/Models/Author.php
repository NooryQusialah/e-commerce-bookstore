<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['description','address','phone','user_id'];
    public function books()
    {
        return $this->belongsToMany(Book::class,'book_authors','author_id','book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}

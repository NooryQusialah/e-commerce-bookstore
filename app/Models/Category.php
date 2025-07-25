<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description','created_at','updated_at'];
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

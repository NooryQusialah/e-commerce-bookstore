<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = ['description','address','phone','user_id'];
    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

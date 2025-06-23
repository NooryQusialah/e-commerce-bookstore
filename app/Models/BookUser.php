<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    protected $fillable = ['numberOfCopies','bought','book_id','user_id','created_at'];
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;
class User extends Authenticatable
{
    use HasApiTokens;
    use Billable;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profileImage',
        'active',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function author()
    {
        return $this->hasOne(Author::class);
    }

    public function publisher()
    {
        return $this->hasOne(Publisher::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function rated(Book $book)
    {
        return $this->ratings->where('book_id',$book->id)->isNotEmpty();
    }
    public function bookRating(Book $book)
    {
        return $this->rated($book) ? $this->ratings->where('book_id',$book->id)->first() : null;
    }
    public function booksInCart(Book $book= null)
    {
        return $this->belongsToMany(Book::class,'book_users')->withPivot(['numberOfCopies','bought'])->wherePivot('bought',false);
    }

    public function ratedPurchases()
    {
        return $this->belongsToMany(Book::class,'book_users')->withPivot('bought')->wherePivot('bought',true);
    }
    public function purchaedProducts()
    {
        return $this->belongsToMany(Book::class,'book_users')->withPivot('numberOfCopies','bought','created_at')->wherePivot('bought',true)->orderBy('pivot_created_at','desc');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

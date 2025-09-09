<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area_id',
        'genre_id',
        'name',
        'image',
        'description',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function reservations()
    {
        return $this->hasMAny(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes', 'shop_id', 'user_id');
    }

    public function isLikedByAuthUser()
    {
        return $this->likes->contains('user_id', Auth::id());
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)){
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }
}

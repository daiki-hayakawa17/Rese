<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reservation extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($reservation) {
            if (empty($reservation->qr_token)) {
                $reservation->qr_token = Str::uuid();
            }
        });
    }

    protected $fillable = [
        'user_id',
        'shop_id',
        'course_id',
        'date',
        'time',
        'number',
        'qr_token',
        'checked_in',
        'checked_in_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

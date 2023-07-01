<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function commercial()
    {
        return $this->belongsTo(Commercial::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function action()
    {
        return $this->hasMany(Action::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    

    use HasFactory;

    protected $fillable = [
        'user_id',
        'trip_id',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function trip() {
        return $this->belongsTo(Trip::class);
    }
}

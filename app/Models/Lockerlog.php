<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lockerlog extends Model
{
    use HasFactory;
    protected $fillable = [
        'locker_id',
        'customer_id',
        'qr_id',
        'session_id',
        'date'
    ];

    public function customer(){
        return $this->belongsTo( Customer::class);
    }

    public function session(){
        return $this->belongsTo( Session::class);
    }

    public function locker(){
        return $this->belongsTo( locker::class);
    }
}

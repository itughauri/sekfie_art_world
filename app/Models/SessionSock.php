<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionSock extends Model
{
    protected $fillable = [
        'session_id',
        'qr_id',
        'socks',
        'date',
        'customer_id'
    ];
    use HasFactory;
}

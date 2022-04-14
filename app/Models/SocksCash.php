<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocksCash extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'session_id',
        'qr_id',
        'amount'
    ];
}

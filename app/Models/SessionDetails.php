<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionDetails extends Model
{
    protected $table = 'session_tickets';

    use HasFactory;

    protected $fillable = [
        'customer_id',
        'session_id',
        'qr_id',
        'date',
        'status',
        'socks'
    ];

    public function customer(){
        return $this->belongsTo( Customer::class);
    }

    public function session(){
        return $this->belongsTo( Session::class);
    }

    public function qr(){
        return $this->belongsTo( Qrs::class);
    }

}

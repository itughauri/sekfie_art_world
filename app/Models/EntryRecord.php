<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'qr_id',
        'customer_id',
        'session_id',
        'date'
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

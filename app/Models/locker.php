<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class locker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'allotted'
    ];

    public function lockerlogs(){
        $this->hasMany(Lockerlog::class);
    }
}

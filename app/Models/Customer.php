<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'cnic',
        'contact_no',
        'age',
        'email'
    ];

    public function tickets(){
        $this->hasMany(SessionDetails::class);
    }

    public function exit_records(){
        $this->hasMany(ExitRecord::class);
    }

    public function lockerlogs(){
        $this->hasMany(Lockerlog::class);
    }

    public function entry_records(){
        $this->hasMany(EntryRecord::class);
    }
}

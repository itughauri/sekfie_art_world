<?php

namespace App\Models;

use Illuminate\Cache\Lock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'to',
        'from',
    ];
    public function Qrs()
    {
        return $this->hasMany(Qrs::class);
    }

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

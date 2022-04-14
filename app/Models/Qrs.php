<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrs extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'allotted',
        'session_id'
    ];
    public function tickets(){
        $this->hasMany(SessionDetails::class );
    }

    public function exit_records(){
        $this->hasMany(ExitRecord::class );
    }

    public function entry_records(){
        $this->hasMany(EntryRecord::class);
    }
}

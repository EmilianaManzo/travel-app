<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;

    public function travel(){
        return $this->belongsTo(Travel::class);
    }
    protected $fillable = [
        'name',
        'slug',
        'date',
        'curiosity',
        'description',
        'latitude',
        'longitude',
        'address'
    ];
}

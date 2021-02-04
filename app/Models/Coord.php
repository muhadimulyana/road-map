<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coord extends Model
{
    use HasFactory;
    protected $table = 'gps_markers';
    protected $fillable = [
        'id',
        'place',
        'lat',
        'lng',
        'user',
        'created_date',
    ];
    public $timestamps = false;
}

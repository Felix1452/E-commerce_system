<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beca extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic',
        'nd',
        'da',
        'ndn',
        'tds',
        'ntu',
        'khoangcach',
        'ph'
    ];
}

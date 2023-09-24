<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salarys extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'basic_salary',
        'office_hours',
        'coefficients_salary',
        'overtime',
        'active',
        'salary',
        'month'
    ];
}

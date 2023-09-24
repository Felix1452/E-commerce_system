<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staffs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'mobile',
        'sex',
        'age',
        'address',
        'coefficients_salary',
        'description',
        'active'
    ];
}

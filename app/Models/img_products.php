<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class img_products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'thumb1'
    ];

    public function products(){
        return $this->hasMany(Product::class, 'id','product_id');
    }
}

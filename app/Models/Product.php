<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'image_url',
        'code',
        'price'
    ];
}

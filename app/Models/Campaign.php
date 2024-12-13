<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'campaigns';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'month',
        'products',
        'min_order_cost',
    ];

    /**
     * @return array
     */
    public function getProductsAttribute($value)
    {
        return json_decode($value, true) ?? explode(',', $value);
    }

    /**
     * @param array|string $value
     */
    public function setProductsAttribute($value)
    {
        $this->attributes['products'] = is_array($value) ? json_encode($value) : $value;
    }
}

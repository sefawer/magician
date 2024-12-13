<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'products',
        'total_cost',
        'active_campaign',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'active_campaign');
    }
}

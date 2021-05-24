<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        'quantity','wine_id','order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function wine()
    {
        return $this->belongsTo(Wine::class);
    }

}

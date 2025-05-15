<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'action',
    ];
}
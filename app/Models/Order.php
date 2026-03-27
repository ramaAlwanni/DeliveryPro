<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'totalPrice',
        'status',
        'deliveryLocation'
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }


    public function ordersItem()
    {
        return $this->hasMany(OrderItem::class);
    }






}
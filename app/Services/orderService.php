<?php

namespace App\Services;

use App\Exceptions\quantityNotEnoughException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Notifications\OrderStatusNotifications;

class orderService
{
    public function createMyOrder($request)
    {
        $user = auth()->user();
        $productInOrder = $request['product_id'];
        $productInDatabase = Product::where('id' , $productInOrder)->first();

        if($request['quantity'] > $productInDatabase->quantity){
            throw new quantityNotEnoughException();
        }
        $productInDatabase->decrement('quantity', $request['quantity']);

        $order = Order::create([
            'user_id' => $user->id,
            'totalPrice' => $productInDatabase->price * $request['quantity'],
            'deliveryLocation' => $request['deliveryLocation'],
            'status' => 'pending'
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productInOrder,
            'quantity' => $request['quantity'],
        ]);

        $user->notify(new OrderStatusNotifications($order->status));
        
    
        return $order;

    }



}
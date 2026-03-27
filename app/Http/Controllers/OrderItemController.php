<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\orderService;
use App\Trait\Response;

class OrderItemController extends Controller
{
    use Response;
    protected $orderService;
    public function __construct(orderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createOrder(OrderRequest $request)
    {
        $order = $this->orderService->createMyOrder($request->validated());
        if($order){
            return $this->SuccessResponse('Success', 'Order created successfully', $order, 200);
        }
        return $this->ErrorResponse('Error', 'created failed', null, 400);
    }
}

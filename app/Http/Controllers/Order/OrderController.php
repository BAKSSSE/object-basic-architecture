<?php

namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Order\OrderService;

class OrderController extends Controller
{

    /** 주문 하기 */
    public function order()
    {
        // $request post 값 

        $request = [
            'goods_idx' => [
                1,2,3
            ],
            'shippingInfo' => [
                'receiverName' => '홍길동',
                'receiverPhoneNumber' => '010-0000-0000',
                'shippingAddress1' => '서을특별시 강남구',
                'shippingAddress2' => '삼성동',
                'shippingZipCode' => '00000'
            ]
        ];

        $orderService = new OrderService();
        $orderService->placeOrder($request);

        // return view "/order/orderComplate"


    }

    public function cancel()
    {
        // $orderClass = new Order();
        // $orderClass->cancel();

    }





}

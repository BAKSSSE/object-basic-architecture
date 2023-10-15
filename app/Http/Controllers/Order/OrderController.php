<?php

namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Order\OrderService;

class OrderController extends Controller
{


    /**
     * 주문 확인 (@Post /orders/orderConfirm)
     * 
     */
    public function orderConfirm(Request $request)
    {
        // $request->input('ooo');
        $request = [
            'goods_idx' => [
                1,2,3
            ]
        ];

        $products = [];

        $productService = new productService();
        
        foreach ($request['goods_idx'] as $idx) {
            $product = $productService->getProduct($idx);
            if ($product == null || empty($product)) {
                throw new \Exception($idx . "no product");
            }
            array_push($products, $productService->getProduct($idx)); 
        }



        return response()->json([
            'totalAmounts' => '10000'
        ]);

    }
    

    /** 
     * 주문 하기 (@Post /orders/order)
     * 
     */
    public function order(Request $request)
    {
        // $request post 값 
        // $request->input('ooo');
        
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

        // 주문완료 프로세스
        $orderService = new OrderService();
        $orderNumber = $orderService->placeOrder($request);

        return response()->json([
            'orderNumber' => $orderNumber
        ]);
        // return view('order.orderCompate', []);

    }

    /**
     * 주문 취소하기 /my/orders/{orderNo}/cancel
     */
    public function cancel(Request $request)
    {
        $request = [
            'order_idx' => '1',
            'member_idx' => '10'
        ];
        // $orderService = new cancelOrderService();
        $orderService = new OrderService();
        $orderService->cancel('order_idx', 'member_idx');
        return response()->json([
            'message' => '주문 취소 완료',
            'orderNumber' => $orderNumber
        ]);

    }





}

<?php
namespace App\Services\Order;

use App\Domain\Order\Order;
use App\Domain\Order\OrderLine;
use App\Domain\Order\Policy\CancelPolicy;

class OrderService
{
    public function __construct(){}

    /**
     * 주문하기
     */
    public function placeOrder($request)
    {
        // @Transactional

        $orderLines = [];
        $shippingInfo = $request['shippingInfo'];

        // =============== START 상품 체크 ===============
        // DB for문 돌면서 상품 존재 하는지 체크 

        foreach ($request['goods_idx'] as $idx) {
            // DB - select goods 

            // 상품 객체 저장
            array_push($orderLines, new OrderLine(
                ['상품' . $idx, '상품 이미지' . $idx, 10000, 5], // 상품정보 
                10000, // 금액
                5 // 수량
            ));
        }
        // =============== END 상품 체크 ===============

        // =============== START 주문 ===============
        // 주문 번호 생성
        $orderNumber = 10;
        
        // DB - select member 회원 존재 여부 체크
        // $request['member_idx']
        $buyer = 10;

        $order = new Order(
            $orderNumber,
            $buyer,
            $orderLines, 
            $shippingInfo, 
            Order::PAYMENT_WAITING
        );

        // dd($order);
        // DB - insert : $order -> order, order_shipping 


        // =============== END 주문 ===============


        // 주문 완료 메일 발송
        return $orderNumber;
    }

    /**
     * 주문 취소 하기
     */
    public function cancelOrder($orderNumber, $canceller)
    {
        // @Transactional
        
        // DB - select order 주문 존재 여부 체크와 주문 데이터 가져오기

        // $order = new Order(
        // );

        $order = [];

        $cancelPolicy  = new CancelPolicy();
        if (!$cancelPolicy->hasCancellationPermission($order, $canceller)) {
            throw new \Exception('No Cancellable Permission');
        }

        $cancelOrder = $order->cancel();

        // DB - order cancel 주문 취소 상태로 변경
        // DB - UPDATE : $cancelOrder-> order , $cancelOrder를 참고해서 update 하면 됨
        return true;
    }

}
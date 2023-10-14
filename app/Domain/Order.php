<?php

namespace App\Domain;
use App\Domain\Order\OrderLine; 

class Order
{
    /**
     * 
     * 1. 도메일 모델링 기본 : 핵심 구성요소, 규칙 ,기능 찾기
     * - 주문 도메인 요구사항 
     * 1) 최소 한 종류 이상의 상품을 주문 해야 한다.
     * 2) 한 상품을 한 개 이상 주문할 수 있다.
     * 3) 총 주문 금액은 각 상품의 구매 가격 합을 모두 더한 금액이다.
     * 4) 각 상품의 구매 가격 합은 상품 가격에 구매 개수를 곱한 값이다.
     * 5) 주문할 때 배송지 저ㅓㅇ보를 반드시 지정해야 한다.
     * 6) 배송지 정보는 받는 사람 이름, 전화번호, 주소로 구성된다.
     * 7) 출고를 하면 배송지를 변경할 수 없다.
     * 8) 출고 전에 주문을 취소할 수 있다.
     * 9) 고객이 결제를 완료하기 전에는 상품을 준비하지 않는다.
     * -> 출고 상태로 변경하기, 배송지 정보 변경하기, 주문 취소하기, 결제 완료하기
     * 
     * Order 1:N  OrderLine
     * 
     * 1.
     * 주문할 때 배송지 정보를 반드지 지정 해야하기 때문에, 
     * order 를 생성할때 orderLine 뿐만 아니라 shippingInfo 도 필요 
     * 
     * 2. 주문 상태에 따라 제약이나 규칙이 달리 적용
     * 1) 출고를 하면 배송지 정보를 변경할 수 없다.
     * 2) 출고 전에 주문을 취소할 수 없다.
     * 
     */
     
    /** 모든 주문 정보 */
    private $orderLines = [];
    /** 배송지 정보 */
    private $shippingInfo = [];
    /** 모든 주문 총 금액 */
    private $totalAmounts;
    
    const PAYMENT_WAITING = 'PAYMENT_WAITING';
    const PREPARING = 'PREPARING';
    const SHIPPED = 'SHIPPED';
    const DELIVERING = 'DELIVERING';
    const DELIVERY_COMPLETED = 'DELIVERY_COMPLETED';
    const CANCELED = 'CANCELED';
    /** 주문 상태 */
    private $state;
    
    
    public function __construct($orderNumber, $buyer, $orderLines = [], $shippingInfo = [], $state)
    {
        $this->setOrderLines($orderLines);
        $this->setShippingInfo($shippingInfo);
        $this->state = $state;
    }

    /**
     * 주문 제약조건 체크 : 주문 체크 및 총 금액 계산 
     * @param array $orderLinesxw
     */
    private function setOrderLines($orderLines = [])
    {
        $this->verifyAtLeastOneOrMoreLines($orderLines);
        $this->orderLines = $orderLines;
        $this->calculateTotalAmounts();
    }

    /** 
     * 배송지 관련 제약조건 체크 : 정보 필수 
     * @param array $shippingInfo
     */
    private function setShippingInfo($shippingInfo = [])
    {
        if ($shippingInfo == null || empty($shippingInfo)) {
            throw new \Exception("no shippingInfo");
        }
        $this->shippingInfo = $shippingInfo;
    }

    /**
     * 주문(OrderLine) 적어도 하나 이상
     * @param array $orderLines
     * @return InvalidArgumentException, void
     */
    private function verifyAtLeastOneOrMoreLines($orderLines)
    {
        if ($orderLines == null || empty($orderLines)) {
            throw new \Exception("no OrderLine");
        }
    }

    private function calculateTotalAmounts()
    {
        $orderLines = $this->orderLines;
        $sum = array_sum(array_map(fn ($orderLine) => $orderLine->getAmount(), $orderLines)); 
        $this->totalAmounts = $sum; 
    }




    /** 출고 상태 변경 */
    public function changeShipped(){}
    /** 
     * 배송 정보 변경: 출고 전에만 가능
     * @param array @newShipping
    */
    public function changeShippingInfo($newShipping = [])
    {
        if ($this->state != self::PAYMENT_WAITING && $this->state != self::PREPARING) {
            throw new \Exception("already shipped");
        }
        setShippingInfo($newShipping);
    }
    
    /** 주문 취소 */
    public function cancel()
    {
        if ($this->state != self::PAYMENT_WAITING && $this->state != self::PREPARING) {
            throw new \Exception("already shipped");
        }
        $this->state = self::CANCELED;   

        
    }

    /** 결제 완료 */
    public function completePayment(){}
    

    
    
     

}

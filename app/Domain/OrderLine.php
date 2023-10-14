<?php
namespace App\Domain;

class OrderLine
{
    /**
     * 주문 방법 요구사항, 하나의 상품에 관한
     * 1) 한 상품을 한개 이상 주문할 수 있다.
     * 2) 각 상품의 구매 가격 합은 상품 가격에 구매 개수를 곱한 값이다.
     */

    /** 주문할 상품 정보 */
    private $product = [];
    /** 상품 가격 */
    private int $price;    
    /** 구메 개수 */
    private int $quantity;
    /** 총 상품 가격 */
    private int $amounts;

    public function __construct($product, $price, $quantity)
    {
        $this->product = $product;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->amounts = $this->calculateAmounts();

    }

    private function calculateAmounts()
    {
        return $this->price * $this->quantity;
    }

    public function getAmount(){
        return $this->amounts;
    }

}
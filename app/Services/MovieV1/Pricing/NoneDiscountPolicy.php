<?php
namespace App\Services\Movie\Pricing;

// use App\Services\Movie\Money;
// use App\Services\Movie\Screening;

/**
 * 
 *  할인 조건(Condition)을 만족할 경우 일정한 금액을 할인해주는 금액 할인 정책
 */
class NoneDiscountPolicy {
    // public function __construct(Money $discountAmount, ...$conditions)
    // {
    //     // super($conditions);
    //     $this->conditions = $conditions;
    //     $this->discountAmount = $discountAmount;
    // }
    
    public function getDiscountAmount(Screening $screening)
    {
        return 0;
    }
    
}
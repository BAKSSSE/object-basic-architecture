<?php
namespace App\Services\Movie\Pricing;

use App\Services\Movie\Money;
use App\Services\Movie\Screening;
use App\Services\Movie\Pricing\SequenceCondition;

/**
 * 
 *  할인 조건(Condition)을 만족할 경우 일정한 금액을 할인해주는 금액 할인 정책
 */
class AmountDiscountPolicy {
    private Money $discountAmount;
    // private SequenceCondition $conditions;
    private $conditions;

    public function __construct(Money $discountAmount, ...$conditions)
    {
        $this->conditions = $conditions;
        $this->discountAmount = $discountAmount;
    }
    
    public function getDiscountAmount(Screening $screening)
    {
        return $this->discountAmount;
    }
    
    public function calculateDiscountAmount(Screening $screening)
    {
        foreach ($this->conditions as $condition) {
            if ($condition->isSatisfiedBy($screening)) {
                return getDiscountAmount($screening);
            }
        }
        return 0;
    }
}
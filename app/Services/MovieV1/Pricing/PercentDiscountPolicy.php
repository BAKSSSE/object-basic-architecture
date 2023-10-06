<?php
namespace App\Services\Movie\Pricing;

use App\Services\Movie\Money;
use App\Services\Movie\Screening;
/**
 * 
 *  할인 조건(Condition)을 만족할 경우 일정한 비율을 할인해주는 금액 할인 정책
 */
class PercentDiscountPolicy {
    // private $conditions;
    private $percent;

    public function __construct($percent, ...$conditions)
    {
        // super($conditions);
        $this->conditions = $conditions;
        $this->percent = $percent;
    }
    
    public function getDiscountAmount(Screening $screening)
    {
        return $screening->getMovieFee()->times($this->percent);
    }
    
}
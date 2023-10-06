<?php 
namespace App\Services\Movie;
use App\Services\Movie\Money;
use App\Services\Movie\Pricing\NoneDiscountPolicy;
use App\Services\Movie\Pricing\AmountDiscountPolicy;

/**
 * 영화 
 */
class Movie {
    private $title;
    private $runningTime;
    private Money $fee;
    private AmountDiscountPolicy $discountPolicy;

    public function __construct($title, $runningTime, Money $fee, AmountDiscountPolicy $discountPolicy)
    {
        $this->title = $title;
        $this->runningTime = $runningTime;
        $this->fee = $fee;
        $this->discountPolicy = $discountPolicy;
    }

    public function getFee()
    {
        return $this->fee;
    }

    /**
     * 할인 적용된 영화 금액
     */
    public function calculateMovieFee($sceening)
    {
        return $this->fee->minus($this->discountPolicy->calculateDiscountAmount($sceening));
    }
}
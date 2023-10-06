<?php 
namespace App\Services\Movie;
use App\Services\Movie\Money;
use APp\Servies\Movie\DiscountPolicy;

/**
 * 영화 
 */
class Movie {
    private $title;
    private $runningTime;
    private Money $fee;
    private DiscountPolicy $discountPolicy;

    public function __construct($title, $runningTime, Money $fee, DiscountPolicy $discountPolicy)
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

    public function calculateMovieFee($sceening)
    {
        return $this->fee->minus($this->discountPolicy->calculateDiscountAmount($sceening));
    }
}
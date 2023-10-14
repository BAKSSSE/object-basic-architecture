<?php

namespace App\Services\Movie;
use App\Services\Movie\Money;

/**
 * 영화 객체
 */
class Movive {
    private Stirng $title;
    private $runningTime;
    private Money $fee;
    private $discountConditions;

    /**
    * AMOUNT_DISCOUNT,    // 금액 할인 정책
    * PERCENT_DISCOUNT,   // 비율 할인 정책
    * NONE_DISCOUNT   
     */
    private $movieType;
    private Money $discountAmount;
    private float $discountPercent = 0;


    function __construct(
        $title, $runningTime, $fee, 
        $movieType, $discount, ...$discountConditions)
    {
        $this->title = $title;
        $this->runningTime = $runningTime;
        $this->fee = $fee;

        $this->movieType = $movieType;
        switch ($movieType)
        {
            case 'AMOUNT_DISCOUNT': 
                $this->discountAmount = $discount;
                break;

            case 'PERCENT_DISCOUNT': 
                $this->discountPercent = $discount;
                break;
        }
        
        $this->discountConditions = $discountConditions;
    }

    public function getMovieType()
    {
        return $this->movieType;
    }

    /**
     * @breif 일정금액 할인시 적용 
     */
    public function calculateAmountDiscountedFee()
    {
        if ($this->movieType != 'AMOUNT_DISCOUNT') {
            return false;
            //TODO  exception 리턴 작업 
        }
        return $this->fee()->minus($this->discountAmount);
    }


    /**
     * @breif 퍼센트 할인시 적용 
     */
    public function calculatePercentDiscountFee()
    {
        if ($this->movieType != 'PERCENT_DISCOUNT') {
            return false;
            //TODO  exception 리턴 작업 
        }

        $discount = $this->fee()->times($this->discountPercent);
        return $this->fee()->minus($discount);
    }


    public function calculateNoneDiscountedFee()
    {
        if ($this->movieType != 'NONE_DISCOUNT') {
            return false;
        }

        return $this->fee;
    }

    // 할인 조건 체크
    public function isDiscountable($whenScreened, $sequence) 
    {

        foreach ($this->discountConditions as $discountCondition) {
            if ($discountCondition->getType() == 'PERIOD') {
                if ($discountCondition.isDiscountable($whenScreened.getDayOfWeek(), $whenScreened.toLocalTime())) {
                    return true;
                }
            } else {
                if ($discountCondition->isDiscountable($sequence)) {
                    return true;
                }
            }
        }

        return false;
    }

}
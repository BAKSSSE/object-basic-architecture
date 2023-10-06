<?php
namespace App\Services\Movie\Pricing;

/**
 * 할인 조건 : 기간 조건
 * 상영 시작시간이 특정한 기간안에 포함되는지 여부 판단
 */
class SequenceCondition {
    private $dayOfWeek;
    private $startTime;
    private $endTime;


    public function __construct($dayOfWeek, $startTime, $endTime)
    {
        $this->dayOfWeek = $dayOfWeek;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    /**
     * 
     */
    public function isSatisfiedBy($screening)
    {

        if ( 
            ($this->startTime >= $screening->getStartTime()) && 
            ($this->endTime >= $screening->getStartTime())
            ) {
            return true;
        }
    }
}
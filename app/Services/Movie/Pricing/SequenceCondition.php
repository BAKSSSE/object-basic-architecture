<?php
namespace App\Services\Movie\Pricing;

/**
 * 할인 조건 : 순번 조건
 * 할인 여부 판단
 */
class SequenceCondition {
    private $sequence;

    public function __construct($sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * Screening의 상영 순번과 일치할 경우 할인 가능한 것으로 판단 
     * @return Boolean
     */
    public function isSatisfiedBy($screening)
    {
        return $screening->isSequence($this->sequence);
    }
    
}
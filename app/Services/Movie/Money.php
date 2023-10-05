<?php 
namespace App\Services\Movie;
use Brick\Math\BigDecimal;

/**
 * 금액과 관련된 다양한 계싼을 구현 하는 클래스 
 */
class Money {
    public static $ZERO = 0;
    private $amount;

    function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function wons($amount)
    {
        // return new Money(BigDecimal::of($amount));

        return new Money($amount);
    }

    public static function static_wons($amount)
    {
        // return new Money(BigDecimal::of($amount));
        return new Money($amount);
    }

    public function plus($amount)
    {
        return new Money($this->amount + $amount);
    }

    public function minus($amount)
    {
        return new Money($this->amount - $amount);
    }

    public function times(float $percent)
    {
        return new Money($this->amount * $percent);
    }

    public function isLessThan($other)
    {
        return ($this->amount < $other)? false : true;
    }
    
    public function isGreaterThanOrEqual($other)
    {
        return ($this->amount >= $other)? false : true;
    }


}
<?php 
namespace App\Services\Movie;
use App\Services\Movie\Customer;
use App\Services\Movie\Screening;
use App\Services\Movie\Money;


/** 영화 예매 */
class Reservation {
    private Customer $customer;
    private Screening $screening;
    private Money $fee;
    private int $audienceCount;

    public function __construct(Customer $customer, Screening $screening, Money $fee, int $audienceCount)
    {

        $this->customer = $customer;
        $this->screening = $screening;
        $this->fee = $fee;
        $this->audienceCount = $audienceCount;

    }
    
}
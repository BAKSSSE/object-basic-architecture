<?php 
namespace App\Services\Movie;
use App\Services\Movie\Movie;

/**
 * 사용자들이 예매하는 대상인 '상영' 클래스
 */
class Screening {

    private Movie $movie; // 상영할 영화
    private int $sequence; // 순번
    private $whenScreened; // 상영 시작 시간

    public function __construct(Movie $movie, int $sequence, $whenScreened)
    {
        $this->movie = $movie;
        $this->sequence = $sequence;
        $this->whenScreened = $whenScreened;
    }

    public function getStartTime() 
    {
        return $this->whenScreened;
    }

    public function isSequence(int $sequence)
    {
        return $this->sequence == $sequence;
    }

    public function getMovieFee()
    {
        return $this->movie->getFee();
    }
    
    /**
     * @brief 영화 예매한 후 예매 정보를 담고 있는 Reservation 인스턴스 생성 반환
     * @param Customer $customer 예매자 정보
     * @param int $audienceCount 인원수
     * @return Reservation
     */
    public function reserve(Customer $customer, int $audienceCount)
    {
        return new Reservation($customer, $this, calculateFee($audienceCount), $audienceCount);
    }

    /**
     * @brief 요금 계산
     * @param int $audienceCount 인원 수
     */
    public function calculateFee(int $audienceCount)
    {
        return $this->movie->calculateMovieFee($this).times($audienceCount);
    }



     
}
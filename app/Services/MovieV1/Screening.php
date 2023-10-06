<?php 
namespace App\Services\Movie;
use App\Services\Movie\Movie;
use App\Services\Movie\Customer;
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

    public function isSequence($sequence)
    {
        return $this->sequence;
    }

    public function getMovieFee()
    {
        return $this->movie()->getFee();
    }
     
}
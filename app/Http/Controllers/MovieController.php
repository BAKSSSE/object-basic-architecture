<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\Movie\Movie;
use App\Services\Movie\Screening;

use App\Services\Movie\Money;
use App\Services\Movie\Pricing\NoneDiscountPolicy;
use App\Services\Movie\Pricing\AmountDiscountPolicy;
use App\Services\Movie\Pricing\SequenceCondition;

class MovieController extends Controller
{

    public function test(Request $request) 
    {

    }


    // public function test(Request $request) {


    //     // step 1. 영화 생성
    //     $avatar = new Movie("아바타",
    //         3600, // 1시간
    //         Money::static_wons(10000),
            
    //         new AmountDiscountPolicy(
    //             Money::static_wons(5000),
    //             new SequenceCondition(1),
    //             new SequenceCondition(3)
    //             )
    //         );

    //     dump($avatar);

    //     // db insert - movie

    //     /** 
    //     * table screening 
    //     * 영화 id
    //     * 상영 id
    //     * 상영 시간
    //      */

    //     // // 상영 생성
    //     $screening = new Screening(
    //         $avatar, // 영화
    //         3, // 순번
    //         strtotime("2023-10-07")
    //     );
    //     // // db insert - screening

    //     dump($screening);

    //     // 예매
    //     // db insert = Reservation 
        
    //     // print_r($avatar->getFee()) ;
    //     // echo $avatar->getFee()->wons();
    // }

    // public function test2(Request $request)
    // {
        
    //     // $this->reserve()
    // }

    // // 예매
    // function reserve($screening, $customer, $audienceCount)
    // {

    // }
}
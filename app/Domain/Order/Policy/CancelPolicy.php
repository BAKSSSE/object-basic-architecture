<?php

namespace App\Domain\Order\Policy;

class CancelPolicy
{

    public function hasCancellationPermission($order, $canceller)
    {

        // isCancellerOrderer
        // isCurrentUserAdminRole

    }

    private function isCancellerOrderer($order, $canceller)
    {
        // 주문한 회원 번호 == 로그인한 회원번호 비교
        return true;
    }

    private function isCurrentUserAdminRole()
    {
        // 회원 권한 체크
    }


}
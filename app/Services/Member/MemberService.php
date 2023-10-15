<?php

namespace App\Services\Member;
use App\Domain\Member\Member;

class MemberService
{
    public function __construct(){}

    /** 패스워드 변경 */
    public function changePassword($params)
    {
        $member = $this->findExistingMember($params['memberId']);
        $changeMember = $member->changePassword($params['currentPassword'], $params['newPassword']);
        // DB - Update Set password $changeMember From member

        dd($member);
    }

    /** 회원 비밀번호 초기화 */
    public function initializePassword($memebrId)
    {
        $member = $this->findExistingMember($memberId);
        $newPassword = $member->initializePassword();

        // DB 

        // 사용자에게 신규 암호 통지
        // notifier->notifyNewPassword($member, $newPassword);

    }
    /** 회원 탈퇴 */
    public function leave($memberId, $currentPassword)
    {
        $member = $this->findExistingMember($memberId);
        $membe->leave();
        
        // DB 
    }
    
    // 회원 존재 여부 체크 및 회원 객체 생성
    private function findExistingMember($memberId)
    {

        // DB - Select From Member Where member_id $memberId

        if ($memberId = null) {
            throw new \Exception('no member');
        }

        $member = new Member([
            'memberId' => 'test',
            'password' => 'pw',
            'name' => '홍길동'
        ]);
        return $member;
    }


}
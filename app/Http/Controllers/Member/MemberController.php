<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Member\MemberService;

class MemberController extends Controller
{
    public function changePassword(Request $request)
    {
        // $request->input('memberId');
        // $request->input('currentPassword');
        // $request->input('newPassword');
        try {

            $memberService = new MemberService();

            $memberService->changePassword([
                'memberId' => 'test',
                'currentPassword' => 'pw',
                'newPassword' => 'newpw'
            ]);

            return  response()->json([
                'message' => "change password ok"
            ]);
        } catch (\Exception $e) {
            return  response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
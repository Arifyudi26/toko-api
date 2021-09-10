<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Member;
use App\Models\MemberToken;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\This;

class LoginController extends Controller
{
    public function login()
    {
        $email = request()->post('email');
        $password = request()->post('password');

        $member = Member::where('email', $email)->first();
        if (empty($member)) {
            return $this->responseHasil(404, false, 'email tidak di temukan');
        }
        if (!Hash::check($password, $member->password)) {
            return $this->responseHasil(404, false, 'password tidak ditemukan');
        }

        $data = [
            'auth_key' => Hash::make(md5(date('Y-m-d H:i:s') . rand(9, 99999) . $member->id)),
            'member_id' => $member->id
        ];

        try {
            MemberToken::create($data);
            return $this->responseHasil(200, true, [
                'token' => $data['auth_key'],
                'user' => $member
            ]);
        } catch (Exception $e) {
            return $this->responseHasil(500, false, $e->getMessage());
        }
    }
}
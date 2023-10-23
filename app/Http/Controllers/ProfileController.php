<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\IdentificationCode;
use App\Models\Invite;
use App\Models\InviteDetail;
use App\Models\Level;
use App\Models\User;
use App\Models\UserIdentificationCode;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = User::where('id', auth()->user()->id)
            ->with('level')
            ->with('codes.identification')
            ->first();

        return view('panel.profile', ['user' => $user]);
    }

    public function profile_update(ProfileRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
        ]);
        alert()->success('ویرایش موفقیت افزوده شد', 'عملیات موفق');

        return back();
    }

    public function insert_code(Request $request)
    {
        $code = IdentificationCode::where('code', $request->code)->first();
        if (!$code) {
            alert()->error('کد وارد کرده اشتباه است.', 'عملیات ناموفق');
            return back()->withInput();
        }
        $inviter = UserIdentificationCode::where('identification_code_id', $code->id)->first();
        if ($inviter->used == 1) {
            alert()->error('کد وارد کرده استفاده شده است.', 'عملیات ناموفق');
            return back()->withInput();
        }

        $right = 1;
        $existInvite = Invite::where('inviter_id', $inviter->user_id)->first();
        if ($existInvite) {
            $right = 0;
        }

        $authId = auth()->user()->id;
        Invite::create([
            'user_id' => $authId,
            'inviter_id' => $inviter->user_id,
            'identification_code_id' => $inviter->identification_code_id,
            'right' => $right
        ]);
        InviteDetail::create([
            'inviter_id' => $inviter->user_id,
            'user_id' => $authId,
            'right' => $right,
            'rank' => auth()->user()->level_id,
        ]);

        $selects = InviteDetail::where('user_id', $inviter->user_id)->get();
        $data = [];
        foreach ($selects as $select) {
            $inRight = InviteDetail::where('inviter_id', $select->inviter_id)->whereIn('user_id', $selects->pluck('inviter_id'))->pluck('right')->first();
            if (!$inRight) {
                $inRight = InviteDetail::where('inviter_id', $select->inviter_id)->where('user_id', $select->user_id)->pluck('right')->first();
            }
            $userTable = User::where('id', $select->inviter_id)->first();
            $userTable->update([
                'r_count' => InviteDetail::where('inviter_id', $select->inviter_id)->where('right', 1)->count(),
                'l_count' => InviteDetail::where('inviter_id', $select->inviter_id)->where('right', 0)->count()
            ]);
            $data[] = [
                'inviter_id' => $select->inviter_id,
                'user_id' => $authId,
                'right' => $inRight,
            ];

        }
        if ($selects != '[]') {
            InviteDetail::insert($data);
        }

        $inviter->update(['used' => 1]);
        $inviter = User::where('id', $inviter->user_id)->first();
        $inviter->update([
            'r_count' => InviteDetail::where('inviter_id', $inviter->id)->where('right', 1)->count(),
            'l_count' => InviteDetail::where('inviter_id', $inviter->id)->where('right', 0)->count()
        ]);

        $user = User::where('id', $authId)->first();
        $user->update([
            'level_id' => 2,
        ]);
        $codes = IdentificationCode::where('used', 0)->take(2)->get();
        foreach ($codes as $code) {
            UserIdentificationCode::create([
                'identification_code_id' => $code->id,
                'user_id' => $authId
            ]);
            $code->update([
                'used' => 1
            ]);
        }
        alert()->success('کد شما با موفقیت ثبت گردید.', 'عملیات موفق');

        return back();
    }
}

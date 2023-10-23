<?php

namespace Database\Seeders;

use App\Models\IdentificationCode;
use App\Models\Invite;
use App\Models\InviteDetail;
use App\Models\Level;
use App\Models\User;
use App\Models\UserIdentificationCode as Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserIdentificationCode extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $code = IdentificationCode::where('used', 0)->first();
            Model::create([
                'user_id' => $user->id,
                'identification_code_id' => $code->id,
                'used' => 1,
            ]);
            $code->update(['used' => 1]);
            $newUser = User::where('r_count', 0)->where('l_count', 0)->whereNotIn('id', [$user->id])->first();
            $right = rand(0, 1);
            Invite::create([
                'user_id' => $newUser->id,
                'inviter_id' => $user->id,
                'identification_code_id' => $code->id,
                'right' => $right
            ]);
            InviteDetail::create([
                'inviter_id' => $user->id,
                'user_id' => $newUser->id,
                'right' => $right,
                'rank' => Level::all()->random()->first()->id,
            ]);
            $selects = InviteDetail::where('user_id', $user->id)->get();
            $data = [];
            foreach ($selects as $select) {
                $inRight = InviteDetail::where('inviter_id', $select->inviter_id)->whereIn('user_id', $selects->pluck('inviter_id'))->pluck('right')->first();
                if (!$inRight) {
                    $inRight = InviteDetail::where('inviter_id', $select->inviter_id)->where('user_id', $select->user_id)->pluck('right')->first();
                }
                $data[] = [
                    'inviter_id' => $select->inviter_id,
                    'user_id' => $newUser->id,
                    'right' => $inRight,
                ];
            }
            if ($selects != '[]') {
                InviteDetail::insert($data);
            }
            $user->update(['r_count' => 1]);
        }
    }
}

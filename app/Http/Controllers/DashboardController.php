<?php

namespace App\Http\Controllers;

use App\lib\Kavenegar;
use App\Models\ActivationCode;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use App\Models\InviteDetail;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class DashboardController extends Controller
{
    public function panel()
    {

        $user = auth()->user();
        $right = InviteDetail::where('inviter_id', $user->id)->where('right', 1)->count();
        $left = InviteDetail::where('inviter_id', $user->id)->where('right', 0)->count();
        $nextLevel = Level::where('id', $user->level_id + 1)->first();
        if ($nextLevel) {
            if ($nextLevel->count <= $right and $nextLevel->count <= $left) {
                $exam = Exam::where('level_id', $nextLevel->id)->orderBy('created_at', 'desc')->first();
                if ($exam) {
                    $answer = ExamAnswer::where('user_id', $user->id)->where('exam_id', $exam->id)->where('true', 1)->count();
                    if ($answer > 0) {
                        $questions = ExamQuestion::where('exam_id', $exam->id)->count();
                        if ($questions > 0) {
                            $mark = $answer / $questions;
                            if ($mark > 0.79) {
                                User::where('id', $user->id)->update([
                                    'level_id' => $nextLevel->id
                                ]);
                                alert()->success('شما به سطح ' . $nextLevel->name . ' ارتقا پیدا کردید', 'تبریک');
                                return redirect('panel');
                            };
                        }
                    }
                }

            }

        }

        return view('panel.dashboard.index');

    }

    public function check_active(Request $request)
    {
        $check = ActivationCode::where('code', $request->code)->first();
        if (!$check or auth()->user()->id != $check->user_id) {
            alert()->error('کد اشتباه وارد کردید.', ' ناموفق');

            return back();
        }
        if ($check->used == 1) {
            alert()->error('کد استفاده شده است.', ' ناموفق');

            return back();
        }
        if ($check->active == 0) {
            alert()->error('کد فعال نمی باشد.', ' ناموفق');
            return back();
        }
        User::where('id', auth()->user()->id)->update(['active' => 1]);
        $check->update(['used' => 1]);
        return redirect('panel');
    }
}

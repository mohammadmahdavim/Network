<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{


    public function first()
    {
        $rows = DB::table('members')
//            ->orderBy(DB::raw("`emotional` + `work`"), 'desc')
            ->orderBy('created_at', 'asc')
            ->where('author', auth()->user()->id)
//            ->where('status', 'bronze')
            ->whereNull('deleted_at')
            ->paginate(30);
        $count = Member::where('author', auth()->user()->id)->where('status', 'bronze')->count();
        return view('panel.member.first', ['rows' => $rows, 'count' => $count]);
    }

    public function bronze()
    {
        $rows = DB::table('members')
//            ->orderBy(DB::raw("`emotional` + `work`"), 'desc')
            ->orderBy('created_at', 'asc')
            ->where('author', auth()->user()->id)
            ->where('status', 'bronze')
            ->whereNull('deleted_at')
            ->paginate(30);
        $count = Member::where('author', auth()->user()->id)->where('status', 'bronze')->count();
        return view('panel.member.bronze', ['rows' => $rows, 'count' => $count]);
    }

    public function silver()
    {
        $rows = Member::where('author', auth()->user()->id)->whereIn('status', ['silver', 'golden'])
            ->orderBy('created_at', 'asc')

//            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`"), 'desc')
            ->whereNull('deleted_at')
            ->paginate(30);
        $count = Member::where('author', auth()->user()->id)->where('status', 'silver')->count();

        return view('panel.member.silver', ['rows' => $rows, 'count' => $count]);
    }

    public function golden()
    {
        $rows = Member::where('author', auth()->user()->id)->where('status', 'golden')
            ->orderBy('created_at', 'asc')
//            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`+`age` + `motivation` + `free_time` + `marital_status` + `experience`"), 'desc')
            ->whereNull('deleted_at')
            ->paginate(30);
        return view('panel.member.golden', ['rows' => $rows]);
    }

    public function final()
    {
        $rows = Member::where('author', auth()->user()->id)->where('status', 'final')
            ->orderBy('created_at', 'asc')
//            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`+`age` + `motivation` + `free_time` + `marital_status` + `experience`"), 'desc')
            ->whereNull('deleted_at')
            ->paginate(30);
        return view('panel.member.final', ['rows' => $rows]);
    }

    public function second()
    {
        $rows = Member::where('author', auth()->user()->id)->where('status2', 'second')
            ->orderBy('created_at', 'asc')
//            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`+`age` + `motivation` + `free_time` + `marital_status` + `experience`"), 'desc')
            ->whereNull('deleted_at')
            ->paginate(30);
        return view('panel.member.second', ['rows' => $rows]);
    }

    public function shared()
    {
        $rows = Member::where('author', auth()->user()->id)->where('status2', 'shared')
            ->orderBy('created_at', 'asc')
//            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`+`age` + `motivation` + `free_time` + `marital_status` + `experience`"), 'desc')
            ->whereNull('deleted_at')
            ->paginate(30);
        return view('panel.member.shared', ['rows' => $rows]);
    }

    public function invites()
    {
        $rows = Member::where('author', auth()->user()->id)
            ->whereIn('status3', ['invites','presents'])
            ->orderBy('created_at', 'asc')
//            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`+`age` + `motivation` + `free_time` + `marital_status` + `experience`"), 'desc')
            ->whereNull('deleted_at')
            ->paginate(30);
        return view('panel.member.invites', ['rows' => $rows]);
    }


    public function presents()
    {
        $rows = Member::where('author', auth()->user()->id)->where('status3', 'presents')
            ->orderBy('created_at', 'asc')
//            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`+`age` + `motivation` + `free_time` + `marital_status` + `experience`"), 'desc')
            ->whereNull('deleted_at')
            ->paginate(30);
        return view('panel.member.presents', ['rows' => $rows]);
    }

    public function follow_up()
    {
        $rows = Member::where('author', auth()->user()->id)->where('status3', 'presents')
            ->orderBy('created_at', 'asc')
//            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`+`age` + `motivation` + `free_time` + `marital_status` + `experience`"), 'desc')
            ->whereNull('deleted_at')
            ->paginate(30);
        return view('panel.member.follow_up', ['rows' => $rows]);
    }

    public function store(Request $request)
    {
        Member::create([
            'author' => auth()->user()->id,
            'name' => $request->name,
            'family' => $request->family,

        ]);

//        alert()->success('فرد جدید به لیست اسامی افزوده گردید.', 'موفق');
        return back()->withErrors('فرد جدید به لیست اسامی افزوده گردید.');
    }

    public function update(Request $request, $id)
    {
        $memeber = Member::where('id', $id)->first();
        $memeber->update([
            'name' => $request->name,
            'family' => $request->family,
        ]);

        alert()->success('اطلاعات ویرایش گردید.', 'موفق');
        return back();
    }

    public function delete($id)
    {
        $memeber = Member::where('id', $id)->first();
        $memeber->delete();
    }

    public function analyze()
    {
        DB::beginTransaction();
        DB::table('members')
            ->where('author', auth()->user()->id)
            ->where('status', 'silver')
            ->update(['status' => 'bronze']);

        $count = Member::where('author', auth()->user()->id)->where('status', 'bronze')->count();
        if ($count >= 200) {
            $tops = DB::table('members')
                ->where(DB::raw("`emotional` + `work`"), '>=', 4)
                ->orderBy(DB::raw("`emotional` + `work`"), 'desc')
                ->where('author', auth()->user()->id)
                ->where('status', 'bronze')
                ->limit(100)
                ->get();

            $last = $tops->last();
            $lastPoint = $last->work + $last->emotional;

            DB::table('members')
                ->where(DB::raw("`emotional` + `work`"), '>=', 4)
                ->orderBy(DB::raw("`emotional` + `work`"), 'desc')
                ->where('author', auth()->user()->id)
                ->where('status', 'bronze')
                ->limit(100)
                ->update(['status' => 'silver']);
            DB::table('members')
                ->where(DB::raw("`emotional` + `work`"), $lastPoint)
                ->where('author', auth()->user()->id)
                ->where('status', 'bronze')
                ->update(['status' => 'silver']);
            DB::commit();
            alert()->success('آنالیز با موفقیت انجام شد.', 'موفق');
            return back();

        }
        alert()->error('حداقل 200 نفر باید وارد کنید.', 'ناموفق');
        return back();
    }


    public function update_silver(Request $request, $id)
    {
        $row = Member::where('id', $id)->first();
        $row->update([
            'point_2' => $row->point_1 + $request->question_three + $request->question_four + $request->question_five
        ]);
        alert()->success('اطلاعات ثبت گردید.', 'موفق');
        return back();
    }

    public function analyze_silver()
    {
        DB::beginTransaction();
        DB::table('members')
            ->where('author', auth()->user()->id)
            ->where('status', 'golden')
            ->update(['status' => 'silver']);
        $count = Member::where('author', auth()->user()->id)->where('status', 'silver')->count();
//        if ($count >= 100) {
        $tops = DB::table('members')
            ->where(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`"), '>=', 13)
            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`"), 'desc')
            ->where('author', auth()->user()->id)
            ->where('status', 'silver')
            ->limit('50')
            ->get();

        $last = $tops->last();
        $lastPoint = $last->work + $last->emotional + $last->consult_ability + $last->success + $last->intimacy;

        DB::table('members')
            ->where(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`"), '>=', 13)
            ->where('author', auth()->user()->id)
            ->where('status', 'silver')
            ->limit(50)
            ->update(['status' => 'golden']);
        DB::table('members')
            ->where(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`"), $lastPoint)
            ->where('author', auth()->user()->id)
            ->where('status', 'silver')
            ->update(['status' => 'golden']);
        alert()->success('آنالیز با موفقیت انجام شد.', 'موفق');
        DB::commit();
        return back();
//        }
        alert()->error('حداقل 100 نفر باید وارد کنید.', 'ناموفق');
        return back();
    }

    public function questions($type, $status)
    {
        $members = Member::where('author', auth()->user()->id)
            ->where('status', $status)
            ->whereNull($type)
            ->orderBy('created_at', 'asc')
//            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy`+`age` + `motivation` + `free_time` + `marital_status` + `experience`"), 'desc')
            ->paginate(1);
        if (count($members) == 0) {
            return redirect('members/' . $status);
        }

        $count = Member::where('author', auth()->user()->id)
            ->where('status', $status)
            ->whereNotNull($type)->count();
        return view('panel.member.questions', ['members' => $members, 'type' => $type, 'count' => $count]);
    }

    public function questions_store(Request $request)
    {

        $member = Member::where('id', $request->user_id)->first();
        $member->update([
            'emotional' => $request->emotional ?? $member->emotional,
            'work' => $request->work ?? $member->work,
            'consult_ability' => $request->consult_ability ?? $member->consult_ability,
            'success' => $request->success ?? $member->success,
            'intimacy' => $request->intimacy ?? $member->intimacy,
            'age' => $request->age ?? $member->age,
            'motivation' => $request->motivation ?? $member->motivation,
            'free_time' => $request->free_time ?? $member->free_time,
            'marital_status' => $request->marital_status ?? $member->marital_status,
            'experience' => $request->experience ?? $member->experience,
            'last_meet' => $request->last_meet ?? $member->last_meet,
            'hami_list' => $request->hami_list ?? $member->hami_list,
            'hami' => $request->hami ?? $member->hami,
            'invite_date' => $request->invite_date ?? $member->invite_date,
            'invite_type' => $request->invite_type ?? $member->invite_type,
            'present_date' => $request->present_date ?? $member->present_date,
            'present_type' => $request->present_type ?? $member->present_type,
            'presentor' => $request->presentor ?? $member->presentor,
            'golden_follow_date' => $request->golden_follow_date ?? $member->golden_follow_date,
            'golden_follow_result' => $request->golden_follow_result ?? $member->golden_follow_result,
            'silver_follow_date' => $request->silver_follow_date ?? $member->silver_follow_date,
            'silver_follow_result' => $request->silver_follow_result ?? $member->silver_follow_result,
            'bronze_follow_date' => $request->bronze_follow_date ?? $member->bronze_follow_date,
            'bronze_follow_result' => $request->bronze_follow_result ?? $member->bronze_follow_result,
            'final_follow_date' => $request->final_follow_date ?? $member->final_follow_date,
            'final_follow_result' => $request->final_follow_result ?? $member->final_follow_result,
            'description' => $request->description ?? $member->description,
        ]);
        $url = explode('?', url()->previous());
        $page = $request->page + 1;
//        alert()->success('ُسوال با موفقیت ثبت شد.', 'موفق');

        return redirect($url[0]);

    }

    public function change_type(Request $request)
    {

        $row = Member::where('id', $request->id)->first();
        if ($request->type == 0) {
            $row->update([
                $request->column => NUll
            ]);
        } else {
            $row->update([
                $request->column => $request->name
            ]);
        }
    }

    public function change_point(Request $request)
    {
        $ex=explode('_',$request->value);
        Member::where('id',$ex[1])->update(['point'=>$ex[0]]);
    }

    public function analyze_golden()
    {
        DB::table('members')
            ->where('author', auth()->user()->id)
            ->where('status', 'final')
            ->update(['status' => 'golden']);
        $count = Member::where('author', auth()->user()->id)->where('status', 'silver')->count();
//        if ($count >= 100) {
        $tops = DB::table('members')
            ->where(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy` + `age` + `motivation` + `free_time` + `marital_status` + `experience`"), '>=', 20)
            ->orderBy(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy` + `age` + `motivation` + `free_time` + `marital_status` + `experience`"), 'desc')
            ->where('author', auth()->user()->id)
            ->where('status', 'golden')
            ->limit('20')
            ->get();

        $last = $tops->last();
        $lastPoint = $last->work + $last->emotional + $last->consult_ability + $last->success + $last->intimacy;

        DB::table('members')
            ->where(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy` + `age` + `motivation` + `free_time` + `marital_status` + `experience`"), '>=', 20)
            ->where('author', auth()->user()->id)
            ->where('status', 'golden')
            ->limit(20)
            ->update(['status' => 'final']);
        DB::table('members')
            ->where(DB::raw("`emotional` + `work` + `consult_ability` + `success` + `intimacy` + `age` + `motivation` + `free_time` + `marital_status` + `experience`"), $lastPoint)
            ->where('author', auth()->user()->id)
            ->where('status', 'golden')
            ->update(['status' => 'final']);
        alert()->success('آنالیز با موفقیت انجام شد.', 'موفق');
        DB::commit();
        return back();
    }
}

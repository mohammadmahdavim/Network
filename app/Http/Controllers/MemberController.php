<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function bronze()
    {
        $rows = Member::where('author', auth()->user()->id)->where('status', 'bronze')->orderBy('point_1','desc')->paginate(30);
        $count = Member::where('author', auth()->user()->id)->where('status', 'bronze')->count();
        return view('panel.member.bronze', ['rows' => $rows, 'count' => $count]);
    }

    public function silver()
    {
        $rows = Member::where('author', auth()->user()->id)->where('status', 'silver')->orderBy('point_2','desc')->paginate(20);
        $count = Member::where('author', auth()->user()->id)->where('status', 'silver')->count();

        return view('panel.member.silver', ['rows' => $rows, 'count' => $count]);
    }

    public function golden()
    {
        $rows = Member::where('author', auth()->user()->id)->where('status', 'golden')->orderBy('point_2','desc')->paginate(50);

        return view('panel.member.golden', ['rows' => $rows]);
    }

    public function store(Request $request)
    {
        Member::create([
            'author' => auth()->user()->id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'national_code' => $request->national_code,
            'point_1' => $request->question_one + $request->question_tow
        ]);

        alert()->success('فرد جدید به لیست اسامی افزوده گردید.', 'موفق');
        return back();
    }

    public function update(Request $request, $id)
    {
        $memeber = Member::where('id', $id)->first();
        $memeber->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'national_code' => $request->national_code,
            'point_1' => $request->question_one + $request->question_tow
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
        $count = Member::where('author', auth()->user()->id)->where('status', 'bronze')->count();
        if ($count >= 200) {
            $tops = Member::where('author', auth()->user()->id)->where('status', 'bronze')->orderby('point_1', 'desc')->take(100)->get();
            foreach ($tops as $top) {
                $top->update([
                    'status' => 'silver'
                ]);
            }
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
        $count = Member::where('author', auth()->user()->id)->where('status', 'silver')->count();
        if ($count >= 100) {
            $tops = Member::where('author', auth()->user()->id)->where('status', 'silver')->orderby('point_2', 'desc')->take(50)->get();
            foreach ($tops as $top) {
                $top->update([
                    'status' => 'golden'
                ]);
            }
            alert()->success('آنالیز با موفقیت انجام شد.', 'موفق');
            return back();
        }
        alert()->error('حداقل 100 نفر باید وارد کنید.', 'ناموفق');
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamHistory;
use App\Models\ExamOption;
use App\Models\ExamQuestion;
use App\Models\Learn;
use App\Models\Level;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Symfony\Component\Console\Question\Question;

class ExamController extends Controller
{
    public function index()
    {
        $rows = Exam::with('level')
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('panel.exam.index', ['rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();

        return view('panel.exam.create', ['levels' => $levels]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $row = Exam::create([
            'title' => $request->title,
            'time' => $request->time,
            'level_id' => $request->level_id,
            'questions_count' => $request->questions_count,
            'user_id' => auth()->user()->id,
        ]);
//        $this->fileController->getUploadImage($request, $row, 'learn');
        $this->countQuestion($request->questions_count, $row->id);
        alert()->success('آزمون جدید با موفقیت افزوده شد', 'عملیات موفق');

        return redirect('exams');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Exam::where('id', $id)->first();
        $levels = Level::all();
        return view('panel.exam.edit', ['row' => $row, 'levels' => $levels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $row = Exam::where('id', $id)->first();
        $row->update([
            'time' => $request->time,
            'title' => $request->title,
            'level_id' => $request->level_id,
        ]);
        alert()->success('آزمون  با موفقیت ویرایش شد', 'عملیات موفق');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Exam::where('id', $id)->first();
        $row->delete();
    }


    public function exam_level($levelId)
    {
        $rows = Exam::with('level')
            ->where('level_id', $levelId)
            ->orderBy('created_at', 'desc')->first();
        return view('panel.exam.level', ['rows' => $rows]);
    }

    public function questions($id)
    {
        $row = Exam::where('id', $id)
            ->with('questions')
            ->first();
        return view('panel.exam.questions', ['row' => $row]);

    }

    public function countQuestion($count, $id)
    {
        $c = 0;
        if ($count > 0) {
            for ($x = $c + 1; $x <= $count; $x++) {
                $q = ExamQuestion::create([
                    'exam_id' => $id,
                    'title' => 'سوال شماره ' . $x,
                ]);
                ExamOption::create([
                    'exam_question_id' => $q->id,
                    'c1' => 'گزینه ۱',
                    'c2' => 'گزینه ۲',
                    'c3' => 'گزینه ۳',
                    'c4' => 'گزینه ۴',
                    'correct' => '1',
                ]);
            }
        }
    }

    public function questions_update(Request $request, $id)
    {
        $question = ExamQuestion::where('id', $id)->first();
        $question->update([
            'title' => $request->title,
        ]);
        $option = ExamOption::where('exam_question_id', $id)->first();
        $option->update([
            'c1' => $request->get('1'),
            'c2' => $request->get('2'),
            'c3' => $request->get('3'),
            'c4' => $request->get('4'),
            'correct' => $request->get('correct'),
        ]);
        alert()->success('سوال  با موفقیت ویرایش شد', 'عملیات موفق');

        return back();
    }

    public function questions_create(Request $request, $id)
    {
        $question = ExamQuestion::create([
            'exam_id' => $id,
            'title' => $request->question['title'],
        ]);
        ExamOption::create([
            'exam_question_id' => $question->id,
            'c1' => $request->option[1],
            'c2' => $request->option[2],
            'c3' => $request->option[3],
            'c4' => $request->option[4],
            'correct' => $request->option['correct'],
        ]);

        alert()->success('سوال  با موفقیت افزوده شد', 'عملیات موفق');

        return back();
    }

    public function questions_delete($id)
    {
        $question = ExamQuestion::where('id', $id)->first();
        $question->delete();
    }

    public function exams_level($levelId)
    {
        if (auth()->user()->level_id + 1 < $levelId) {
            alert()->error('شما دسترسی ندارید.', 'ورود ناموفق');
            return redirect('panel');
        }
        $userId = auth()->user()->id;
        $row = Exam::with('level')
            ->where('level_id', $levelId)
            ->with('answers', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')->first();
        return view('panel.exam.level', ['row' => $row]);
    }

    public function take($id)
    {
        $userId = auth()->user()->id;

        $examtime = Exam::where('id', $id)->pluck('time')->first();
        $now = Carbon::now()->timestamp;
        $finishtime = $now + ($examtime * 60);
        $examhistory = ExamHistory::where('user_id', $userId)->where('exam_id', $id)->first();
        if (!$examhistory) {
            $examhistory = ExamHistory::create([
                'exam_id' => $id,
                'user_id' => $userId,
                'start_at' => $now,
                'finish_at' => $finishtime,
            ]);
        }
        $endtime = $examhistory->finish_at - Carbon::now()->timestamp;
        if ($endtime < 0) {
            if ($endtime * (-1) < 72 * 3600) {
                alert()->warning('زمان آزمون به پایان رسیده است', 'توجه');
                $level = Exam::where('id', $id)->pluck('level_id')->first();
                return redirect('/exams_list/' . $level);
            } else {
                $finishtime = $now + ($examtime * 60);
                $examhistory->update([
                    'finish_at' => $finishtime,
                ]);
                $endtime = $examhistory->finish_at - Carbon::now()->timestamp;
            }
        }
        $row = Exam::with('level')
            ->where('id', $id)
            ->with('answers', function ($q) use ($userId) {
                $q->where('user_id', $userId)->first();
            })
            ->orderBy('created_at', 'desc')->first();
        $questions = ExamQuestion::where('exam_id', $id)
            ->with('answers', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->with('options')
            ->paginate(1);

        return view('panel.exam.take', [
            'row' => $row,
            'endtime' => $endtime,
            'questions' => $questions,
        ]);
    }

    public function tik(Request $request)
    {
        $iduser = auth()->user()->id;
        $examid = ExamQuestion::where('id', $request->question_id)->pluck('exam_id')->first();
        $examhistory = ExamHistory::where('user_id', $iduser)->where('exam_id', $examid)->first();
        $endtime = $examhistory->finish_at - Carbon::now()->timestamp;
        if ($endtime < 0) {
            return 'زمان آزمون به پایان رسیده است.';
        }
        $correct = ExamOption::where('exam_question_id', $request->question_id)->pluck('correct')->first();
        $answer = ExamAnswer::where('exam_question_id', $request->question_id)->where('user_id', $iduser)->first();
        $exam = ExamQuestion::where('id', $request->question_id)->pluck('exam_id')->first();
        if ($request->option_value == $correct) {
            $true = 1;
        } else {
            $true = 0;
        }
        if ($answer) {
            $answer->update([
                'exam_option_id' => $request->option_value,
                'true' => $true,
            ]);
        } else {
            $answer = ExamAnswer::create([
                'exam_id' => $exam,
                'exam_option_id' => $request->option_value,
                'correct_option_id' => $correct,
                'exam_question_id' => $request->question_id,
                'user_id' => $iduser,
                'true' => $true,
            ]);
        }
        return 'پاسخ شما با موفقیت ثبت شد.';

    }
}

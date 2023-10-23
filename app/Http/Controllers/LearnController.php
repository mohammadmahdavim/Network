<?php

namespace App\Http\Controllers;

use App\Models\Learn;
use App\Models\Level;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->fileController = new FileController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Learn::with('level')->orderBy('sort', 'asc')->paginate(30);
        return view('panel.learn.index', ['rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();

        return view('panel.learn.create', ['levels' => $levels]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $row = Learn::create([
            'title' => $request->title,
            'sort' => $request->sort,
            'body' => $request->body,
            'level_id' => $request->level_id,
            'user_id' => auth()->user()->id,
        ]);
        $this->fileController->getUploadImage($request, $row, 'learn');
        alert()->success('آموزش جدید با موفقیت افزوده شد', 'عملیات موفق');

        return redirect('learns');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Learn::where('id', $id)->first();
        $levels = Level::all();
        return view('panel.learn.edit', ['row' => $row, 'levels' => $levels]);
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
        $row = Learn::where('id', $id)->first();
        $row->update([
            'sort' => $request->sort,
            'title' => $request->title,
            'body' => $request->body,
            'level_id' => $request->level_id,
        ]);
        $this->fileController->getUploadImage($request, $row, 'learn');
        alert()->success('آموزش  با موفقیت ویرایش شد', 'عملیات موفق');

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
        $row = Learn::where('id', $id)->first();
        $row->delete();
    }

    public function files($id)
    {
        $files = Learn::where('id', $id)->with('files')->first();
        return view('panel.learn.files', ['id' => $id, 'model' => 'App\Models\Learn', 'files' => $files]);
    }

    public function learns_level($levelId)
    {
        if (auth()->user()->level_id < $levelId) {
            alert()->error('          1-شما باید به این سطح برسید.
            2-در آزمون قبول شده باشید.
            3-مورد تایید مدیر باشید.
            ', 'ورود ناموفق')->autoclose('5000');
            return redirect('panel');
        }
        $rows = Learn::with('level')
            ->where('level_id', $levelId)
            ->orderBy('sort', 'asc')->paginate(12);
        return view('panel.learn.level', ['rows' => $rows]);
    }

    public function show($id)
    {
        $row = Learn::where('id', $id)
            ->with('files')
            ->with('user')
            ->first();
        return view('panel.learn.show', ['row' => $row]);

    }
}

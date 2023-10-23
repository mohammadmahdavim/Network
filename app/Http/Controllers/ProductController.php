<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $rows = Product::paginate(30);
        return view('panel.product.index', ['rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.product.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $row = Product::create([
            'title' => $request->title,
            'body' => $request->body,
            'little_body' => $request->little_body,
            'price' => $request->price,
            'remaining' => $request->remaining,
            'author' => auth()->user()->id,
        ]);
        $this->fileController->getUploadImage($request, $row, 'product');
        alert()->success('محصول جدید با موفقیت افزوده شد', 'عملیات موفق');

        return redirect('products');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Product::where('id', $id)->first();
        return view('panel.product.edit', ['row' => $row]);
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
        $row = Product::where('id', $id)->first();
        $row->update([
            'title' => $request->title,
            'body' => $request->body,
            'little_body' => $request->little_body,
            'price' => $request->price,
            'remaining' => $request->remaining,
        ]);
        $this->fileController->getUploadImage($request, $row, 'product');
        alert()->success('محصول  با موفقیت ویرایش شد', 'عملیات موفق');

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
        $row = Product::where('id', $id)->first();
        $row->delete();
    }

    public function files($id)
    {
        $files = Product::where('id', $id)->with('files')->first();
        return view('panel.product.files', ['id' => $id, 'model' => 'App\Models\Product', 'files' => $files]);
    }
}

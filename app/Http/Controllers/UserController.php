<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(30);
        return view('panel.user.index', ['rows' => $users]);
    }

    public function update(Request $request,$id)

    {
        $user=User::where('id',$id)->first();
        $user->update([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
        ]);
        alert()->success('کاربر  با موفقیت ویرایش شد', 'عملیات موفق');

        return back();
    }

}

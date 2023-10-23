<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function contact()
    {
        $rows = Contact::orderBy('created_at', 'desc')->paginate(30);
        return view('panel.contact', ['rows' => $rows]);
    }
}

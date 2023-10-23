<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function orders()
    {
        $rows = Invoice::with('user')->with('product')->orderBy('created_at','desc')->paginate(30);
        return view('panel.reports.orders', ['rows' => $rows]);
    }


    public function transactions()
    {
        $rows = Payment::paginate(30);
        return view('panel.reports.transactions');

    }

    public function status($id, $status)
    {
        $row = Invoice::where('id', $id)->first();
        $row->update([
            'status' => $status
        ]);
    }
}

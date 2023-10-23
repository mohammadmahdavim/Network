<?php

namespace App\Http\Controllers;

use App\Finanace;
use App\LogFinanace;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Gateway;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

class HomeController extends Controller
{
    public function index()
    {

        $blogs = Blog::where('active', 1)->orderBy('created_at', 'desc')->take(6)->get();
        return view('home.index', ['blogs' => $blogs]);
    }

    public function blog($id)
    {

        $row = Blog::where('id', $id)
            ->with('files')
            ->with('user')
            ->first();
        return view('home.blog', ['row' => $row]);

    }

    public function blogs()
    {
        $rows = Blog::with('files')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('home.blogs', ['rows' => $rows]);

    }

    public function products()
    {
        $rows = Product::with('files')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('home.products', ['rows' => $rows]);

    }

    public function buy($id)
    {

        $row = Product::where('id', $id)->first();
        return view('home.buy', ['row' => $row]);
    }

    public function pay(Request $request)
    {

        $product = Product::where('id', $request->product_id)->first();
        if ($product->remaining < 1) {
            alert()->warning('عملیات  ناموفق بود. موجودی انبار به اتمام رسیده است.');
            return back();
        }
        $data = [
            'mobile' => $request->mobile,
            'password' => Hash::make($request->mobile),
            'name' => $request->name,
            'email' => $request->email,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'address' => $request->address,
        ];
        $user = User::where('mobile', $request->mobile)->first();
        if (!$user) {
            $user = User::create($data);
        } else {
            $user->update($data);
        }
        // create invoice
        $invoice = Invoice::create([
            'user_id' => $user->id,
            'price' => $product->price,
            'product_id' => $request->product_id,
        ]);
        $gateway = Gateway::active()->first();
        if (!$gateway) {
            return response()->json([
                'message' => 'درگاه انتخاب شده معتبر نمی باشد.'
            ], 400);
        }

        if ($product->price > 100) {
            $token = Str::random(50);
            Payment::create([
                'user_id' => $user->id,
                'amount' => ($product->price) / 10,
                'gateway_id' => $gateway->id,
                'invoice_id' => $invoice->id,
                'token' => $token,
                'date' => time(),
                'trans_id' => null,
                'id_get' => null,
                'type' => 'online',
                'status' => 'waiting',
                'ip' => $request->ip(),
            ]);

            $payment = Gateway::payment($gateway->id, $token);
            $payment = $payment->getData();
            if ($payment->status == 200) {
                return redirect($payment->url);
            }

            return response()->json([
                'message' => 'ارتباط با بانک برقرار نمی باشد. بعدا تلاش کنید!'
            ], 400);
        }

        return response()->json([
            'message' => 'مبلغ باید بیش از 100 تومان باشد.'
        ], 400);
        // create payment
        // redirect to Zarinpal
        // after pay send SMS for user and admin and update invoice
        return $request;
    }

    public function checkout(Request $request, $token)
    {
        $payment = Payment::where('token', $token)
            ->where('status', 'waiting')
            ->first();
        $invoice = Invoice::where('id', $payment->invoice_id)->first();
        $product = Product::where('id', $invoice->product_id)->first();
        if ($payment and $request->Status == 'OK') {
            $invoice->update([
                'status' => 'paid',
                'payed_at' => Jalalian::now(),
            ]);
            $product->update([
                'remaining' => $product->remaining - 1,
            ]);
            $payment->update(['status' => 'success']);
            \App\lib\Kavenegar::sendSMS($invoice->user->mobile, 1000 + $invoice->id, 'product');
            alert()->success('عملیات با موفقیت انجام شد', 'موفق!');
            return redirect('buy/' . $invoice->product_id);
        }
        alert()->warning('عملیات پرداخت ناموفق بود. درصورت کسر پول ظرف 72 ساعت به حساب شما باز خواهد گشت.');
        return redirect('buy/' . $invoice->product_id);


        abort(404);
    }


    public function about()
    {
        return view('home.about');
    }

    public function develop()
    {
        return view('home.develop');
    }

    public function map()
    {
        return view('home.map');
    }


    public function contact()
    {
        return view('home.contact');
    }


    public function contact_store(Request $request)
    {
        Contact::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
        ]);
        alert()->success('منتظر تماس ما باشید!', 'موفق!');
        return back();
    }
}

<?php

namespace App\Http\Middleware;

use App\lib\Kavenegar;
use App\Models\ActivationCode;
use Closure;
use Illuminate\Http\Request;

class CheckActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()) {
            return $next($request);
        } else {
            $active = $this->checkActive();
            if ($active == 1) {
                return $next($request);
            } else {
                $code = $this->createActiveCode();
                $this->send_sms($code);
                return redirect('active');
            }
        }
    }

    public function checkActive()
    {
        return auth()->user()->active;
    }

    public function createActiveCode()
    {

        $uniqueNumber = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

        // Check if the generated number already exists in the database
        while (ActivationCode::where('code', $uniqueNumber)->exists()) {
            $uniqueNumber = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        }

        $this->storeCode($uniqueNumber);
        return $uniqueNumber;
    }

    public function storeCode($code)
    {
        ActivationCode::where('user_id', auth()->user()->id)->update(['active' => 0]);
        ActivationCode::create([
            'user_id' => auth()->user()->id,
            'code' => $code
        ]);
    }

    public function send_sms($code)
    {
        Kavenegar::sendSMS(auth()->user()->mobile, $code, 'active');
    }
}

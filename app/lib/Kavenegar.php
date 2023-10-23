<?php

namespace App\lib;

class Kavenegar
{

    public static function sendSMS($mobile, $token, $template)
    {
//dd('d');
        /*
         * Author: M.Fakhrani
         * Description : for send sms whit algorithm on kavenegar by API
         */
        $url = 'https://api.kavenegar.com/v1/444A782B6F6A3538536B30654A36496545673476464873436F7A645170544E702F767A6D62435857592F343D/verify/lookup.json?receptor=' . $mobile . '&token=' . $token . '&template=VerifyMobileMarket';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;

    }

}

?>

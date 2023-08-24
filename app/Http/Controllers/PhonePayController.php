<?php

namespace App\Http\Controllers;
use Shibanashiqc\PhonePayPhp\PhonePay;
use Illuminate\Http\Request;

class PhonePayController extends Controller
{
    public function phonePayCallback(Request $request)
    {
       dd($request->all());
    }
    
    public function phonePayPayment(Request $request)
    {
        $phone_pay = new PhonePay('MERCHANTUAT', '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399', 1);
        $phone_pay->client->setCallbackUrl(route('phone-pay.callback'));
        $phone_pay->client->setRedirectUrl(route('phone-pay.callback'));

        $request = $phone_pay->getPaymentRequest($request->amount, '1234567890', '1234567890', '9999999999');
        $redirect_url = $phone_pay->getPaymentRedirectUrl($request);
        
        return redirect()->to($redirect_url);
    }
}

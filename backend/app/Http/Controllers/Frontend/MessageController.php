<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function sendAppLink(Request $request){
        $sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/console
        $token = "YYYYYY"; // Your Auth Token from www.twilio.com/console

        $client = new Twilio\Rest\Client($sid, $token);
        $message = $client->messages->create(
//            $request->mobile_number, // Text this number
            array(
                'from' => $request->mobile_number, // From a valid Twilio number
                'body' => 'https://play.google.com/store/apps/details?id=com.whatsapp&hl=en_IN'
            )
        );

        print $message->sid;
    }

    public function subscribeNewsLetter(Request $request) {
        dd($request);
    }   
}

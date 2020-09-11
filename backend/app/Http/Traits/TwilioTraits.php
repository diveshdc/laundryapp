<?php
namespace App\Http\Traits;
use Exception;
use App\User;
use App\Order;

trait TwilioTraits {

public function send_nexmo_message($message) {
		$sid    = config('credentials.twilio.account_sid');
		$token  = config('credentials.twilio.auth_token');
		$from 	= config('credentials.twilio.sms_from');

		$url = "https://api.twilio.com/2010-04-01/Accounts/".$sid."/SMS/Messages.json";
		$data =array(
		
			"Body" => $message['text'],
			"From" => $from,
			"To"=>   $message['to']
		);
		$post = http_build_query($data);
		$ch = curl_init($url );
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $sid.':'.$token);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$result = curl_exec($ch);

		$result = json_decode($result,true);

		if ($result['status']!='queued') {
			$response = [
				'status' => false,
				'message' => $result['message']
			];
		}else{
			$response = [
				'status' => true,
				'message' => 'Success'
			];
		}

		\Log::info(json_encode($response));

		return $response;
	}
}
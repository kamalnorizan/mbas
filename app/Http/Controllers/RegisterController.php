<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Notifications\RegisterOTP;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;

class RegisterController extends Controller
{
    function validation(Request $request)
    {
        if($request->step==1){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone'=>['required','numeric'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'term'=>['required'],
                'g-recaptcha-response' => ['required', 'captcha']
            ],[
                'g-recaptcha-response.required' => 'Please complete the captcha',

            ]);

            $otp = rand(100000,999999);
            $otpCrypt = Crypt::encrypt($otp);
            $request->session()->put('otpmail',$otpCrypt);

            Notification::route('mail', $request->email)->notify(new RegisterOTP($otp));

            return response()->json(['success'=>true]);

        }else if($request->step==2){
            $request->validate([
                'otp' => ['required'],
            ]);

            $otp = Crypt::decrypt($request->session()->get('otpmail'));
            if($otp==$request->otp){
                $request->session()->remove('otpmail');
                $otpmobile = rand(100000,999999);
                $otpMobileCrypt = Crypt::encrypt($otpmobile);
                $request->session()->put('otpmobile',$otpMobileCrypt);
                $smsnumber = '6'.$request->otpPhone;
                $msg = 'MBAS-Template Your otp code is '.$otpmobile;
                $apiKey = env('SMSAPIKEY');
		$apiUrl = 'https://mysmsdvsb.azurewebsites.net/api/messages';
		$data = [
    			"keyword" => "MBAS-Template", // Change this to your actual keyword
    			"message" => $msg, // SMS content
    			"msisdn" => $smsnumber // Recipient phone number
		];
                $options = [
    			'http' => [
        		'header'  => "Content-Type: application/json\r\n",
        		'method'  => 'POST',
        		'content' => json_encode($data),
    			]
		];

		$context  = stream_context_create($options);
		$response = file_get_contents($apiUrl, false, $context);

		if ($response === FALSE) {
    			die('Error sending SMS');
		}

		// Decode the response
		$responseData = json_decode($response, true);
		if ($responseData && isset($responseData['status_code']) && $responseData['status_code'] == 200) {
                	return response()->json(['success'=>true]);
		}else{
			return response()->json(['success'=>false]);

		}
            }else{
                return response()->json(['success'=>false,'message'=>'Invalid OTP']);
            }
        }else if($request->step==3){

            $request->validate([
                'otpmobile' => ['required'],
            ]);

            $otp = Crypt::decrypt($request->session()->get('otpmobile'));
            if($otp==$request->otpmobile){
                $request->session()->remove('otpmobile');
                $user = new User();
                $user->uuid = Uuid::uuid4();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = Hash::make($request->password);
                $user->save();

                $user->assignRole('user');
                return response()->json(['success'=>true]);
            }else{
                return response()->json(['success'=>false,'message'=>'Invalid OTP']);
            }
        }
    }
}

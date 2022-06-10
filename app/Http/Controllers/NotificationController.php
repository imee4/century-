<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use AWS;
use Exception;

class NotificationController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */

     function aws()
     {
        $phone_number = "+2347035460599";
        $sms = AWS::createClient('sns');

        $sms->publish([
            'Message' => 'Hello, This is just a test Message',
            'PhoneNumber' => $phone_number,
            'MessageAttributes' => [
                'AWS.SNS.SMS.SMSType'  => [
                    'DataType'    => 'String',
                    'StringValue' => 'Transactional',
                 ]
           ],
        ]);
     }
    public function sendSmsNotificaition()
    {
        Log::alert("message");
        $basic  = new \Nexmo\Client\Credentials\Basic('8d6eb0dc', 'HF4hfRHzTdQw6QaP');
        //$basic  = new \Nexmo\Client\Credentials\Basic('Nexmo key', 'Nexmo secret');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '2347066352444',
            'from' => 'Century Info. Sys.',
            'text' => 'A simple hello message sent from Vonage SMS API'
        ]);

        //dd('SMS message has been delivered.');
    }

    public function twilioSms()
    {
        $receiverNumber = "+2347035460599";
        $message = "Sorry, You are receiving this Message from Century Information Systems Limited testing site";

        try {

            $account_sid = "AC0339b24353f96b6a59170c4e7cb456a9";
            $auth_token = "16e563a148c5e583852be28c7b127567";
            $twilio_number = "+15005550006";

           // Log::info($account_sid);

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

            Log:Info('SMS Sent Successfully.'. $client ." ". $message);

        } catch (Exception $e) {
            Log::info("Error: ". $e->getMessage());
        }
    }

    function sendSms()
    {

        // // Find your Account SID and Auth Token at twilio.com/console
        // // and set the environment variables. See http://twil.io/secure
        // $sid = getenv("TWILIO_ACCOUNT_SID");
        // $token = getenv("TWILIO_AUTH_TOKEN");
        // $twilio = new Client($sid, $token);

        // $message = $twilio->messages
        //                   ->create("+15558675310", // to
        //                            ["body" => "Hi there", "from" => "+15017122661"]
        //                   );

        //                   print($message->sid);
        //                   "account_sid": "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
        //                   "api_version": "2010-04-01",
        //                   "body": "McAvoy or Stewart? These timelines can get so confusing.",
        //                   "date_created": "Thu, 30 Jul 2015 20:12:31 +0000",
        //                   "date_sent": "Thu, 30 Jul 2015 20:12:33 +0000",
        //                   "date_updated": "Thu, 30 Jul 2015 20:12:33 +0000",
        //                   "direction": "outbound-api",
        //                   "error_code": null,
        //                   "error_message": null,
        //                   "from": "+15017122661",
        //                   "messaging_service_sid": "MGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
        //                   "num_media": "0",
        //                   "num_segments": "1",
        //                   "price": null,
        //                   "price_unit": null,
        //                   "sid": "SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
        //                   "status": "sent",
        //                   "subresource_uris": {
        //                     "media": "/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Media.json"
        //                   },
        //                   "to": "+15558675310",
        //                   "uri": "/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX.json"

    }
            // function sendSms()
        // {


        // Update the path below to your autoload.php,
        // see https://getcomposer.org/doc/01-basic-usage.md
        // require_once '/path/to/vendor/autoload.php';

        // use Twilio\Rest\Client;

        // // Find your Account SID and Auth Token at twilio.com/console
        // // and set the environment variables. See http://twil.io/secure
        // $sid = getenv("TWILIO_ACCOUNT_SID");
        // $token = getenv("TWILIO_AUTH_TOKEN");
        // $twilio = new Client($sid, $token);

        // $message = $twilio->messages
        //                   ->create("+15558675310", // to
        //                            ["body" => "Hi there", "from" => "+15017122661"]
        //                   );

        //                   print($message->sid);
        //                   "account_sid": "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
        //                   "api_version": "2010-04-01",
        //                   "body": "McAvoy or Stewart? These timelines can get so confusing.",
        //                   "date_created": "Thu, 30 Jul 2015 20:12:31 +0000",
        //                   "date_sent": "Thu, 30 Jul 2015 20:12:33 +0000",
        //                   "date_updated": "Thu, 30 Jul 2015 20:12:33 +0000",
        //                   "direction": "outbound-api",
        //                   "error_code": null,
        //                   "error_message": null,
        //                   "from": "+15017122661",
        //                   "messaging_service_sid": "MGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
        //                   "num_media": "0",
        //                   "num_segments": "1",
        //                   "price": null,
        //                   "price_unit": null,
        //                   "sid": "SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
        //                   "status": "sent",
        //                   "subresource_uris": {
        //                     "media": "/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Media.json"
        //                   },
        //                   "to": "+15558675310",
        //                   "uri": "/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX.json"
        //                   }
}


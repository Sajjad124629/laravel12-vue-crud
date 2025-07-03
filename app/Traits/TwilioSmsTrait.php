<?php
namespace App\Traits;
use Twilio\Rest\Client;

trait TwilioSmsTrait
{
    public function sendSms($phoneNumber, $sms, $message = '')
    {
        $TWILIO_SID = env('TWILIO_SID');
        $TWILIO_AUTH_TOKEN = env('TWILIO_AUTH_TOKEN');
        $TWILIO_PHONE_NUMBER = env('TWILIO_PHONE_NUMBER');
        
        try {
            $client = new Client($TWILIO_SID, $TWILIO_AUTH_TOKEN);
            $client->messages->create($phoneNumber, [
                'from' => $TWILIO_PHONE_NUMBER,
                'body' => $sms,
            ]);
            $message .= ' SMS sent successfully';
        } catch (\Exception $e) {
            $message .= ' '.$e->getMessage();
        }
        return $message;
    }
    
}

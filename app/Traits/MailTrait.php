<?php 
namespace App\Traits;

use App\Mail\OtpVerificationEmail;
use App\Mail\VerificationInformationMail;
use Illuminate\Support\Facades\Mail;

trait MailTrait {
    public function OtpMailSend($email,$route,$code,$message = ''){
        try{
            Mail::to($email)->send(new OtpVerificationEmail($route,$code));
            $message .= ' Check your email';
        }
        catch(\Exception $e){
            $message .=  ' '.$e->getMessage();
        }
        return $message;
    }
    public function VerificationMailSend($email,$message = '', $subject = 'Verification Information Mail'){
        try{
            Mail::to($email)->send(new VerificationInformationMail($message, $subject));
        }
        catch(\Exception $e){
            $message .=  ' tt'.$e->getMessage();
        }
        return $message;
    }
}
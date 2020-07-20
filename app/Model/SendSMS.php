<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\model\Sendmail;

class SendSMS extends Model {

    public function sendMailltesting($request, $key) {
        
        $mailData['data'] = $request;
        $mailData['subject'] = 'From New Website Testing';
        $mailData['attachment'] = array();
        $mailData['template'] = "email.resetpassword";
        $mailData['mailto'] = 'mahendrajavandhra@gmail.com';
        $sendMail = new Sendmail;
        return $sendMail->sendSMTPMail($mailData, $key);
    }

}

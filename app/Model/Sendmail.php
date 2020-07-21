<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Mail;

class Sendmail extends Model {

    public function sendSMTPMail($mailData, $key) {
        $pathToFile = $mailData['attachment'];
        $frommail = env('MAIL_USERNAME');
        $url = config('app.base_url').'/admin-resetpassword/'.$key;
        $mailsend = Mail::send($mailData['template'], ['data' => $url], function ($m) use ($mailData, $pathToFile, $frommail) {
                    $m->from($frommail, 'New Website');

                    $m->to($mailData['mailto'], "New Website")->subject($mailData['subject']);
                    if ($pathToFile != "") {
                        // $m->attach($pathToFile);
                    }

                    //  $m->cc($mailData['bcc']);
                });
        if ($mailsend) {
            return true;
        } else {
            return false;
        }
    }

}

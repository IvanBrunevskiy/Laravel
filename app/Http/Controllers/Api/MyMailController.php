<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\MySendEmail;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;

class MyMailController extends Controller
{



    public function __invoke() {
        $emails = $this->fromMail();
        $massages = $this->massages();
        foreach ($emails as $email){
            $rand_key = array_rand($massages , 1);
            MySendEmail::dispatch($massages[$rand_key], $email);
        }

        //new MySendEmail($this->massages(), $this->fromMail());
    }

    public function massages(){
        $massages  = [
            'верни бабки',
            'я тебя найду',
            'открывай дверь',
            'я тебя вижу',
            'время тикает',
            'не зли меня',
            'ставлю на счетчик',
            'бабулечки пора возвращать',
            'я иду за тобой',
            'верни бабки'
        ];

        return $massages;
    }

    public function fromMail(){

        $random_emails = [];
        for($i=0; $i<10; $i++){
            $random_emails[] = rand() . '@mail.com';
        }

        return $random_emails;
    }
}

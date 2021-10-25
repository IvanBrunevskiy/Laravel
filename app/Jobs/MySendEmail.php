<?php

namespace App\Jobs;

use App\Mail\MyMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MySendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $massage;
    public $from_email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($massage, $from_email)
    {
        $this->massage = $massage;
        $this->from_email = $from_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::to('bartan@mail.com')
            ->send(new MyMail($this->massage, $this->from_email));
            //->send(new MyMail('trrrrrr', 'kkkkkkk@mao.com'));
    }
}

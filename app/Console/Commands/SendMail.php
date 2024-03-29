<?php

namespace App\Console\Commands;

use App\User;
use App\DripEmailer;
use App\Mail\NewYearMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:new-year {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email for user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::find($this->argument('user'));
        Mail::to($user)->send(new NewYearMail());
    }
}

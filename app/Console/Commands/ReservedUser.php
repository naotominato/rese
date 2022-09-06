<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\NoticeMail;
use App\Mail\ReservedUserMail;
use App\Models\Reserve;
use App\Models\User;
use App\Models\Shop;
use Carbon\Carbon;

class ReservedUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reserveduser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description ='send email to reserved users today';

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
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $reserves = Reserve::whereDate('start', '=', $today)->orderBy('start', 'asc')->get();

        if (!empty($reserves))
        foreach ($reserves as $reserve) {
            $user_name = $reserve->user->name;
            $email = $reserve->user->email;
            $shop_name = $reserve->shop->name;
            $start = $reserve->start;
            Mail::send(new ReservedUserMail($user_name, $email, $shop_name, $start));
        }
    }
}


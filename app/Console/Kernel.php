<?php

namespace App\Console;

use App\Models\Email;
use App\Helper\WhatsApp;
use App\Models\Client;
use App\Models\Tenant;
use App\Mail\MailSummary;
use App\Models\Central\PackageUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    public function schedule(Schedule $schedule)
    {
        // PackageUser::where('end_date','>',now())->update(['paid' => 1]);
        PackageUser::where('end_date','<',now())->update(['paid' => 0]);
        $valid_users = PackageUser::where('end_date','>',now())->where('paid',1)->pluck('client_id');
        \DB::table('tenants')->whereIn('client_id', $valid_users)->update(['paid'=>1,'status'=>1]);
        \DB::table('tenants')->whereNotIn('client_id', $valid_users)->update(['paid'=>0,'status'=>0]);
    }
    
    public function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}

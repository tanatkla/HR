<?php
    
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;
    
class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';
     
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
     
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
        // \Log::info(strtotime(Carbon::now()));
        $users = User::get();
        // dd($years . ' ' . $months . ' ' . $days . ' ' .$hours);
        foreach($users as $index => $user){
            $date_diff = abs(strtotime(Carbon::now()) - strtotime($user->start_job));

            $years = floor($date_diff / (365 * 60 * 60 * 24));
            $months = floor(($date_diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($date_diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            $hours = floor(($date_diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
            
           // \Log::info($years . ' ' . $months . ' ' . $days . ' ' .$hours);

            if($years < 1){
                $total = ($months * 8); 
                $sub_total = $total - ($user->vacation_leave_total - $user->vacation_leave);
            }else if($years == 1 && $months ==0){
                \Log::info($years . ' ' . $months . ' ' . $days . ' ' .$hours);
                $total = (12 * 8) + 24; 
                $sub_total = ($total) - ($user->vacation_leave_total - $user->vacation_leave) ;
                // \Log::info( $total . ' ' . $sub_total );
                // 120 = 12*8 + 24
                //  = 120 - 
            };

            $user->vacation_leave_total = $total;
            $user->vacation_leave = $sub_total;
            $user->save();
        }


      
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
    }
}

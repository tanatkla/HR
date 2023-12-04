<?php
    
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;
    
class LogCronYear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cronyear';
     
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
        // \Log::info("Cron is working fine!");
        $users = User::get();

        foreach($users as $index => $user){
            $user->name = 'kla' . Carbon::now();
            $user->save();

        }

      
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
    }
}

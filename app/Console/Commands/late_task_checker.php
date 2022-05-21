<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Schedule;

class late_task_checker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'late:check';

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
        $today = Carbon::now()->format('Y-m-d');
        $data = Schedule::where('tanggal','<',$today)->where('status','On Progress')->get();
        // dd($data);
        $end=[];
        foreach($data as $d)
        {
            $end[]=Schedule::where('id',$d->id)->update([
                'status'=>'Incompleted'
            ]);
        }
        // dd($end);
    }
}

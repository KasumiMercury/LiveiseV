<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:DeleteData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unused data';

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
        $data = DB::table('stock')->where('status','0')->get();
        $num = count($data);
        
        for($i = 0; $i < $num; $i++){
            $tempData = json_decode(json_encode($data[$i]), true);
            DB::table('stock')->where('id', $tempData["id"])->delete();
        }
    }
}

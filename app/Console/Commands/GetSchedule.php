<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Google_Client;
use Google_Service_YouTube;

class GetSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:GetSchedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get Schedule time';

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
        $client = new Google_Client();
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));
        $youtube = new Google_Service_YouTube($client);

        $data = DB::table('stock')->where('status','1')->get();
        $dataNum = count($data);
        
        $VideoIDarray = [];
        for($i = 0; $i < $dataNum; $i++){
            $tempData = json_decode(json_encode($data[$i]), true);
            array_push($VideoIDarray,$tempData["VideoID"]);
        }
        $query = join(",",$VideoIDarray);

        $items = $youtube->videos->listVideos("liveStreamingDetails",
            array('id' => $query)
        );

        $itemNum = count($items);
        for($k = 0; $k < $itemNum; $k++){
            $tempDate = $items[$k]["liveStreamingDetails"]["scheduledStartTime"];
            
            $tempData = json_decode(json_encode($data[$k]), true);
            DB::table('stock')->where('id', $tempData["id"])
                                ->update([
                                    'schedule' => $tempDate,
                                ]);
        }
    }
}

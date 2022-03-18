<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Google_Client;
use Google_Service_YouTube;

class GetStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:GetStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get live status';

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

        $data = DB::table('stock')->where('status','>','0')->get();
        $dataNum = count($data);
        
        $VideoIDarray = [];
        if($dataNum > 30){
            $queryNum = 30;
        }else{
            $queryNum = $dataNum;
        }

        for($i = 0; $i < $queryNum; $i++){
            $tempData = json_decode(json_encode($data[$i]), true);
            array_push($VideoIDarray,$tempData["VideoID"]);
        }
        $query = join(",",$VideoIDarray);

        $items = $youtube->videos->listVideos("snippet",
            array('id' => $query)
        );

        $itemNum = count($items);

        for($k = 0; $k < $itemNum; $k++){
            $tempStatus = $items[$k]["snippet"]["liveBroadcastContent"];
                if($tempStatus == "none"){
                    $newStauts = 0;
                }elseif($tempStatus == "upcoming"){
                    $newStauts = 1;
                }elseif($tempStatus == "live"){
                    $newStauts = 2;
                }else{
                    $newStauts = 3;
                }
            
            $tempData = json_decode(json_encode($data[$k]), true);
            DB::table('stock')->where('id', $tempData["id"])
                                ->update([
                                    'status' => $newStauts,
                                ]);
        }

        var_dump($items);
    }
}

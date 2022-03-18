<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Type\ObjectType;

class GetRss extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:getRss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get youtube rss';

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
        $member = DB::table('member')->get();
        $memberArray = json_decode(json_encode($member), true);
        $memberNum = count($memberArray);

        for($i = 0; $i < $memberNum; $i++){
            $feed='https://www.youtube.com/feeds/videos.xml?channel_id='.$memberArray[$i]["ChannelID"];
            $xml = simplexml_load_file($feed);
            $obj = get_object_vars($xml);
            $obj_entry = $obj["entry"];
                
            for($k = 0; $k < 10; $k++){
                $temp = $obj_entry[$k];
                $tempArray = json_decode(json_encode($temp), true);
                $sendArray["title"] = $tempArray["title"];
                $sendArray["VideoID"] = str_replace('yt:video:', '', $tempArray["id"]);
                $sendArray["Channel"] = $memberArray[$i]["display"];
                $sendArray["member_id"] = $memberArray[$i]["id"];
                $isNew = DB::table('stock')->where('VideoID',$sendArray["VideoID"])->doesntExist();
                if($isNew){
                    DB::table('stock')->insert($sendArray);
                }
            }
        }
    }
}

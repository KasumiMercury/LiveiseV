<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function getStatus()
    {
        $live = DB::table('stock')
                    ->where('status','2')
                    ->join('member','stock.member_id','=','member.id')
                    ->select('stock.*','member.display','member.MainCol','member.ImageCol','member.ENname')
                    ->get();
        $schedule = DB::table('stock')
                    ->where('status','1')
                    ->orderBy('schedule', 'asc')
                    ->join('member','stock.member_id','=','member.id')
                    ->select('stock.*','member.display','member.MainCol','member.ImageCol','member.ENname')
                    ->get();
        
        return response()->json(
            [
                'live' => $live,
                'schedule' => $schedule,
            ]
        );
    }
}

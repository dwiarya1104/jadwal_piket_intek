<?php

namespace App\Http\Controllers;
use App\Schedule;
use Carbon\Carbon;
use Storage;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function schedule(Request $request) {
        $cek = Schedule::where('user_id',$request->user_id)->whereDate('tanggal', Carbon::today())->get();
        // dd($cek);

        if(count($cek) == 0) {
            return response()->json(['message' => 'Schedule Not Found'],404);
        }
        return response()->json($cek);
    }
}
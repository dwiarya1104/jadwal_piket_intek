<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index(Request $request) {
        if ($request->tanggal) {
            $data = Schedule::where('status','!=','On Progress')->where('tanggal',$request->tanggal)->get();
        } else {
            $data = Schedule::whereDate('tanggal',Carbon::today())->get();
        }


        return view('history.index',compact(['data']));
    }
}
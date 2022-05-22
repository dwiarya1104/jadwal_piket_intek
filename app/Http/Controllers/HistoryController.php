<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;

class HistoryController extends Controller
{
    public function index() {
        $data = Schedule::where('status','On Progress,Completed')->get();

        return view('history.index',compact(['data']));
    }
}
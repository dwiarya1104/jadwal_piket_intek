<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserActivityLog;
use Carbon\Carbon;

class ActivityController extends Controller
{
    protected function index()
    {
        $data = UserActivityLog::orderBy('created_at','DESC')->get();
        return view('activities.index',compact(['data','time']));
    }
}
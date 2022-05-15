<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserActivityLog;

class ActivityController extends Controller
{
    protected function index()
    {
        $data = UserActivityLog::all();
        return view('activities.index',compact('data'));
    }
}

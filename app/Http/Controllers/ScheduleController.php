<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use App\User;
use Auth;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data users for dropwdown
        $users = User::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');
        // get data users for dropwdown

        // munclin data berdasarkan user yang login
        $user = Auth::user();
        $data = Schedule::where('user_id', $user->id)->get();
        $dataadmin = Schedule::all();

        return view('schedule.index',compact(['users','data','dataadmin']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');

        $data = Schedule::all();
        // dd($data);
        return view('schedule.create',compact(['users','data']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $users = User::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');

        $this->validate($request,[
            "task_title" => 'required',
            "task_description" => 'required',
            "user_id" => 'required',
            "start_time" => 'required',
            "end_time" => 'required',
            "status" => 'required',
            "upload_bukti" => 'file|max:3072',
        ]);

        $data = new Schedule();
        // dd($data);
        $data->task_title = $request->task_title;
        $data->task_description = $request->task_description;
        $data->user_id = $request->user_id;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->status = $request->status;
        if($request->hasFile('upload_bukti')) {
            $request->file('upload_bukti')->move('bukti/',$request->file('upload_bukti')->getClientOriginalName());
        }
        $data->upload_bukti = $request->file('upload_bukti')->getClientOriginalName();
        $data->save();
        return redirect() -> route('schedule.index')->with('success','Successfully Added Schedule');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Schedule::find($id);
        $data->delete();

        return redirect()->route('schedule.index')->with('success','Successfuly Delete Schedule');
    }
}

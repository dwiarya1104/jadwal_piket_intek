<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use App\User;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use DB;


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
        $users = User::orderBy('name', 'ASC')
            ->role('user')
            ->get()
            ->pluck('name', 'id');
        // get data users for dropwdown

        // munclin data berdasarkan user yang login
        $user = Auth::user();
        $data = Schedule::select("*")->where('user_id', $user->id)->whereDate('tanggal', Carbon::today())->get();
        $dataadmin = Schedule::all();

        return view('schedule.index', compact(['users', 'data', 'dataadmin']));
    }

    public function apiSchedule(Schedule $data) {
        $data = Schedule::all();
        return response()->json($data, 200, [], JSON_UNESCAPED_SLASHES);
        // $data = Schedule::array([
        //     'task_title' => $this->task_title,
        //     'status' => $this->status,
        // ]);

        return response()->json($data,200);
    }

    /**
     * Show the form for creatinga a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $users = User::orderBy('name', 'ASC')
            ->get()
            ->pluck('name', 'id');

        $this->validate($request, [
            "task_title" => 'required',
            "task_description" => 'required',
            "user_id" => 'required',
            "tanggal" => 'required',
        ]);

        $data = new Schedule();
        // dd($data);
        $data->task_title = $request->task_title;
        $data->task_description = $request->task_description;
        $data->user_id = $request->user_id;
        $data->tanggal = $request->tanggal;
        $data->save();
        return redirect()->route('schedule.index')->with('success', 'Successfully Added Schedule');;
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
        $data = Schedule::find($id);
        $users = User::orderBy('name', 'ASC')
            ->role('user')
            ->get()
            ->pluck('name', 'id');

        return view('schedule.edit', compact(['data', 'users']));
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
        $data = Schedule::where('id', $id)->firstOrFail();

        $request->validate([
            "task_title" => 'required',
            "task_description" => 'required',
            "user_id" => 'required',
            "tanggal" => 'required',
            // "start_time" => 'required',
            // "end_time" => 'required',
        ]);

        $data->task_title = $request->task_title;
        $data->task_description = $request->task_description;
        $data->user_id = $request->user_id;
        $data->tanggal = $request->tanggal;
        // $data->start_time = $request->start_time;
        // $data->end_time = $request->end_time;
        $data->update();
        return redirect()->route('schedule.index')->with('success', 'Successfully Updated Schedule');
    }

    public function editUser($id)
    {
        $data = Schedule::find($id);

        return view('schedule.editUser',compact(['data']));
    }

    public function updateUser(Request $request, Schedule $schedule, $id)
    {
        $data = Schedule::where('id', $id)->firstOrFail();
        // dd($request);
        $request->validate([
            "status" => 'required',
            "upload_bukti" => 'file|max:3072',
        ]);

        $data->status = $request->status;
        $img = $request->file('upload_bukti');
        $filename = $img->getClientOriginalName();

        if ($request->hasFile('upload_bukti')) {
            $request->file('upload_bukti')->storeAs('/bukti',$filename);
        }

        $data->upload_bukti = $request->file('upload_bukti')->getClientOriginalName();
        $data->update();

        return redirect()->route('schedule.index')->with('success', 'Successfully Updated Schedule');;
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

        return redirect()->route('schedule.index')->with('success', 'Successfully Deleted Schedule');;
    }
}

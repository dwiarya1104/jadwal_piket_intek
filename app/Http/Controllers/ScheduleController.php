<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use App\User;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use DB;
use Storage;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'ASC')
            ->role('user')
            ->get()
            ->pluck('name', 'id');

        // munclin data berdasarkan user yang login
        $user = Auth::user();
        $data = Schedule::select("*")->where('user_id', $user->id)
        ->whereDate('tanggal', Carbon::today())
        ->get();

        $dataadmin = Schedule::orderBy('tanggal','DESC')->get();

        return view('schedule.index', compact(['users', 'data', 'dataadmin']));
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
        // return dd($users);

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

        $admin = Auth::user()->name;
        $activityLog = [
        'name_user' => $data->user->name,
        'name_admin' => $admin,
        'status_activity' => "Tambah",
        'tanggal' => $data->tanggal,
        // <!-- 'status_jadwal' => , -->
        ];
        DB::table('user_activity_log')->insert($activityLog);
        $data->save();
        // return dd($admin);
        return redirect()->route('schedule.index')->with('success', '<h4>Successfully Added Schedule</h4>');;
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
        return redirect()->route('schedule.index')->with('success', '<h4>Successfully Updated Schedule</h4>');
    }

    public function editUser($id)
    {
        $data = Schedule::find($id);

        return view('schedule.editUser',compact(['data']));
    }

    public function updateUser(Request $request, Schedule $schedule, $id)
    {
        $data = Schedule::where('id', $id)->firstOrFail();
        // $getDataUser = User::get();
        $request->validate([
            "status" => 'required',
            "upload_bukti" => 'required|file|max:3072',
        ]);


        $activityLog = [
        'name_user' => $data->user->name,
        'pp' => $data->user->poto,
        'status_activity' => "Update",
        'status_jadwal' => $request->status,
        'gambar' => $request->file('upload_bukti')->getClientOriginalName(),
        'tanggal' => $data->tanggal,
        ];
        // return dd($activityLog);

        $data->status = $request->status;
        $img = $request->file('upload_bukti');
        $filename = $img->getClientOriginalName();

        if ($request->hasFile('upload_bukti')) {
            $request->file('upload_bukti')->storeAs('/bukti',$filename);
        }

        $data->upload_bukti = $request->file('upload_bukti')->getClientOriginalName();

        DB::table('user_activity_log')->insert($activityLog);
        $data->update();
        // dd($data);

        return redirect()->route('schedule.index')->with('success', '<h4>Successfully Updated Schedule</h4>');
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
        if($data->upload_bukti){
            Storage::delete('/bukti/'.$data->upload_bukti);
        }
        $data->delete();

        return redirect()->route('schedule.index')->with('success', '<h4>Successfully Deleted Schedule</h4>');;

   }
}

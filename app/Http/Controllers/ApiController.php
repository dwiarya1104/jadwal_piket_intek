<?php

namespace App\Http\Controllers;
use App\Schedule;
use Carbon\Carbon;
use App\User;
use Storage;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function schedule(Request $request) {
        $cek = Schedule::where('user_id',$request->user_id)
        ->orderBy('created_at','DESC')
        ->whereDate('tanggal', Carbon::today())
        ->get();
        // dd($cek);

        if(count($cek) == 0) {
            return response()->json(['message' => 'Schedule Not Found'],404);
        }
        return response()->json($cek);
    }


    public function update(Request $request) {
        $data = Schedule::where('id', $request->id)->firstOrFail();
        if($request->hasFile('upload_bukti')){
            $request->validate([
                "status" => 'required',
                "upload_bukti" => 'file|max:3072',
                "task_description" => 'required'
            ]);
        }else{
            if($request->status=='Completed'){
                return response()->json([
                    'succes' => 'false',
                    'message' => 'Gagal! Harap Mengisi Image'
                ]);

            }
        }
        $data->status = $request->status;
        $img = $request->file('upload_bukti');
        if ($img == null) {
            $filename = null;
        } else {
            $filename = $img->getClientOriginalName();
        }

        if ($request->hasFile('upload_bukti')) {
            $request->file('upload_bukti')->storeAs('/bukti',$filename);
        }

        if ($data->status == 'Incompleted') {
            if ($request->hasFile('upload_bukti')) {
                $request->file('upload_bukti')->storeAs('/bukti',$filename);

                $data->upload_bukti = $request->file('upload_bukti')->getClientOriginalName();
            } else {
            $data->upload_bukti = null;
            }
        } else {
            $data->upload_bukti = $request->file('upload_bukti')->getClientOriginalName();
        }
        $data->task_description = $request->task_description;

        $data->update();
        return response()->json(['success'=> true,'message' => 'Berhasil Mengupdate data'],200);
    }

    public function addSchedule(Request $request) {

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

        return response()->json(['success'=> true,'message' => 'Berhasil Menambah Schedule'],200);
    }

    public function registration(Request $request ){
        $data = User::where('id',$request->id)->firstOrFail();

        $request->validate([
            'registration' => 'required'
        ]);
        $data->registration = $request->registration;
        $data->update();


        return response()->json(['success' => 'true', 'message' => 'Berhasil Menambahkan registrationIds','data' => $data]);
    }

    public function dataOb(Request $request) {
        $data = User::role('user')->get();

        $data_fix=[];
            foreach ($data as $d){
                $data_change['id']=$d->id;
                $data_change['name']=$d->name;
                $data_change['registration']=$d->registration;
                $data_fix[]=$data_change;
            }
        return response()->json($data_fix);
    }

    public function dataSchedule() {
        $data = Schedule::orderBy('created_at','DESC')->where('tanggal','=',Carbon::today())->get();

        $data_fix=[];
            foreach ($data as $d){
                $data_change['id']=$d->id;
                $data_change['task_title']=$d->task_title;
                $data_change['task_description']=$d->task_description;
                $data_change['tanggal']=$d->tanggal;
                $data_change['status']=$d->status;
                $data_change['upload_bukti']=$d->upload_bukti;
                $data_change['user_id']=$d->user->name;
                $data_change['updated_at']=$d->updated_at->format('Y-m-d');
                $data_fix[]=$data_change;
            }

    return response()->json($data_fix);
    }

    public function history(Request $request){
        if ($request->tanggal) {
            $data = Schedule::where('status','!=','On Progress')->where('tanggal',$request->tanggal)->get();
        } else {
            $data = Schedule::whereDate('tanggal',Carbon::today())->get();
        }

        $data_fix=[];
            foreach ($data as $d){
                $data_change['id']=$d->id;
                $data_change['task_title']=$d->task_title;
                $data_change['task_description']=$d->task_description;
                $data_change['tanggal']=$d->tanggal;
                $data_change['status']=$d->status;
                $data_change['upload_bukti']=$d->upload_bukti;
                $data_change['user_id']=$d->user->name;
                $data_change['updated_at']=$d->updated_at->format('Y-m-d');
                $data_fix[]=$data_change;
            }

        return response()->json($data_fix);
    }

    public function deleteSchedule(Request $request) {
        $data = Schedule::find($request->id);

        if($data->upload_bukti){
            Storage::delete('/bukti/'.$data->upload_bukti);
        }

        $data->delete();

        return response()->json(['success' => true, 'Message' => 'Berhasil Delete Schedule']);
    }
}
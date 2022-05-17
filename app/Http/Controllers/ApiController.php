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


    public function update(Request $request,$id) {
        $data = Schedule::where('id', $id)->firstOrFail();
        // $getDataUser = User::get();
        $request->validate([
            "status" => 'required',
            "upload_bukti" => 'required|file|max:3072',
        ]);

        $data->status = $request->status;
        $img = $request->file('upload_bukti');
        $filename = $img->getClientOriginalName();

        if ($request->hasFile('upload_bukti')) {
            $request->file('upload_bukti')->storeAs('/bukti',$filename);
        }

        $data->upload_bukti = $request->file('upload_bukti')->getClientOriginalName();

        $data->update();

        return response()->json(['message' => 'Berhasil mengubah data'],200);

}
}

<?php

namespace App\Http\Controllers;
use App\Schedule;
use Carbon\Carbon;
use Storage;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function schedule(Request $request) {
        $cek = Schedule::where('user_id',$request->user_id)->get();
        // dd($cek);

        if(count($cek) == 0) {
            return response()->json(['message' => 'ok'],404);
        }
        return response()->json([
            $cek
        ]);

}
}

// public function apiSchedule(Request $request) {
    // $data = Schedule::whereId($id)->first();

    // if($data) {
    //     return response()->json([
    //         'id' => $data->id,
    //         'title' => $data->task_title,
    //         'description' => $data->task_description,
    //         'image' => url(Storage::url('/bukti/'.$data->upload_bukti)),
    //         'tanggal'=> $data->tanggal,
    //         'status'=>$data->status,
    //         'created_at'=> Carbon::parse($data->created_at)->toDateTimeString(),
    //         'updated_at'=> Carbon::parse($data->updated_at)->toDateTimeString(),
    //         'user_id'=> $data->user_id
    //         $data
    //     ],200);
    // } else {
    //     return response()->json(['message'=>'Schedule Not Found'],404);
    // }
    // $data = Schedule::where('user_id', $user_id)->firstOrFail();


//     $request->validate([
//         'user_id' => 'required'
//     ]);

//     if( Auth::attempt(['user_id'=> $request->user_id])) {
//         $user = User::where('user_id', $request->user_id)->first();
//         $data = array(
//             'task_title' => $user->status
//         );
//         return response()->json(['status' => 'success','message'=> 'Login Successfuly', 'data' => $data,], 200);
//     } else {
//         return response()->json(['status' => 'error', 'message'=> 'Login Failed'], 403);
//     }

// }

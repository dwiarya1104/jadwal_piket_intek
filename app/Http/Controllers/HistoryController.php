<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Carbon\Carbon;
use Storage;

class HistoryController extends Controller
{
    public function index(Request $request) {
        $date = $request->tanggal;
        if ($request->tanggal) {
            $data = Schedule::where('status','!=','On Progress')->where('tanggal',$request->tanggal)->get();
        } else {
            $data = Schedule::where('tanggal',Carbon::today())->get();
        }
        // dd(Carbon::today());
        return view('history.index',compact(['data','date']));
    }

    public function destroy($id) {
        $data = Schedule::find($id);
        if($data->upload_bukti){
            Storage::delete('/bukti/'.$data->upload_bukti);
        }
        $data->delete();

        return redirect()->back()->with('success','Deleted History Succesfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use File;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::role('user')->get();
        return view('users.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
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
        $this->validate($request, [
            "name" => 'required|string',
            "username" => 'required|string',
            "email" => 'required|string|unique:users,email',
            "password" => 'required|max:40'
        ]);
        // dd($request()->all());
        $data = new User();
        // dd($data);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        $data->assignRole('user');

        return redirect()->route('users.index')->with('success', 'Successfully Added User');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = User::find($id);

        return view('users.edit')->with('data', $data);
    }

    public function editProfile(Request $request,$id) {

        $data = User::findOrFail($id);

        $img = $request->file('poto');
        $filename = $img->getClientOriginalName();


        $data->poto = $request->file('poto')->getClientOriginalName();
        if ($request->hasFile('poto')) {
            if($request->oldImage) {
                Storage::delete('/pp/'.$request->oldImage);
            }
            $request->file('poto')->storeAs('/pp',$filename);
        }
        $data->name = $request->name;
        $data->username = $request->username;
        $data->update();

        return redirect()->back()->with('success', 'success change profile');
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
        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;

        $data->save();

        return redirect()->route('users.index')->with('success', 'Successfully Updated Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();

        return redirect('/users')->with('success', 'Successfuly Delete Data');
    }

    public function AuthRouteAPI(Request $request)
    {
        return $request->user();
    }
}
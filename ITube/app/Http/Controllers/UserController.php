<?php

namespace ITube\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ITube\User;
use Image;

class UserController extends Controller
{
    private function rules($user = null) {
        $rules = [
            'name'     => 'required|min:4',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];
        if ($user) {
            $rules['email']    = 'required|email|unique:users,id,'.$user['id'];
            $rules['password'] = 'sometimes|min:8';
        }
        return $rules;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.view',array('user'=> Auth::user()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $user)
    {
        $status = "update";
        if (! $user) {
            $user = new User;
            $status = "create";
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }


        if ($user->save()) {
            session()->flash('status', 'User '.$status.'d successfully');
            return redirect(route('users.index'));
        }
        session()->flash('status', 'Unable to '.$status.' user. Please try again');
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = DB::table('users')
            ->where('id','=', $id)
            ->get();
        if (empty($users)) {
            Flash::error('Roles not found');

            return redirect(route('users.index'));
        }

        foreach($users as $user){

        }

        return view('user.view',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = DB::table('users')
            ->where('id','=', $id)
            ->get();
        if (empty($users)) {
            Flash::error('Roles not found');

            return redirect(route('users.index'));
        }

        foreach($users as $user){

        }

        return view('user.update',compact('user'));
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
        $status = "Update";

        $result = User::find($id);
        $result->name = $request->get('name');
        $result->email = $request->get('email');
        if($request->has('password')){
            $result->password = bcrypt($request->get('password'));
        }

        if($request->hasFile('user_image')){
            $avatar = $request->file('user_image');
            $filename = Auth::user()->id . '_' . date("Y-m-d", time()) . '.' . $avatar->getClientOriginalExtension();
//            Storage::disk('public')->makeDirectory('uploads/usersprofile/');
            Image::make($avatar)->resize(300,300)->save(public_path('uploads/usersprofile/'. $filename));

            $result->image = $filename;
        }

        if ($result->save()) {
            session()->flash('status', 'User '.$status.'d successfully');
            return redirect(route('users.index'));
        }
        session()->flash('status', 'Unable to '.$status.' user. Please try again');
        return back()->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

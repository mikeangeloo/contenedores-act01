<?php

namespace ITube\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ITube\Cable_Types;
use ITube\Cables;
use ITube\Projects;
use ITube\Tubes;
use ITube\Tubes_Types;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $projects = Projects::where('user_id','=',$user->id)->get();

        $tubes = Tubes::where('user_id','=',$user->id)->get();

        $tubestypes = new Tubes_Types();
        $tubestypes_id = $tubestypes->selectWhere($user->id);

        $cable = Cables::where('user_id','=',$user->id)->get();

        $cabletype = new Cable_Types();
        $cabletype_id = $cabletype->selectWhere($user->id);

        return view('dashboard.view',array('user'=>$user),compact('projects','tubes','tubestypes_id','cable','cabletype_id'));
    }

//    public function projectsList(){
//        $user = Auth::user();
//        $projects = Projects::where('user_id','=',$user->id)->get();
//        return view('dashboard.view',array('user'=>$user),compact('projects'));
//    }
}

<?php

namespace ITube\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ITube\tubes_types;
use Illuminate\Http\Request;

class tubes_TypesController extends Controller
{
    public function select_allTubeTypes(Request $request){

        if($request->ajax()){
            $tipotubo = new Tubes_Types();
            $tipo=$tipotubo->allTubeTypes();


            // Send as HTML

            $html = '';

            //$html .= '<select id="tubes_types" name="tubes_types" class="form-control">';
            $html .= '<option> Escoge... </option>';
            foreach ($tipo as $tube_type)
            {
                $html .= '<option value="'.$tube_type->id.'" data-tubename="'.$tube_type->name.'"> '.$tube_type->name.'</option>';
            }

            return $html;

        }
    }

    public function index(){

        $user = Auth::user();
        $tubes_types = new Tubes_Types();

        $_tubes_types = $tubes_types->selectWhere($user->id);
        return view('tubes_types.index',compact('user','_tubes_types'));

    }

    public function create(){
        $user = Auth::user();

        return view('tubes_types.create',compact('user'));
    }

    public function store(Request $request){

        $status = "Create";
        $user_id = Auth::user()->id;

        if(DB::table('tubes_types')->insert(
            ['user_id' => $user_id,
                'name' => $request->name,
                'general_description' => $request->general_description,
                'created_at' => Carbon::now()]
        )){
            session()->flash('status', 'Project '.$status.'d successfully');
            return redirect('/dashboard/view');
        }else{

            session()->flash('status', 'Unable to '.$status.' project try again');
            return back()->withInput();
        }
    }

    public function show($id){

    }

    public function edit($id){

        $user = Auth::user();

        $tube_type = DB::table('tubes_types')
            ->where('id','=', $id)
            ->get();
        if (empty($tube_type)) {
            Flash::error('Roles not found');

            return redirect(route('dashboard.index'));
        }

        foreach($tube_type as $_tube_type){

        }

        return view('tubes_types.update',compact('_tube_type','user'));

    }

    public function update(Request $request, $id){

        $status = "Actualizada";

        $user_id = Auth::user()->id;


        if (DB::table('tubes_types')
            ->where('id','=',$id)
            ->update([
                'user_id'=>$user_id,
                'name'=>$request->name,
                'general_description'=>$request->general_description
            ])) {
            session()->flash('status', 'Categoría '.$status.' Satisfactoriamente');
            return redirect(route('dashboard'));
        }
        session()->flash('status', 'Categoría tubo to '.$status.' user. Please try again');
        return back()->withInput();

    }

    public function destroy($id){
        $status = "Eliminada";


        if (DB::table('tubes_types')->where('id','=',$id)->delete()) {
            session()->flash('status', 'Categoría '.$status.' Satisfactoriamente');
            return redirect(route('dashboard'));
        }
        session()->flash('status', 'Categoría tubo to '.$status.' user. Please try again');
        return back()->withInput();


    }

}

<?php

namespace ITube\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use ITube\Tubes;
use Illuminate\Http\Request;
use ITube\Tubes_Types;

class TubesController extends Controller
{
    public function selectTubes(Request $request,$id){

        if($request->ajax()) {
            $_tubes = new Tubes();
            $_tubesWhere = $_tubes->selectWhere($id);


            // Send as HTML

            $html = '';

            //$html .= '<select id="tubes_types" name="tubes_types" class="form-control">';
            $html .= '<option> Escoge... </option>';
            foreach ($_tubesWhere as $_tubesid) {
                $html .= '<option value="' . $_tubesid->id . '"> ' . $_tubesid->description . '</option>';
            }
            $html .= '</select>';

            return $html;
        }

    }
    public function index(){

        $user = Auth::user();
        $tubes = new Tubes();

        $_tubes = $tubes->selectWhereUser($user->id);

        return view('tubes.index',compact('user','_tubes'));

    }

    public function create(){

        $user = Auth::user();
        $tubes_types = new Tubes_Types();

        $_tubes_types = $tubes_types->allTubeTypes();
        return view('tubes.create',compact('user','_tubes_types'));


    }

    public function store(Request $request){




    }

    public function show($id){
        echo "fasd";


    }

    public function edit($id){
        echo "edit";



    }

    public function update(Request $request, $id){

        echo "update";

    }

    public function destroy($id){
        echo "destroy";


    }
}

<?php

namespace ITube\Http\Controllers;

use ITube\Cables;
use Illuminate\Http\Request;

class CablesController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     * @return string
     */
    public function selectCables(Request $request, $id){


        //if($request->ajax()) {
            $_cables = new Cables();
            $_cablesWhere = $_cables->selectWhere($id);


            // Send as HTML

            $html = '';

            //$html .= '<select id="tubes_types" name="tubes_types" class="form-control">';
            $html .= '<option> Escoge... </option>';
            foreach ($_cablesWhere as $_cablesid) {
                $html .= '<option value="' . $_cablesid->id . '" data-cablename="'.$_cablesid->description.'"> ' . $_cablesid->description . '</option>';
            }
            $html .= '</select>';

            return $html;
        //}

    }
    public function getCableDiameter(Request $request, $id){

        //if($request->ajax()){
            $_cablesD = new Cables();
            $_cableDiameter = $_cablesD->getDiameter($id);


            return json_encode($_cableDiameter);

        //}
    }
}

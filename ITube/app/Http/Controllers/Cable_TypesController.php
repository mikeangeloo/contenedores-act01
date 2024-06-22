<?php

namespace ITube\Http\Controllers;

use ITube\Cable_Types;
use Illuminate\Http\Request;

class Cable_TypesController extends Controller
{
    public function selectAllCableTypes(Request $request){
        if($request->ajax()){
            $tipoCable = new Cable_Types();
            $tipoC=$tipoCable->allCableTypes();


            // Send as HTML

            $html = '';

            //$html .= '<select id="tubes_types" name="tubes_types" class="form-control">';
            $html .= '<option> Escoge... </option>';
            foreach ($tipoC as $cable_type)
            {
                $html .= '<option value="'.$cable_type->id.'" data-cablename_type="'.$cable_type->name.'"> '.$cable_type->name.'</option>';
            }
            $html .= '</select>';

            return $html;

        }
    }
}

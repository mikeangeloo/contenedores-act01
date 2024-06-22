<?php

namespace ITube;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cables extends Model
{
    public function selectWhere($id){
        $_cableTypes = DB::table('cables')
            ->select('id', 'description')
            ->where('cables_types_id','=', $id)
            ->get();
        return $_cableTypes;
    }

    public function getDiameter($id){
        $_cableDiameter = DB::table('cables')
            ->select('external_diameter')
            ->where('id','=', $id)
            ->get();
        return $_cableDiameter;
    }


}

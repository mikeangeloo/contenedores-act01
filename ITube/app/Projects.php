<?php

namespace ITube;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projects extends Model
{
    public function callSerachTubesProcedure_Public($area_cables,$num_cables, $idtype, $isForniture){
        $cable_types = DB::select('call search_tubes("'.$area_cables.'","'.$num_cables.'","'.$idtype.'","'.$isForniture.'")');
        return $cable_types;
    }

    public function callAll(){
        $results = Projects::all();
        return $results;
    }
}

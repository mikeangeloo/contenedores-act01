<?php

namespace ITube;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cable_Types extends Model
{
    public function allCableTypes(){
        $cable_types = DB::table('cables_types')->select('id', 'name')->get();
        return $cable_types;
    }

    public function selectWhere($id){
        $_cable_types = DB::table('cables_types')
            ->where('user_id','=', $id)
            ->get();
        return $_cable_types;
    }
}

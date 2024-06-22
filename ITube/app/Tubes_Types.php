<?php

namespace ITube;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tubes_Types extends Model
{
    public function allTubeTypes(){
        $tubes_types = DB::table('tubes_types')->select('id', 'name')->get();
        return $tubes_types;
    }

    public function selectWhere($id){
        $_tubes_types = DB::table('tubes_types')
            ->where('user_id','=', $id)
            ->get();
        return $_tubes_types;
    }
}

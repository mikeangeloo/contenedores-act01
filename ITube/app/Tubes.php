<?php

namespace ITube;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tubes extends Model
{
    public function selectWhere($id){
        $_tubes = DB::table('tubes')
            ->select('id', 'description')
            ->where('tubes_types_id','=', $id)
            ->get();
        return $_tubes;
    }

    public function selectWhereUser($id){
        $_tubes = DB::table('tubes')
            ->join('tubes_types', 'tubes_types.id', '=', 'tubes.tubes_types_id')
            ->select('tubes.*','tubes_types.name')
            ->where('tubes.user_id','=', $id)
            ->get();
        return $_tubes;
    }
}

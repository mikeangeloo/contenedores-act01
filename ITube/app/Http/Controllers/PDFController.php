<?php

namespace ITube\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function pdfview(Request $request){

        $items = $_POST;

        $items2 = array($items);

        view()->share('items',$items2);

        $filename=$request->nombreproyecto.' '.date("Y-m-d", time());



            $pdf = PDF::loadView('pdfview');



            return $pdf->stream($filename);

    }
}

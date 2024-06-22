<?php

namespace ITube\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use ITube\ProjectsContent;
use ITube\Projects;
use ITube\User;

class ProjectsController extends Controller
{
    public function index(){

    }


    public function store(Request $request){



        $status = "Create";
        SESSION_START();

        if($request->usuario=="1"){
            $proyecto = new Projects();
            $userid = User::where('name','=','Default')->get();
            $proyecto->user_id = $userid[0]['id'];
            $proyecto->name_project = $request->nombreproyecto;
            $proyecto->general_description = $request->descripcionproyecto;
            $newHash = Str::random(10);
            $proyecto->share_link = filter_var(url("projects/".$proyecto->user_id.$proyecto->name_project.$newHash),FILTER_SANITIZE_URL);

            $proyecto->content = $this->generarXML($request);
            if ($proyecto->save()) {

                $_SESSION['mensaje'] = "El proyecto ha sido guardado exitosamente";
                //session()->flash('status', 'Project '.$status.'d successfully');
                //return Redirect::to('/');
            }else{
                $_SESSION['error'] = "El proyecto no ha sido guardado";
                //session()->flash('status', 'Unable to '.$status.' project try again');
                //return back()->withInput();
            }


        }else{
            $proyecto = new Projects();
//            echo "<pre>";
//            print_r($_POST);
//            exit;
            //$userid = User::where('id','=',$request->usuario)->get();
            $proyecto->user_id = $request->usuario;
            $proyecto->name_project = $request->nombreproyecto;
            $proyecto->general_description = $request->descripcionproyecto;
            $newHash = Str::random(10);
            $proyecto->share_link = filter_var(url("projects/".$proyecto->user_id.$proyecto->name_project.$newHash),FILTER_SANITIZE_URL);

            $proyecto->content = $this->generarXML($request);
            if ($proyecto->save()) {

                $_SESSION['mensaje'] = "El proyecto ha sido guardado exitosamente";
                //session()->flash('status', 'Project '.$status.'d successfully');
                //return Redirect::to('/');
            }else{
                $_SESSION['error'] = "El proyecto no ha sido guardado";
                //session()->flash('status', 'Unable to '.$status.' project try again');
                //return back()->withInput();
            }
        }


    }

    public function show($id){

        $result = Projects::where('id','=',$id)->get();


        $user = Auth::user();

        return view('projects.view',compact("result","user"));
    }

    private function generarXML(Request $request){


        $suma_numcables =0;
        $xml = new DomDocument('1.0', 'UTF-8');

        $proyectonombre = $xml->createElement('trayectoria');
        $proyectonombre = $xml->appendChild($proyectonombre);

        $proyecto_contenido = $xml->createElement('Contenido');
        $proyecto_contenido = $proyectonombre->appendChild($proyecto_contenido);

        // Agregar un atributo al proyecto
        $proyecto_contenido->setAttribute('descripcionproyecto', $request->descripcionproyecto);

        $material = $xml->createElement('material', $request->material);
        $material = $proyecto_contenido->appendChild($material);

        $selected_material = $xml->createElement('selected_material',$request->selected_material);
        $selected_material = $proyecto_contenido->appendChild($selected_material);

        if($request->interior == true){
            $interior = $xml->createElement('interior','true');
            $interior = $proyecto_contenido->appendChild($interior);
        }

        if($request->interior == false){
            $interior = $xml->createElement('interior','false');
            $interior = $proyecto_contenido->appendChild($interior);
        }


        $cables_content = $xml->createElement('cables');
        $cables_content = $proyecto_contenido->appendChild($cables_content);




        $suma_num_cables = 0;
        $suma_areatotaldiameter = 0;
        for($i=0; $i<= count($request->numcables)-1; $i++){
            $cables = $xml->createElement('cable');
            $cables = $cables_content->appendChild($cables);

            $num_cables = $request['numcables'][$i];
            $num_diameter = $request['diameter'][$i];
            $areaCables = round(pi()*pow(($num_diameter/2),2),2);
            $totalareaCables = ($areaCables)*($num_cables);

            $cable_name = $xml->createElement('nombre',$request->cable[$i]);
            $cable_name = $cables->appendChild($cable_name);

            $cable_type = $xml->createElement('tipo',$request->tipocable[$i]);
            $cable_type = $cables->appendChild($cable_type);

            $cable_diameter = $xml->createElement('diametro_exterior',$request->diameter[$i]);
            $cable_diameter = $cables->appendChild($cable_diameter);

            $cables_amount = $xml->createElement('numero',$request->numcables[$i]);
            $cables_amount = $cables->appendChild($cables_amount);

            $cables_area = $xml->createElement('area_cables',$totalareaCables);
            $cables_area = $cables->appendChild($cables_area);

            $suma_num_cables = $suma_num_cables + $num_cables;
            $suma_areatotaldiameter = $suma_areatotaldiameter+$totalareaCables;

        }

        $suma = $xml->createElement('suma',$suma_num_cables);
        $suma = $cables->appendChild($suma);

        $area = $xml->createElement('area_total',$suma_areatotaldiameter);
        $area = $cables->appendChild($area);

        $conducto = $xml->createElement('conducto');
        $conducto = $proyecto_contenido->appendChild($conducto);

        $canaleta = $xml->createElement('canaleta','test');
        $canaleta = $conducto->appendChild($canaleta);

        $charola = $xml->createElement('charola','test');
        $charola = $conducto->appendChild($charola);

        $tubo=$xml->createElement('tubo');
        $tubo->setAttribute('nombre',$request->material_description);
        $tubo->setAttribute('tipo',$request->tubo_tipo);
        $tubo->setAttribute('tamano_comercial',$request->tubo_tamanocomercial);
        $tubo->setAttribute('diametro_interior',$request->tubo_diametroexterior);

        $tubo = $conducto->appendChild($tubo);





        $respuestas = $xml->createElement('respuesta',$request->respuestas);
        $respuestas = $proyectonombre->appendChild($respuestas);

        $xml->formatOutput = true;
        $xml_generate = $xml->saveXML();



        return $xml_generate;
    }

    public function calcularTrayectoria(){



        $suma_num_cables = 0;
        $suma_areatotaldiameter = 0;

         $html = '<h3>Para este trayecto es recomendable utilizar:</h3>';



        for($i=0; $i<= count($_POST['numcables'])-1; $i++){
            $num_cables = $_POST['numcables'][$i];
            $num_diameter = $_POST['diameter'][$i];
            $areaCables = round(pi()*pow(($num_diameter/2),2),2);
            $totalareaCables = ($areaCables)*($num_cables);

            $suma_num_cables = $suma_num_cables + $num_cables;
            $suma_areatotaldiameter = $suma_areatotaldiameter+$totalareaCables;

        }




         $idSelectedMaterial = $_POST['selected_material'];
         $isForniture = 0;
        if(isset($_POST['interior'])){
            $isForniture = 1;
        }



        $querry = new Projects();
        $result = $querry->callSerachTubesProcedure_Public($suma_areatotaldiameter,$suma_num_cables,$idSelectedMaterial,$isForniture);



//
        if(!empty($result)){
            foreach ($result as $_result) {

                if(isset($_result->one_driver)){

                    $html .= '<textarea block name="respuestas" id="respuestas">Area de cables ocupada: '.$suma_areatotaldiameter.' mm^2'."\n" .'Total de cables:'.$suma_num_cables."\n\r".'Material sugerido: '.$_result->description."\r".'Diametro Interior: '.$_result->inside_diameter."mm"."\r".'Area Total: '.$_result->hundred_area."mm^2"."\r".'Área 53%: '.$_result->one_driver."mm^2"."\n\r".'</textarea>';
                }
                if(isset($_result->two_driver)){
                    $html .= '<textarea block name="respuestas" id="respuestas">Area de cables ocupada: '.$suma_areatotaldiameter.' mm^2'."\n" .'Total de cables:'.$suma_num_cables."\n\r".'Material sugerido: '.$_result->description."\r".'Diametro Interior: '.$_result->inside_diameter."mm"."\r".'Area Total: '.$_result->hundred_area."mm^2"."\r".'Área 31%: '.$_result->two_driver."mm^2"."\n\r".'</textarea>';
                }
                if(isset($_result->more_two_driver)){
                    $html .= '<textarea block name="respuestas" id="respuestas">Area de cables ocupada: '.$suma_areatotaldiameter.' mm^2'."\n" .'Total de cables:'.$suma_num_cables."\n\r".'Material sugerido: '.$_result->description."\r".'Diametro Interior: '.$_result->inside_diameter."mm"."\r".'Area Total: '.$_result->hundred_area."mm^2"."\r".'Área 40%: '.$_result->more_two_driver."mm^2"."\n\r".'</textarea>';
                }
                if(isset($_result->sixty_area)){
                    $html .= '<textarea block name="respuestas" id="respuestas">Area de cables ocupada: '.$suma_areatotaldiameter.' mm^2'."\n" .'Total de cables:'.$suma_num_cables."\n\r".'Material sugerido: '.$_result->description."\r".'Diametro Interior: '.$_result->inside_diameter."mm"."\r".'Area Total: '.$_result->hundred_area."mm^2"."\r".'Área 60%: '.$_result->sixty_area."mm^2"."\n\r".'</textarea>';
                }

                $html.= '<input type="hidden" name="tubo_tipo" value="'.$_result->description.'">';
                $html.= '<input type="hidden" name="tubo_metrica" value="'.$_result->metric_designation.'">';
                $html.= '<input type="hidden" name="tubo_tamanocomercial" value="'.$_result->commercial_size.'">';
                $html.= '<input type="hidden" name="tubo_diametroexterior" value="'.$_result->inside_diameter.'">';

            }
        }else{
            $html .='<textarea>Prueba con otras combinaciónes, no existe material soportado :(</textarea>';
        }

        return $html;


    }

    public function update(Request $request, $id)
    {

        $status = "Update";
        $proyecto = Projects::find($id);

        $proyecto->user_id = $request->usuario;
        $proyecto->name_project = $request->nombreproyecto;
        $proyecto->general_description = $request->descripcionproyecto;
        $newHash = Str::random(10);
        $proyecto->share_link = filter_var(url("projects/".$proyecto->user_id.$proyecto->name_project.$newHash),FILTER_SANITIZE_URL);

        $proyecto->content = $this->generarXML($request);
        if ($proyecto->save()) {


            session()->flash('status', 'Project '.$status.'d successfully');
            return Redirect::to('/dashboard/view');
        }else{

            session()->flash('status', 'Unable to '.$status.' project try again');
            return back()->withInput();
        }
    }

    public function edit($id){
        $result = Projects::where('id','=',$id)->get();
        $user = Auth::user();

        return view('projects.update',compact("result","user"));

    }

}

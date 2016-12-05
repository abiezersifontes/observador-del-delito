<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Goutte\Client;
use App\Articulo;
use Redirect;
use App\Http\Requests\CreateArticleRequest;
use DB;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inicio');
    }


    public function extraer(){
        return view('extraer');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $articulo = Articulo::find($id);
      return response()->json($articulo);
      /*$articulo = Articulo::findOrFail($id);
        return view('editar',compact('articulo'));*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
         $genre = Articulo::find($id);
         $genre->fill($request->all());
         $genre->save();
         return response()->json(["mensaje" => "listo"]);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->delete();
        return response()->json(['mensaje'=> "datos eliminados"]);
    }

    public function graficar($desde,$hasta){

      /*$articulos = Articulo::whereBetween('fecha', [$fecha,  '2016-08-31'])->get();*/
      $delitos_pre = array('Asesinato', 'Robo', 'Extorsion', 'Violacion', 'Trafico_de_drogas', 'Indefinido', 'No_delito');

      $delitos = DB::table('articulos')
                    ->select('delito')
                    ->where('municipio','=','Heres')
                    ->distinct()
                    ->get();
      //$cant_delitos =
      foreach ($delitos as $delito) {
        $cant_delitos[] = DB::table('articulos')
                        ->where('municipio','=','Heres')
                        ->where('delito','=',$delito->delito)
                        ->whereBetween('fecha', [$desde, $hasta])
                        ->count();
        }



      $info = [$delitos,$cant_delitos];
      return response()->json([$info]);
    }


    public function getUltimoDiaMes($elAnio,$elMes) {
    return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
   }



   public function graficar_barra($anio,$mes)
   {
       $primer_dia=1;
       $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
       $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
       $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );

       $delitos = DB::table('articulos')
                     ->where('municipio','=','Heres')
                     ->whereBetween('fecha', [$fecha_inicial, $fecha_final])
                     ->get();

       $ct=count($delitos);

       for($d=1;$d<=$ultimo_dia;$d++){
           $registros[$d]=0;
       }

       foreach($delitos as $delito){
       $diasel=intval(date("d",strtotime($delito->fecha) ) );

       $registros[$diasel]++;
       }


       $data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros);
       return   json_encode($data);
   }


    public function listarticulos(Request $request){
      $articulos = Articulo::paginate(1);
      if($request->ajax()){
        return response()->json(view('layout.articulos',compact('articulos'))->render());
      }
      return view('consulta',compact('articulos'));
    }

    public function modificar($id)
    {

    }

    public function modal($id)
    {
        $articulo = Articulo::find($id);
        return response()->json($articulo);
    }



    public function scrapprogre(Request $request){
      $client = new Client();
      //$crawler = $client->request('GET', 'http://localhost:9090/progreso/index.html');
      $crawler = $client->request('GET', 'http://www.diarioelprogreso.net/sucesos');
      //$crawler = $client->request('GET', 'http://www.diarioelprogreso.net/sucesos.html?start=15');

      $periodico = 'el progreso';

      //Obtener los links
      $links = str_replace('html#disqus_threa','',$crawler->filter('a[class="jwDisqusListingCounterLink"]')->each(function ($node, $i) { return strval($node->attr('href')); }));
      //Obtener titulos
      $titles = $crawler->filter('header[class="article-header"]')->each(function ($node, $i) { return trim(strval($node->text())); });

      //obtener fecha
      $prefecha = $crawler->filter('dd[class="create"]')->each(function ($node, $i) { return strval($node->text()); });

      for ($h=0; $h <15 ; $h++) {
        $fecha2 = str_replace('- ','',$prefecha[$h]);
        $fecha3 = str_replace(',','',$fecha2);
        $fecha4 = explode(' ',$fecha3);
        if($fecha4[0]=='Ene' or $fecha4[0]=='ENE'){
          $mes = '01';
        }elseif($fecha4[0]=='Feb' or $fecha4[0]=='FEB'){
          $mes = '02';
        }elseif($fecha4[0]=='Mar' or $fecha4[0]=='MAR'){
          $mes = '03';
        }elseif($fecha4[0]=='Abr' or $fecha4[0]=='ABR'){
          $mes = '04';
        }elseif($fecha4[0]=='May' or $fecha4[0]=='MAY'){
          $mes = '05';
        }elseif($fecha4[0]=='Jun' or $fecha4[0]=='JUN'){
          $mes = '06';
        }elseif($fecha4[0]=='Jul' or $fecha4[0]=='JUL'){
          $mes = '07';
        }elseif($fecha4[0]=='Ago' or $fecha4[0]=='AGO'){
          $mes = '08';
        }elseif($fecha4[0]=='Sep' or $fecha4[0]=='SEP'){
          $mes = '09';
        }elseif($fecha4[0]=='Oct' or $fecha4[0]=='OCT'){
          $mes = '10';
        }elseif($fecha4[0]=='Nov' or $fecha4[0]=='NOV'){
          $mes = '11';
        }elseif($fecha4[0]=='Dic' or $fecha4[0]=='DIC'){
          $mes = '12';
        }
        $fecha[$h] = $fecha4[2]."-".$mes."-".$fecha4[1];
      }


      //Obtener descripciones
      for($i=0; $i<15; $i++){
        $crawler = $client->request('GET',$links[$i]);
        $desc1 = implode($crawler->filter('article[class="item-page"]')->each(function ($node) { return $node->text(); }));
        $descs[$i] = $this->sanear_desc($desc1);
      }

      for ($k=0; $k <15 ; $k++) {

        //definir delitos
        $delito[$k] = $this->def_delito($descs[$k]);

        if(strpos($descs[$k], 'estado Bolívar') or strpos($descs[$k], 'Estado Bolívar')){
          $estado[$k] = 'Bolivar';
          $municipio[$k] = 'Desconocido';
          $parroquia[$k] = 'Desconocida';
        }elseif(strpos($descs[$k],'Ciudad Bolivar') or strpos($descs[$k],'Ciudad Bolivar') or strpos($descs[$k],'Heres') or strpos($descs[$k],'heres') or strpos($descs[$k],'HERES')
        or strpos($descs[$k],'Ciudad Bolívar')or strpos($descs[$k],'Municipio Heres') or strpos($descs[$k],'municipio heres') or strpos($descs[$k],'municipio heres') or strpos($descs[$k],'la capital bolivarense')){
          $estado[$k] = 'Bolivar';
          $municipio[$k] = 'Heres';
          $parroquia[$k] = 'Desconocida';
        }elseif(strpos($descs[$k],'Marhuanta')){
          $estado[$k] = 'Bolivar';
          $municipio[$k] = 'Heres';
          $parroquia[$k] = 'Marhuanta';
        }elseif (strpos($descs[$k],'Los Coquitos')) {
          $estado[$k] = 'Bolivar';
          $municipio[$k] = 'Heres';
          $parroquia[$k] = 'Los Coquitos';
        }elseif (strpos($descs[$k],'Los Coquitos')) {
          $estado[$k] = 'Bolivar';
          $municipio[$k] = 'Heres';
          $parroquia[$k] = 'Los Coquitos';
        }elseif (strpos($descs[$k],'La Sabanita')){
          $estado[$k] = 'Bolivar';
          $municipio[$k] = 'Heres';
          $parroquia[$k] = 'Los Coquitos';
        }else {
          $estado[$k] = 'Desconocido';
          $municipio[$k] = 'Desconocido';
          $parroquia[$k] = 'Desconocido';
        }

        $array = [
          "titulo"      => $titles[$k],
          "descripcion" => $descs[$k],
          "link"        => $links[$k],
          "fecha"       => $fecha[$k],
          "periodico"   => $periodico,
          "delito"      => $delito[$k],
          "estado"      => $estado[$k],
          "municipio"   => $municipio[$k],
          "parroquia"   => $parroquia[$k]
        ];
        $validator = Validator::make($array, [
            'titulo' => 'unique:articulos',

        ]);

        if ($validator->fails()) {
            continue;
        }else {
          $articulo = new Articulo;
          $articulo->titulo = $array['titulo'];
          $articulo->descripcion = $array['descripcion'];
          $articulo->link = $array['link'];
          $articulo->fecha = $array['fecha'];
          $articulo->estado = $array['estado'];
          $articulo->municipio = $array['municipio'];
          $articulo->parroquia = $array['parroquia'];
          $articulo->periodico = $array['periodico'];
          $articulo->delito = $array['delito'];
          $articulo->save();
        }
      }
      return redirect()->route('listarticulos');
    }


    public function sanear_desc($desc1){
        $subcadena = "View Comments";
        $posubcadena = strpos ($desc1, $subcadena);
        $string2 = substr ($desc1, ($posubcadena+13));
        $string3 = explode('//<!',$string2);
        $string4 = trim($string3[0]);
        return $string4;
    }


  public function def_delito($desc){
      //determinar delito
      $count=0;

      $asesinatos  = array('asesinado', 'el presunto asesino', 'asesinada', 'asesinato','lo ultimaron',
      'fue ultimado', 'fue acribillado', 'luego de recibir un tiro', 'dio muerte', 'cadáver tiroteado',
      'el homicidio', 'resultó abatido');
      $robos = array('robo', 'los presuntos ladrones', 'los presuntos asaltantes', 'asalto');
      $extorsiones = array('Extorsion', 'extorsion', 'extorsionadores', 'extorsionaron', 'extorsionaban');
      $violaciones = array('Violador', 'violador', 'presunto violador', 'haber abusado sexualmente',
      'abusado sexualmente');
      $electrocutados = array('electrocutado','murio electrocutado','colision de vehiculos','Trafico de drogas');
      $trafico_de_drogas = array('panelas de cocaína', 'cocaína', 'trafico de droga');
      $indefidos = array('golpeo salvajemente','golpeo','sucicidios','suicidio');
      $no_delitos = array('desaparecida');

      $delitos = array(
        'Asesinato'           =>  $asesinatos,
        'Robo'                =>  $robos,
        'Extorsion'           =>  $extorsiones,
        'Violacion'           =>  $violaciones,
        'Trafico_de_drogas'   =>  $trafico_de_drogas,
        'Indefinido'          =>  $indefidos,
        'No_delito'           =>  $no_delitos
      );

      foreach($delitos as $delito => $key){
        foreach($key as $palabra){
          if(strpos($desc,$palabra)){
            $count++;
          }
        }
        if($count>0){
          return $delito;
          break;
        }
      }
      if($count<1){
        return 'Indefinido';
      }
    }

    public function reestablecer(){
      Articulo::withTrashed()->restore();
      echo "datos reestabecidos";
    }

}

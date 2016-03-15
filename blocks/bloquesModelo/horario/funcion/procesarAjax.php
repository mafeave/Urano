<?php


use bloquesModelo\horario\Sql;

include_once ('redireccionar.php');
$conexion = "academica";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );


if ($_REQUEST ['funcion'] == 'buscarHorario') {
	
	//$cadenaSql = $this->sql->getCadenaSql ( 'buscarHorario', $_REQUEST['valor']);
	$cadenaSql = $this->sql->getCadenaSql ( 'buscarHorario');
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	//var_dump($resultadoItems);
	//redireccion::redireccionar ( 'ver', $resultadoItems );

}
?>

<script type="text/javascript">


var arreglo=<?php echo json_encode($resultadoItems);?>;


////////asignar posicion de acuerdo al día y la hora
for (var i=0; i<arreglo.length; i++){
	if(arreglo[i]['DIA']=='LUNES'){
		if(arreglo[i]['HORA']==6) eval("var tede" + i + " = 'ma00701'"); 
		else if(arreglo[i]['HORA']==7) eval("var tede" + i + " = 'ma00801'"); 
		else if(arreglo[i]['HORA']==8) eval("var tede" + i + " = 'ma00901'"); 
		else if(arreglo[i]['HORA']==9) eval("var tede" + i + " = 'ma00011'"); 
		else if(arreglo[i]['HORA']==10) eval("var tede" + i + " = 'ma00111'"); 
		else if(arreglo[i]['HORA']==11) eval("var tede" + i + " = 'mp00211'"); 
		else if(arreglo[i]['HORA']==12) eval("var tede" + i + " = 'mp00101'"); 
		else if(arreglo[i]['HORA']==13) eval("var tede" + i + " = 'mp00201'"); 
		else if(arreglo[i]['HORA']==14) eval("var tede" + i + " = 'mp00301'"); 
		else if(arreglo[i]['HORA']==15) eval("var tede" + i + " = 'mp00401'"); 
		else if(arreglo[i]['HORA']==16) eval("var tede" + i + " = 'mp00501'"); 
		else if(arreglo[i]['HORA']==17) eval("var tede" + i + " = 'mp00601'"); 	
} 

		if(arreglo[i]['DIA']=='MARTES'){
			if(arreglo[i]['HORA']==6) eval("var tede" + i + " = 'ma00702'"); 
			else if(arreglo[i]['HORA']==7) eval("var tede" + i + " = 'ma00802'"); 
			else if(arreglo[i]['HORA']==8) eval("var tede" + i + " = 'ma00902'"); 
			else if(arreglo[i]['HORA']==9) eval("var tede" + i + " = 'ma00012'"); 
			else if(arreglo[i]['HORA']==10) eval("var tede" + i + " = 'ma00112'"); 
			else if(arreglo[i]['HORA']==11) eval("var tede" + i + " = 'mp00212'"); 
			else if(arreglo[i]['HORA']==12) eval("var tede" + i + " = 'mp00102'"); 
			else if(arreglo[i]['HORA']==13) eval("var tede" + i + " = 'mp00202'"); 
			else if(arreglo[i]['HORA']==14) eval("var tede" + i + " = 'mp00302'"); 
			else if(arreglo[i]['HORA']==15) eval("var tede" + i + " = 'mp00402'"); 
			else if(arreglo[i]['HORA']==16) eval("var tede" + i + " = 'mp00502'"); 
			else if(arreglo[i]['HORA']==17) eval("var tede" + i + " = 'mp00602'"); 	
		} 

	if(arreglo[i]['DIA']=='MIERCOLES'){
		if(arreglo[i]['HORA']==6) eval("var tede" + i + " = 'ma00703'"); 
		else if(arreglo[i]['HORA']==7) eval("var tede" + i + " = 'ma00803'"); 
		else if(arreglo[i]['HORA']==8) eval("var tede" + i + " = 'ma00903'"); 
		else if(arreglo[i]['HORA']==9) eval("var tede" + i + " = 'ma00013'"); 
		else if(arreglo[i]['HORA']==10) eval("var tede" + i + " = 'ma00113'"); 
		else if(arreglo[i]['HORA']==11) eval("var tede" + i + " = 'mp00213'"); 
		else if(arreglo[i]['HORA']==12) eval("var tede" + i + " = 'mp00103'"); 
		else if(arreglo[i]['HORA']==13) eval("var tede" + i + " = 'mp00203'"); 
		else if(arreglo[i]['HORA']==14) eval("var tede" + i + " = 'mp00303'"); 
		else if(arreglo[i]['HORA']==15) eval("var tede" + i + " = 'mp00403'"); 
		else if(arreglo[i]['HORA']==16) eval("var tede" + i + " = 'mp00503'"); 
		else if(arreglo[i]['HORA']==17) eval("var tede" + i + " = 'mp00603'"); 
		
	} 

	if(arreglo[i]['DIA']=='JUEVES'){
		if(arreglo[i]['HORA']==6) eval("var tede" + i + " = 'ma00704'"); 
		else if(arreglo[i]['HORA']==7) eval("var tede" + i + " = 'ma00804'"); 
		else if(arreglo[i]['HORA']==8) eval("var tede" + i + " = 'ma00904'"); 
		else if(arreglo[i]['HORA']==9) eval("var tede" + i + " = 'ma00014'"); 
		else if(arreglo[i]['HORA']==10) eval("var tede" + i + " = 'ma00114'"); 
		else if(arreglo[i]['HORA']==11) eval("var tede" + i + " = 'mp00214'"); 
		else if(arreglo[i]['HORA']==12) eval("var tede" + i + " = 'mp00104'");
		else if(arreglo[i]['HORA']==13) eval("var tede" + i + " = 'mp00204'"); 
		else if(arreglo[i]['HORA']==14) eval("var tede" + i + " = 'mp00304'"); 
		else if(arreglo[i]['HORA']==15) eval("var tede" + i + " = 'mp00404'"); 
		else if(arreglo[i]['HORA']==16) eval("var tede" + i + " = 'mp00504'"); 
		else if(arreglo[i]['HORA']==17) eval("var tede" + i + " = 'mp00604'"); 
		
	} 



	if(arreglo[i]['DIA']=='VIERNES'){
		if(arreglo[i]['HORA']==6) eval("var tede" + i + " = 'ma00705'"); 
		else if(arreglo[i]['HORA']==7) eval("var tede" + i + " = 'ma00805'"); 
		else if(arreglo[i]['HORA']==8) eval("var tede" + i + " = 'ma00905'"); 
		else if(arreglo[i]['HORA']==9) eval("var tede" + i + " = 'ma00015'"); 
		else if(arreglo[i]['HORA']==10) eval("var tede" + i + " = 'ma00115'");
		else if(arreglo[i]['HORA']==11) eval("var tede" + i + " = 'mp00215'"); 
		else if(arreglo[i]['HORA']==12) eval("var tede" + i + " = 'mp00105'"); 
		else if(arreglo[i]['HORA']==13) eval("var tede" + i + " = 'mp00205'"); 
		else if(arreglo[i]['HORA']==14) eval("var tede" + i + " = 'mp00305'"); 
		else if(arreglo[i]['HORA']==15) eval("var tede" + i + " = 'mp00405'"); 
		else if(arreglo[i]['HORA']==16) eval("var tede" + i + " = 'mp00505'"); 
		else if(arreglo[i]['HORA']==17) eval("var tede" + i + " = 'mp00605'"); 		
		
	} 

	if(arreglo[i]['DIA']=='SABADO'){
		if(arreglo[i]['HORA']==6) eval("var tede" + i + " = 'ma00706'"); 
		else if(arreglo[i]['HORA']==7) eval("var tede" + i + " = 'ma00806'"); 
		else if(arreglo[i]['HORA']==8) eval("var tede" + i + " = 'ma00906'"); 
		else if(arreglo[i]['HORA']==9) eval("var tede" + i + " = 'ma00016'"); 
		else if(arreglo[i]['HORA']==10) eval("var tede" + i + " = 'ma00116'");
		else if(arreglo[i]['HORA']==11) eval("var tede" + i + " = 'mp00216'"); 
		else if(arreglo[i]['HORA']==12) eval("var tede" + i + " = 'mp00106'"); 
		else if(arreglo[i]['HORA']==13) eval("var tede" + i + " = 'mp00206'"); 
		else if(arreglo[i]['HORA']==14) eval("var tede" + i + " = 'mp00306'"); 
		else if(arreglo[i]['HORA']==15) eval("var tede" + i + " = 'mp00406'"); 
		else if(arreglo[i]['HORA']==16) eval("var tede" + i + " = 'mp00506'"); 
		else if(arreglo[i]['HORA']==17) eval("var tede" + i + " = 'mp00606'"); 		
		
	} 
}


var color1 = 'green-label';
var tasker1 = '<?php  echo $resultadoItems[0]['ESPACIO']; ?>';

<?php 
	for($i=0; $i<count($resultadoItems); $i++){
		$a='tede'.$i;
?>
		$('#'+<?php  echo 'tede'.$i ?>).text(tasker1).addClass(color1).show();
<?php 
	}
?>


</script>
 
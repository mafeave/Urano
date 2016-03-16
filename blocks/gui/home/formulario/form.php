<?php
namespace gui\accesoIncorrecto;

use \DateTime;
use \DateInterval;

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}
class Formulario {
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	var $miSesion;
	function __construct($lenguaje, $formulario, $sql) {
		$this->miConfigurador = \Configurador::singleton ();
		
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		
		$this->lenguaje = $lenguaje;
		
		$this->miFormulario = $formulario;
		
		$this->miSql = $sql;
		
		$this->miSesion = \Sesion::singleton ();
	}
	function formulario() {
		
		/**
		 * IMPORTANTE: Este formulario está utilizando jquery.
		 * Por tanto en el archivo ready.php se delaran algunas funciones js
		 * que lo complementan.
		 */
		
		// Rescatar los datos de este bloque
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		
		// ---------------- SECCION: Parámetros Globales del Formulario ----------------------------------
		/**
		 * Atributos que deben ser aplicados a todos los controles de este formulario.
		 * Se utiliza un arreglo
		 * independiente debido a que los atributos individuales se reinician cada vez que se declara un campo.
		 *
		 * Si se utiliza esta técnica es necesario realizar un mezcla entre este arreglo y el específico en cada control:
		 * $atributos= array_merge($atributos,$atributosGlobales);
		 */
		$atributosGlobales ['campoSeguro'] = 'true';
		$_REQUEST ['tiempo'] = time ();
		
		$conexion = 'academica';
		$esteRecurso = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$conexion2 = 'estructura';
		$esteRecurso2 = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion2 );
		
		$usuario = $this->miSesion->getSesionUsuarioId ();
		
		// -------------------------------------------------------------------------------------------------
		// var_dump($_REQUEST);
		// ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
		$esteCampo = $esteBloque ['nombre'];
		$atributos ['id'] = $esteCampo;
		$atributos ['nombre'] = $esteCampo;
		
		// Si no se coloca, entonces toma el valor predeterminado 'application/x-www-form-urlencoded'
		$atributos ['tipoFormulario'] = '';
		
		// Si no se coloca, entonces toma el valor predeterminado 'POST'
		$atributos ['metodo'] = 'POST';
		
		// Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
		$atributos ['action'] = 'index.php';
		$atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo );
		
		// Si no se coloca, entonces toma el valor predeterminado.
		$atributos ['estilo'] = '';
		$atributos ['marco'] = true;
		$tab = 1;
		// ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
		
		// ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
		$atributos ['tipoEtiqueta'] = 'inicio';
		echo $this->miFormulario->formulario ( $atributos );
		
		// ---------------- SECCION: Controles del Formulario -----------------------------------------------
		
		$_REQUEST ['usuario'] = '6666';
		
		$rutaUrlBloque = $this->miConfigurador->getVariableConfiguracion ( "rutaUrlBloque" );
		
		//consultar el día actual: 0(para Domingo) hasta 6(para Sábado)
       	$fecha = date("D M j");
       	$hoy = getdate();
		$diaActual=$hoy['wday'];
		
		?>

<!-- Page Content -->
<div class="container">
	<hr>

	<div class="row">
		<div class="col-sm-6">
			<h1>Horario Clase</h1>
			<h4><?php echo $fecha; ?></h4>
		<?php 
			
		$esteCampo = 'horario';
		$atributos ['id'] = $esteCampo;
		$atributos ['estiloEnLinea'] = 'width: 100%; height: 90%; overflow-y: scroll;';
		echo $this->miFormulario->division ( "inicio", $atributos );
		unset ( $atributos );
		
				// Dias->consultar los días del horario
		$dias=array(1, 2, 3, 4, 5, 6, 7);
		
		// Contar dias
		$countdays = count($dias);
        
        ?> 
	  
	<!-- container -->
      <div class="container" id="contenido">

           <table id="mynew" class="table table-bordered" >
           
        <?php 
        
           echo'
			
			<thead>
			<th><i class="fa fa-clock-o"></i> Horario</th>
			';
			for ($i=0; $i < $countdays; $i++) { 
			 if ($dias[$i] == 1 and $diaActual==1) {
			 	echo '<th><i class="fa fa-angle-right" ></i> Lunes</th>';
			 }elseif ($dias[$i] == 2 and $diaActual==2){
			 	echo '<th><i class="fa fa-angle-right"></i> Martes</th>';
			 }elseif ($dias[$i] == 3 and $diaActual==3){
			 	echo '<th><i class="fa fa-angle-right"></i> Miercoles</th>';
			 }elseif ($dias[$i] == 4 and $diaActual==4){
			 	echo '<th><i class="fa fa-angle-right"></i> Jueves</th>';
			 }elseif ($dias[$i] == 5 and $diaActual==5){
			 	echo '<th><i class="fa fa-angle-right"></i> Viernes</th>';
			 }elseif ($dias[$i] == 6 and $diaActual==6){
			 	echo '<th><i class="fa fa-angle-right"></i> Sabado</th>';
			 }elseif ($dias[$i] == 7 and $diaActual==7){
			 	echo '<th><i class="fa fa-angle-right"></i> Domingo</th>';
			 }
			}
			echo '
			</thead>
			<tbody>';
			
			function resum($in,$fin,$minutos,$columnas){
			  $time = new DateTime($in);
			  $time->add(new DateInterval('PT' . $minutos . 'M'));
			  $stamp = $time->format('h:i a');
			  $format24 = $time ->format('G:i');
			
			  $uniq = str_replace(' ', '', str_replace(':', '', $stamp));
			  $reverse = strrev($uniq);
			
			
			  echo '<tr ><td class="td-time" >'.date('h:i a', strtotime($in)). ' - ' .$stamp.'</td>';
			
			  for ($i=1; $i <= $columnas; $i++) { 
			  	echo'
			         <td class="td-line" >
			           <div class="col-sm-12 nopadding">
			              <label class="label-desc" id="'.$reverse.$i.'"></label>
			           </div>
			           
			        </td>
			  	';
			  }
			
			  echo '</tr>';
			
			  sumtime($format24,$fin,$minutos,$columnas);
			}
			
			function sumtime($in,$fin,$minutos,$columnas){
			  $parse1 = new DateTime($in);
			
			  $parse2 = new DateTime($fin);   
			  if ($parse2 <= $parse1){
			    return;
			  }else{
			  $time = new DateTime($in);
			  $time->add(new DateInterval('PT' . $minutos . 'M'));
			  $stamp = $time->format('h:i a');
			  $format24 = $time ->format('G:i');
			
			  $uniq = str_replace(' ', '', str_replace(':', '', $stamp));
			  $reverse = strrev($uniq);
			
			
			  echo '<tr><td class="td-time">'.date('h:i a', strtotime($in)). ' - ' .$stamp.'</td>';
			
			  for ($i=1; $i <= $columnas; $i++) { 
			  	echo'
			         <td class="td-line">
			           <div class="col-sm-12 nopadding">
			              <label class="label-desc" id="'.$reverse.$i.'"></label>
			           </div>
			          
			        </td>
			  	';
			  }
			  echo'</tr>';
			
			  resum($format24,$fin,$minutos,$columnas);
			  }          
			
			}
			///////////////////////////////////////////////////////
			$hora= date('6:00');
			$hora2= date('18:00');
			$min=60;
			
			sumtime($hora,$hora2,$min,1);
			///////////////////////////////////////////////////////
			echo '</tbody>';
           ?>
           
           </table>

      </div>
    <!-- container -->
    
    
	    
        <?php
		
		
		echo $this->miFormulario->division ( "fin" );			
		?>
		
		</div>
		<div class="col-sm-6">
			<h1>Notificaciones</h1>
			<img src="<?php echo $rutaUrlBloque.'images/notificaciones.png'?>"
				alt="Perfil" class="img-responsive img-rounded" style="width: 100%;" />
		</div>
	</div>
	<!-- /.row -->

	<div class="row">
		<div class="col-sm-6">
			<h1>Servicios más usados</h1>
			<div class="row text-center">
				<div class="col-xs-4">
					<img src="<?php echo $rutaUrlBloque.'images/mi_plan_trabajo.png'?>"
						alt="Perfil" class="img-responsive" style="width: 100%;" />
					<h3 class="hidden-xs">Mi plan de Trabajo</h3>
					<h5 class="hidden-sm hidden-md hidden-lg">Mi plan de Trabajo</h5>
					<hr>
				</div>
				<div class="col-xs-4">
					<img src="<?php echo $rutaUrlBloque.'images/asignaturas.png'?>"
						alt="Perfil" class="img-responsive" style="width: 100%;" />
					<h3 class="hidden-xs">Asignaturas</h3>
					<h5 class="hidden-sm hidden-md hidden-lg">Asignaturas</h5>
					<hr>
				</div>
				<div class="col-xs-4">
					<img
						src="<?php echo $rutaUrlBloque.'images/resultados_evaluacion.png'?>"
						alt="Perfil" class="img-responsive" style="width: 100%;" />
					<h3 class="hidden-xs">Resultados Evaluación</h3>
					<h5 class="hidden-sm hidden-md hidden-lg">Resultados Evaluación</h5>
					<hr>
				</div>
			</div>
			<!-- /.row -->
			<div class="row text-center">
				<div class="col-xs-4">
					<img
						src="<?php echo $rutaUrlBloque.'images/produccion_academica.png'?>"
						alt="Perfil" class="img-responsive" style="width: 100%;" />
					<h3 class="hidden-xs">Producción Académica</h3>
					<h5 class="hidden-sm hidden-md hidden-lg">Producción Académica</h5>
					<hr>
				</div>
				<div class="col-xs-4">
					<img src="<?php echo $rutaUrlBloque.'images/autoevaluacion.png'?>"
						alt="Perfil" class="img-responsive" style="width: 100%;" />
					<h3 class="hidden-xs">Autoevaluación</h3>
					<h5 class="hidden-sm hidden-md hidden-lg">Autoevaluación</h5>
					<hr>
				</div>
				<div class="col-xs-4">
					<img src="<?php echo $rutaUrlBloque.'images/lista_clase.png'?>"
						alt="Perfil" class="img-responsive" style="width: 100%;" />
					<h3 class="hidden-xs">Lista de Clase</h3>
					<h5 class="hidden-sm hidden-md hidden-lg">Lista de Clase</h5>
					<hr>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<div class="col-sm-6">
			<h1>Noticias</h1>

			<!-- prueba-plugin noticias -->
	
	<?php
		
		//$atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "buscarNoticias", $usuario );
		//$matrizNoticias = $esteRecurso->ejecutarAcceso ( $atributos ['cadena_sql'], "busqueda" );
		
		$esteCampo = 'noticias';
		$atributos ['id'] = $esteCampo;
		$atributos ['estiloEnLinea'] = 'width: 100%; height: 90%; overflow-y: scroll;';
		echo $this->miFormulario->division ( "inicio", $atributos );
		unset ( $atributos );
		
		$esteCampo = "noti";
		$atributos ['id'] = $esteCampo;
		$atributos ['estilo'] = "demo2 demof";
		echo $this->miFormulario->division ( "inicio", $atributos );
		unset ( $atributos );
		
		echo "<ul>";
		
		// var_dump($matrizNoticias);
		/*
		if ($matrizNoticias) {
			
			foreach ( $matrizNoticias as $noticia ) {
				
				echo "<li>";
				
				$pordefecto = $rutaUrlBloque . "images/silueta.gif";
				
				$imagen = "<img id='foto-noti' ";
				
				if ($noticia ['img_usr_enlace']) {
					$imagen .= "src=" . $rutaUrlBloque . "images/" . trim ( $noticia ['img_usr_enlace'] ) . "";
				} else {
					$imagen .= "src=" . $pordefecto;
				}
				
				$imagen .= " alt='" . $noticia ['nombre_usr_remi'] . "' title='" . $noticia ['nombre_usr_remi'] . "'>";
				
				echo $imagen;
				
				$atributos ['id'] = 'enlacetitulo';
				$atributos ['enlace'] = "#";
				$atributos ['enlaceTitulo'] = "Prueba";
				$atributos ['enlaceTexto'] = $noticia ['nombre'];
				echo $this->miFormulario->enlace ( $atributos );
				
				echo "<p id='texto'>";
				
				$descrip = trim ( $noticia ['descripcion'] );
				
				if ($noticia ['enlace']) {
					$descrip = str_replace ( "[", "<a id='enlaceinterno' href='" . trim ( $noticia ['enlace'] ) . "'>", $descrip );
				} else {
					$descrip = str_replace ( "[", "<a id='enlaceinterno' href=''>", $descrip );
				}
				$descrip = str_replace ( "]", "</a>", $descrip );
				
				echo $descrip;
				
				echo "</p>";
				
				echo "<p id='fecha'>";
				
				$auxfecha = trim ( $noticia ['fercha_radicacion'] );
				
				$auxfecha = explode ( " ", $auxfecha );
				
				$auxfecha2 = $auxfecha [0];
				
				$auxfecha2 = explode ( "-", $auxfecha2 );
				
				$f ['anio'] = $auxfecha2 [0];
				$f ['mes'] = $auxfecha2 [1];
				$f ['dia'] = $auxfecha2 [2];
				$f ['hora'] = $auxfecha [1];
				
				echo fecha_es ( $f );
				
				echo "</p>";
				
				echo "</li>";
			}
		}
		*/
		echo "</ul>";
		
		echo $this->miFormulario->division ( "fin" );
		
		?>
		
	</div>
		<!-- col -->

	</div>
	<!-- fin prueba plugin -->

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container -->

<hr>

<?php
		// ------------------- SECCION: Paso de variables ------------------------------------------------
		
		/**
		 * En algunas ocasiones es útil pasar variables entre las diferentes páginas.
		 * SARA permite realizar esto a través de tres
		 * mecanismos:
		 * (a). Registrando las variables como variables de sesión. Estarán disponibles durante toda la sesión de usuario. Requiere acceso a
		 * la base de datos.
		 * (b). Incluirlas de manera codificada como campos de los formularios. Para ello se utiliza un campo especial denominado
		 * formsara, cuyo valor será una cadena codificada que contiene las variables.
		 * (c) a través de campos ocultos en los formularios. (deprecated)
		 */
		
		// En este formulario se utiliza el mecanismo (b) para pasar las siguientes variables:
		
		// Paso 1: crear el listado de variables
		
		$valorCodificado = "action=" . $esteBloque ["nombre"];
		$valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion ( 'pagina' );
		$valorCodificado .= "&usuario=" . $usuario;
		$valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
		$valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
		$valorCodificado .= "&opcion=ver";
		/**
		 * SARA permite que los nombres de los campos sean dinámicos.
		 * Para ello utiliza la hora en que es creado el formulario para
		 * codificar el nombre de cada campo.
		 */
		$valorCodificado .= "&campoSeguro=" . $_REQUEST ['tiempo'];
		// Paso 2: codificar la cadena resultante
		$valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar ( $valorCodificado );
		
		$atributos ["id"] = "formSaraData"; // No cambiar este nombre
		$atributos ["tipo"] = "hidden";
		$atributos ['estilo'] = '';
		$atributos ["obligatorio"] = false;
		$atributos ['marco'] = true;
		$atributos ["etiqueta"] = "";
		$atributos ["valor"] = $valorCodificado;
		echo $this->miFormulario->campoCuadroTexto ( $atributos );
		unset ( $atributos );
		
		// ----------------FIN SECCION: Paso de variables -------------------------------------------------
		
		// ---------------- FIN SECCION: Controles del Formulario -------------------------------------------
		
		// ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
		// Se debe declarar el mismo atributo de marco con que se inició el formulario.
		$atributos ['marco'] = true;
		$atributos ['tipoEtiqueta'] = 'fin';
		echo $this->miFormulario->formulario ( $atributos );
		
		return true;
	}
	function mensaje() {
		
		// Si existe algun tipo de error en el login aparece el siguiente mensaje
		$mensaje = $this->miConfigurador->getVariableConfiguracion ( 'mostrarMensaje' );
		$this->miConfigurador->setVariableConfiguracion ( 'mostrarMensaje', null );
		
		if ($mensaje) {
			
			$tipoMensaje = $this->miConfigurador->getVariableConfiguracion ( 'tipoMensaje' );
			
			if ($tipoMensaje == 'json') {
				
				$atributos ['mensaje'] = $mensaje;
				$atributos ['json'] = true;
			} else {
				$atributos ['mensaje'] = $this->lenguaje->getCadena ( $mensaje );
			}
			// -------------Control texto-----------------------
			$esteCampo = 'divMensaje';
			$atributos ['id'] = $esteCampo;
			$atributos ["tamanno"] = '';
			$atributos ["estilo"] = 'information';
			$atributos ["etiqueta"] = '';
			$atributos ["columnas"] = ''; // El control ocupa 47% del tamaño del formulario
			echo $this->miFormulario->campoMensaje ( $atributos );
			unset ( $atributos );
		}
		
		return true;
	}
}
$miFormulario = new Formulario ( $this->lenguaje, $this->miFormulario, $this->sql );
$miFormulario->formulario ();
$miFormulario->mensaje ();
function fecha_es($fecha) {
	$meses = array (
			'01' => 'Enero',
			'02' => 'Febrero',
			'03' => 'Marzo',
			'04' => 'Abril',
			'05' => 'Mayo',
			'06' => 'Junio',
			'07' => 'Julio',
			'08' => 'Agosto',
			'09' => 'Septiembre',
			'10' => 'Octubre',
			'11' => 'Noviembre',
			'12' => 'Diciembre' 
	);
	return $meses [$fecha ['mes']] . " " . $fecha ['dia'] . ", " . $fecha ['anio'] . " - " . $fecha ['hora'];
}
?>
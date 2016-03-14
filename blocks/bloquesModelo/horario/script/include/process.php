<?php

// Dias->consultar los días del horario
$dias=array(1, 2, 3, 4, 5, 6);

// Contar dias
$countdays = count($dias);

// Acomodar Dias
echo'
<thead>
<th><i class="fa fa-clock-o"></i> Horario</th>
';
for ($i=0; $i < $countdays; $i++) { 
 if ($dias[$i] == 1) {
 	echo '<th><i class="fa fa-angle-right"></i> Lunes</th>';
 }elseif ($dias[$i] == 2){
 	echo '<th><i class="fa fa-angle-right"></i> Martes</th>';
 }elseif ($dias[$i] == 3){
 	echo '<th><i class="fa fa-angle-right"></i> Miercoles</th>';
 }elseif ($dias[$i] == 4){
 	echo '<th><i class="fa fa-angle-right"></i> Jueves</th>';
 }elseif ($dias[$i] == 5){
 	echo '<th><i class="fa fa-angle-right"></i> Viernes</th>';
 }elseif ($dias[$i] == 6){
 	echo '<th><i class="fa fa-angle-right"></i> Sabado</th>';
 }elseif ($dias[$i] == 7){
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


  echo '<tr><td class="td-time">'.date('h:i a', strtotime($in)). ' - ' .$stamp.'</td>';

  for ($i=1; $i <= $columnas; $i++) { 
  	echo'
         <td class="td-line">
           <div class="col-sm-12 nopadding">
              <label class="label-desc" id="'.$reverse.$i.'"></label>
           </div>
           <div class="col-sm-12 text-center">
              <button id="edit-'.$reverse.$i.'" data-row="'.$reverse.$i.'" class="addinfo btn btn-xs btn-primary"><i class="fa fa-plus"></i></button>
              <button id="delete-'.$reverse.$i.'" data-row="'.$reverse.$i.'" class="delinfo btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
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

  for ($i=1; $i < $columnas; $i++) { 
  	echo'
         <td class="td-line">
           <div class="col-sm-12 nopadding">
              <label class="label-desc" id="'.$reverse.$i.'"></label>
           </div>
           <div class="col-sm-12 text-center">
              <button id="edit-'.$reverse.$i.'" data-row="'.$reverse.$i.'" class="addinfo btn btn-xs btn-primary"><i class="fa fa-plus"></i></button>
              <button id="delete-'.$reverse.$i.'" data-row="'.$reverse.$i.'" class="delinfo btn btn-xs btn-danger"><i class="fa fa-times"></i></button>         
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

sumtime($hora,$hora2,$min,$countdays);
///////////////////////////////////////////////////////
echo '</tbody>';

?>
<?
/**
* @Infocid version 2.0  feb-2005
* @Copyright (C) 2005 SPHERA5, C.A. <sphera5@gmail.com>
**
* @Obra basada en el Programa Infocid
* @Copyright (C) 2003 CIDTEL <cidtel@inictel.gob.pe>
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<?php
if ($detalle<>''){
 prin($detalle);}
function prin($detalle){

echo '<html>';
echo '<head>';
include('../includes/head.php');
include('../includes/menu.php'); 
echo '<div id=\"pagecell1\">'; 
echo '<!--pagecell1-->';

include("../Plantilla.rn");
        Logo();

 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select * from libro WHERE registro = '$detalle'";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

 $sql2="select * from vpresta where registro='$detalle' and devuelto='NO'";
 $exec2= pg_exec($coneccion,$sql2);
 $row=pg_numrows($exec2);
 if($row!=0){
 $res2=pg_fetch_object($exec2,0);
  $sql="select login from usuario where codusuario='$res2->codusuario'";
  $exe=pg_exec($coneccion,$sql);
  $usuario=pg_fetch_object($exe,0);
  $usefin=$usuario->login;
  $resul=$res2->codlector;
  $fecpre=$res2->fechorprest;
  $fec = explode ("-", $fecpre);
  $fec2=explode(" ",$fec[2]);
  $fecha= $fec2[0].'/'.$fec[1].'/'.$fec[0];
  $tot1="DETALLE DEL PRESTAMO";
// echo $fecha;
 $sql3 = "select * from alumno where codlector='$resul'";
 $exec3= pg_exec($coneccion,$sql3);
 $rows= pg_numrows($exec3);
 if ($rows!=0){
    $resu = pg_fetch_object($exec3,0);
    $result= $resu->apepat;
    $result1= $resu->apemat; 
    $result2= $resu->nombre;
    $carnet=$resu->numcarnet;
    $dep="alumno";
    $tot=$result.' '.$result1.', '.$result2; }
  else {
   $sql4 = "select * from interno where codlector='$resul'";
   $exec4= pg_exec($coneccion,$sql4);
   $rows4= pg_numrows($exec4);
   if ($rows4!=0){ 
    $resu = pg_fetch_object($exec4,0);
    $result= $resu->apepat;
    $result1= $resu->apemat;
    $result2= $resu->nombre;
    $carnet=$resu->numcarnet;
    $dep=$resu->dependencia;
    $tot=$result.' '.$result1.', '.$result2; }
   else {
    $sql4 = "select * from externo where codlector='$resul'";
    $exec4= pg_exec($coneccion,$sql4);
    $resu = pg_fetch_object($exec4,0);
    $result= $resu->apepat;
    $result1= $resu->apemat;
    $result2= $resu->nombre;
     $carnet=$resu->numcarnet;
    $dep="Lector externo";
    $tot=$result.' '.$result1.', '.$result2;
   }}
   }else { 
    $tot1="El Libro No está Prestado";
    $not="El Libro está disponible";
   }
// $res3=pg_fetch_object($exec2,0);
 echo "<table border=0 width=100%>";
echo "<tr><td align=right valign=middle>";
echo "<a href=\"javascript:history.back()\">Volver a la Lista</a><BR><BR>";
echo "</td></tr></table> ";

$resultado = pg_fetch_object($exec,$i);
$pie=$resultado->piedeimprenta;
$pieedito=$resultado->pieedito;
$pieano=$resultado->pieano;
$pieim=$pie.', '.$pieedito.': '.$pieano;

echo "<table BORDER='1' BORDERCOLOR='#0058B0' CELLPADDING=3 CELLSPACING=0 WIDTH='100%'>";
	echo "<tr>";
                echo "<td rowspan=8 width=30$><img src=imagen/".$detalle.'.jpg'." border=0 width=100 
height=150></td>";
        echo "</tr>";
        echo "<tr>";
              echo "<th width=16%>Registro</th>";
              echo "<td colspan=3>$resultado->registro</td></TR>";
        echo "</tr>";

	echo "<tr>";
                echo "<th>Código</th>";
                echo "<td colspan=3>$resultado->codigo</td>";
        echo "</tr>";

	echo "<tr>";
                echo "<th>Autor</th>";
                echo "<td colspan=3>$resultado->autor</td>";
       echo "</tr>";

        echo "<tr>";
                echo "<th>Título</th>";
                echo "<td colspan=3>$resultado->titulo</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Idioma</th>";
                echo "<td colspan=3>$resultado->idioma</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Nº Páginas</th>";
                echo "<td colspan=3>$resultado->numpag</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Pie de Imprenta</th>";
                echo "<td colspan=3>$pieim</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Prestado</th>";
                echo "<td colspan=4>$resultado->prestado</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Fecha/Ingreso</th>";
                echo "<td colspan=4>$resultado->fechaingreso</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Resúmen</th>";
                echo "<td colspan=4>$resultado->resumen</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Descriptores</th>";
                echo "<td colspan=4>$resultado->descriptor</td>";
        echo "</tr>";
	echo "<tr>";
                echo "<th><font face='Verdana' color=#FF1212>Prestado a</font></th>";
                echo "<td colspan=4><a  onclick= 'mensaje();'><font color=#FF1212>$not.$tot</font></a></td>";
        echo "</tr>";
 echo "</table>";
 echo "<BR><BR>";
 pie();
echo '<!--end content -->'; 
echo '</div></CENTER></BODY>';

?>

<SCRIPT LANGUAGE=JavaScript>
function mensaje(){
 var pre='       '+'<? echo $tot1; ?> '+'\n'+'\n';
 pre+='Carnet             :' + '<? echo $carnet; ?>'+'\n';
 pre+='Lector                   : '+ '<? echo $tot; ?>'+'\n';
 pre+='Fecha de Prestamo: '+'<? echo $fecha; ?>'+'\n';
 pre+='Division            : '+'<? echo $dep; ?>'+'\n';
 pre+='Prestado por          : '+'<? echo $usefin; ?>'+'\n';
 alert(pre);
} </SCRIPT>
<? 
echo '</html>';
} ?>


<?
/**
* @Infocid version 2.0  feb-2005
* @Copyright (C) 2005 SPHERA5, C.A. <sphera5@gmail.com>
* *
* @Obra basada en el Programa Infocid
* @Copyright (C) 2003 CIDTEL <cidtel@inictel.gob.pe>
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* *
* @Powered by Autentificator
* @PHP-Script  de Gestión de Usuarios basado en sesiones
* @by Pedro Noves V. (Cluster) <clus@hotpop.com>
*/
?>
<?php require ("../usuarios/aut_verifica.inc.php");
$nivel_acceso=0; 
if ($nivel_acceso < $_SESSION['usuario_nivel']){
	header ("Location: $redir?error_login=5");
exit;
}?>
<!--		Fin Autentificacion	-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML><HEAD>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>


<?php
$an=getDate();
$a=$an["year"];
$a=$a - 1;


echo "<P ALIGN=CENTER><FONT FACE='Nimbus Sans L' SIZE=5 STYLE='font-size: 20pt'><B>RESULTADO DE LISTA DE LIBROS INVENTARIADOS 
$a</B></FONT></P>";
echo "<P ALIGN=CENTER><BR><BR></P>";


$sql1="select * from libroinv1 order by registro asc";
$sql2="select * from libroinv1 order by registro asc limit 12 offset $val";
//$coneccion = pg_connect("","","","","Inventario");
include('../includes/connection.php');
$exec =pg_exec($coneccion,$sql1);
$exec2=pg_exec($coneccion,$sql2);
$rows = pg_numrows($exec);
$rows2 = pg_numrows($exec2);

$pag=ceil($rows/12);

if ($rows >0) {
        echo "<A HREF=Inventario2.php>Volver al Resumen del Estado del Inventario</A><BR><BR>";
	echo "<A HREF=listainventario1.php>Versión para Imprimir</A><BR><BR>";
	echo "Se encontró ".$rows." libro(s) Inventariados";
        echo "<BR>";
        echo "<BR>";
        echo "<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>";
        echo "<TR VALIGN=RIGHT>";
                echo "<TH COLSPAN=11>DATOS DEL LIBRO</TH>";
        echo "</TR>";

        echo "<TR VALIGN=CENTER>";
                echo "<TH WIDTH=10%>Registro </TH>";
                echo "<TH>Código</TH>";
                echo "<TH>Autor</TH>";
                echo "<TH>Título</TH>";
                echo "<TH>BC</TH>";
                echo "<TH>Ingreso</TH>";
                echo "<TH>Fecha Ingreso</TH>";
                echo "<TH>Pie Imprenta</TH>";
                echo "<TH>Precio</TH>";
                echo "<TH>Prestado</TH>";
		echo "<TH>Operador</TH>";
		echo "<TH>Logística</TH>"; 
		echo "<TH>Fecha-Hora</TH>";
        echo "</TR>";

        for($i=0;$i<$rows2;$i++){
                $res = pg_fetch_object($exec2,$i);
		$registro=$res->registro;

                echo "<TR>";
                echo "<TD ALIGN=CENTER>$res->registro</TD>";
                echo "<TD ALIGN=CENTER>$res->codigo</TD>";
                echo "<TD ALIGN=LEFT>$res->autor</TD>";
                echo "<TD ALIGN=LEFT>$res->titulo</TD>";
                echo "<TD ALIGN=CENTER>$res->numbc</TD>";
                echo "<TD ALIGN=CENTER>$res->numingreso</TD>";
                echo "<TD ALIGN=LEFT>$res->fechaingreso</TD>";
                echo "<TD ALIGN=LEFT>$res->piedeimprenta</TD>";
                echo "<TD ALIGN=CENTER>$res->precio</TD>";
                echo "<TD ALIGN=CENTER>$res->prestado</TD>";
		echo "<TD ALIGN=CENTER>$res->operador</TD>";
		echo "<TD ALIGN=LEFT>$res->dilog</TD>"; 
		echo "<TD ALIGN=LEFT>$res->fechoringreso</TD>";
                echo "</TR>";

                }; //for

       echo "</TABLE>";
        echo "<BR>";
//        echo "Se encontró ".$rows." libro(s) de Inventariados";
 

/*}  else {
        echo "No se encontró ningún libro con esas especificaciones";
} */

$salt=$val+12;
$ret=$val-12;
$ult=($pag-1)*12;
 echo "<table  BORDER=0 BORDERCOLOR='#0058B0'  CELLPADDING=3 CELLSPACING=0 align=center>";
 echo "<TR>";
// Para los link Inicio y Anterior
 if ($val<>0){
$q=$n-1;
 echo "<td align=left><a href=listainventariobk.php?val=0><< Inicio </a><font color=#0000FF>|</font></td>";
 echo "<td align=left><a href=listainventariobk.php?val=$ret&n=$q><  Anterior </a><font 
color=#0000FF>|</font></td>";
 }

// Genera los numeros con los links las otras paginas
if ($pag>12){
$lim=$n+10;
 for ($i=$n;$i<$lim;$i++){
          $j=$i+1;
          $p=$i*12;
          $n=$i;

          echo " <td><a href=listainventariobk.php?val=$p&n=$n>$j</a></td>";
          if($j==$pag){
           exit;
         }
          if($j==$lim){
          } else {
          echo " <td><font color=#0000FF>|</font></td>"; }
          }

} else{
//$lim=$pag;
   for ($i=0;$i<$pag;$i++){
          $j=$i+1;
          $p=$i*12;
          echo " <td><a href=listainventariobk.php?val=$p>$j</a></td>";
          if($j==$pag){
          } else {
          echo " <td><font color=#0000FF>|</font></td>"; }
          }
}

// Para crear links a Siguiente y Ultimo
if($val<>$ult){
$g=$pag-9;
echo " <td align=right><font color=#0000FF>| </font><a href=listainventariobk.php?val=$salt&n=$n>Siguiente ></a></td>";
echo " <td align=left><font color=#0000FF>| </font><a href=listainventariobk.php?val=$ult&n=$g>Ultimo >></a></td>";
}
echo "</tr>";
echo " </table>";
} 

/* else {
        echo "No se encontró ningún libro con esas especificaciones";
}*/

 ?>
</FORM>
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

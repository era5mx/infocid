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
<P ALIGN=CENTER><FONT FACE="Nimbus Sans L" SIZE=5 STYLE="font-size: 20pt"><B>LISTA DE LIBROS PENDIENTES DE  INVENTARIO </B></FONT></P>
<P ALIGN=CENTER><BR><BR></P>


<?php

$sql="select registro from libroinv1";
//$coneccion1 = pg_connect("","","","","Inventario");
include('../includes/connection1.php');
$exec =pg_exec($coneccion1,$sql);
$rows = pg_numrows($exec);

if ($rows > 0) {

$sentencia=" not IN ('";

for ($i=0;$i<$rows;$i++){
	$res=pg_fetch_object($exec,$i);
	$registro=$res->registro;
	if ($rows-$i == 1) {
		$sentencia=$sentencia.$registro."' ";
	} else {
		$sentencia=$sentencia.$registro."','";
	}
};
$sentencia=$sentencia.")";
}

//echo $sentencia;

$sql1="select registro,codigo,autor,titulo,numbc,numingreso,fechaingreso,piedeimprenta,precio,prestado,obs,baja
	from libro where registro".$sentencia." order by registro asc";

//from libro where registro".$sentencia." and baja='NO' and obs='-'  order by registro asc";
//from libro where registro".$sentencia." and baja='NO' and obs like '-%' order by registro asc";


//$coneccion = pg_connect("","","","","Biblio");
include('../includes/connection.php');
$exec =pg_exec($coneccion,$sql1);
$rows = pg_numrows($exec);



if ($rows >0) {
	echo "<A HREF=Inventario2.php>Volver al Resumen del Estado del Inventario</A><BR><BR>";
        echo "Se encontró ".$rows." libro(s) con esa(s) especificacion(es)";
        echo "<BR>";
        echo "<BR>";
        echo "<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>";
        echo "<TR VALIGN=RIGHT>";
                echo "<TH COLSPAN=9>DATOS DEL LIBRO</TH>";
        echo "</TR>";

        echo "<TR VALIGN=CENTER>";
		echo "<TH>Nº</TH>";
                echo "<TH>Registro </TH>";
                echo "<TH>Código</TH>";
                echo "<TH WIDTH=30%>Autor</TH>";
                echo "<TH WIDTH=40%>Título</TH>";
		echo "<TH>Pie Imprenta</TH>";
                echo "<TH>BC</TH>";
                echo "<TH>Ingreso</TH>";
                echo "<TH>Fecha Ingreso</TH>";
                echo "<TH>Baja</TH>";
                echo "<TH>Observación</TH>";
        echo "</TR>";
	
	$n=1;
        for($i=0;$i<$rows;$i++){
                $res = pg_fetch_object($exec,$i);
		
                echo "<TR>";
		echo "<TD ALIGN=CENTER>".$n."</TD>";
                echo "<TD ALIGN=CENTER>$res->registro</TD>";
                echo "<TD ALIGN=CENTER>$res->codigo</TD>";
                echo "<TD ALIGN=LEFT>$res->autor</TD>";
                echo "<TD ALIGN=LEFT>$res->titulo</TD>";
		echo "<TD ALIGN=LEFT>$res->piedeimprenta</TD>";
                echo "<TD ALIGN=CENTER>".trim($res->numbc)."</TD>";
                echo "<TD ALIGN=CENTER>".trim($res->numingreso)."</TD>";
                echo "<TD ALIGN=LEFT>$res->fechaingreso</TD>";
                echo "<TD ALIGN=LEFT>$res->baja</TD>";
                echo "<TD ALIGN=LEFT>$res->obs</TD>";
                echo "</TR>";
	$n=$n+1;
                };

        echo "</TABLE>";
        echo "<BR>";
        echo "Se encontró ".$rows." libro(s) con esa(s) especificacion(es)";
} else {
        echo "No se encontró ningún libro con esas especificaciones";
}
?>


</FORM>
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>
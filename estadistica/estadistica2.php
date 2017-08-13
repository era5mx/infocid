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
<BR>
<table WIDTH=100% BORDER=0 BORDERCOLOR="#000000">
	<TR>
	    <TH><FONT size=5>Resultado de Estadística de Consultas</FONT></TH>
	</TR>
</table>
<BR>
<?php

if ($ano=='' and $mes=='' and $dia==''){
	echo "No ingresó datos suficientes para completar la operación";
	echo "Haga click <A HREF=\"javascript:history.back()\">Atrás</A> e intentelo de nuevo";
} else {
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 
 $mensaje1="Se ha(n) realizado <B>";
 $mensaje2="</B> consulta(s) el ";

 if ($ano=='' and $mes==''){ //solo se ingreso el dia
	$sql = "select *  from estadistica where fecha like '%-$dia %' order by fecha desc";
	$p=$dia;
	$mensaje3="día <B>".$p."</B><BR><BR>";
 }

 if ($ano=='' and $dia==''){ //solo se ingreso el mes
        $sql = "select *  from estadistica where fecha like '%-$mes-%' order by fecha desc";
	$mes=$mes+1;
        $p=date( "F",mktime(0,0,0,$mes,0,0));
	$mensaje3="mes de <B>".$p."</B><BR><BR>";
 }

 if ($mes=='' and $dia==''){ //solo se ingreso el año
        $sql = "select *  from estadistica where fecha like '$ano-%' order by fecha desc";
        $p=$ano;
	$mensaje3="año <B>".$p."</B><BR><BR>";
 }

 if ($mes<>'' and $dia<>'' and $ano==''){ //se ingreso mes y dia
        $sql = "select *  from estadistica where fecha like '%-$mes-$dia %' order by fecha desc";
	$mes=$mes+1;
        $p=date( "F",mktime(0,0,0,$mes,0,0));
        $mensaje3="día <B>".$dia."</B> del mes de <B>".$p."</B><BR><BR>";
 }

 if ($ano<>'' and $dia<>'' and $mes==''){ //se ingreso año y dia
        $sql = "select *  from estadistica where fecha like '$ano-%-$dia %' order by fecha desc";
        $mensaje3="día <B>".$dia."</B> del año <B>".$ano."</B><BR><BR>";
 }

 if ($ano<>'' and $mes<>'' and $dia==''){ //se ingreso año y mes
        $sql = "select *  from estadistica where fecha like '$ano-$mes-%' order by fecha desc";
	$mes=$mes+1;
        $p=date( "F",mktime(0,0,0,$mes,0,0));
        $mensaje3="mes de  <B>".$p."</B> del año <B>".$ano."</B><BR><BR>";
 }

 if ($ano<>'' and $mes<>'' and $dia<>''){ //se ingreso año,mes y dia
	$fecha= $ano.'-'.$mes.'-'.$dia;
	$sql = "select *  from estadistica where fecha like '$fecha%' order by fecha desc";
	$p=date( "l, d F Y",mktime(0,0,0,$mes,$dia,$ano));
	$mensaje3="día <B>".$p."</B><BR><BR>";
 }

 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);
 $mensaje=$mensaje1.$registro.$mensaje2.$mensaje3;

echo "Si el resultado de su consulta no es satisfactoria, haga click <a href=\"javascript:history.back()\">Atrás
                                        </a> e intente nuevamente<BR>";

 echo $mensaje;

if ($registro > 0){
	echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000000'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Número</th>";
	echo "<th>Item</th>";
	echo "<th>Encontrado</th>";
	echo "<th>Fecha</th>";
	echo "</thead>";

	for($i=0;$i<$registro;$i++){
		$resultado = pg_fetch_object($exec,$i);
		echo "<tbody>";
		echo "<tr>";
		echo "<td ALIGN=CENTER>$resultado->numero</td>";
		echo "<td ALIGN=CENTER>$resultado->item</td>";
		echo "<td ALIGN=CENTER>$resultado->encont</td>";
		echo "<td ALIGN=CENTER>$resultado->fecha</td>";
		echo "</tr>";
		echo "<tbody>";
	};
	echo "</table><BR>";
	echo $mensaje;
}
}

pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>
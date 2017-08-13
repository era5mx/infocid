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
<html><HEAD>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>
<BR>

<h1> Resultado </h1>


<?php
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 if ($reg == ''){
 	echo '<SCRIPT LANGUAJE="JavaScript">alert("NO SE PUEDE COMPLETAR LA OPERACION SIN EL NUMERO DE REGISTRO DEL VIDEO")</SCRIPT>';
        echo '<SCRIPT LANGUAJE="JavaScript">history.go(-1); return</SCRIPT>';
        exit;
 } else {
 	$sql = "update video set titulo= upper('$tit'), autor= upper('$aut'), fecha= upper('$fec'),
	mesa= upper('$mesa'), debate= upper('$deb'), entrevista= upper('$ent'), curso1= upper('$cur1'), curso2= upper('$cur2'),
	magazine= upper('$mag'), documental= upper('$doc'), duracion= upper('$dur'), resumen= upper('$res'), obs= upper('$obs'),
	prestado= upper('$prest'), operador= upper('$PHP_AUTH_USER')  WHERE registro = upper('$reg')";

	$exec = pg_exec($coneccion,$sql);
	$registro = pg_numrows($exec);
	echo "Usted ha editado exitosamente el registro:<br>";
	echo "<B>".strtoupper($reg)."</B>";
	echo "<table border=0>";
	echo "<form action='editarvideo.php'>";
	echo "<tr><td>¿Desea editar otro registro?<INPUT TYPE=SUBMIT VALUE='SI'></td></form>";
	echo "<td><form action='administracion.php'><INPUT TYPE=SUBMIT VALUE='NO'></td></tr>";
	echo "</form></table>";

 }
?>
<br><br><br>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

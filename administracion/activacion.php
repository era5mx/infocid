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

<h1> </h1>
<?php
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 if ($reg == '' or $activo == ''){
  	echo '<SCRIPT LANGUAJE="JavaScript">alert("NO SE PUEDE REALIZAR LA OPERACION, DEBE SELECCIONAR LA OPERACION A REALIZAR")</SCRIPT>';
        echo '<SCRIPT LANGUAJE="JavaScript">history.go(-1); return</SCRIPT>';
        exit;
 }else{
 	$sql = " update video set activo='$activo' WHERE registro = upper('$reg')";
	 $exec = pg_exec($coneccion,$sql);

	if ($activo == 'NO'){
	        echo "Usted ha dado de baja el registro:<br>";
	        echo "<B>".$reg."</B>";
	 }else{
                echo "Usted ha dado de alta el registro:<br>";
                echo "<B>".$reg."</B>";
	}
	echo "<table border=0>";
        echo "<form action='borrarvideo.php' >";
	echo "<tr><td>¿Desea activar/retirar otro registro?<INPUT TYPE=SUBMIT VALUE='SI'></td></form>";
	echo "<td><form action='administracion.php'><INPUT TYPE=SUBMIT VALUE='NO'></td></tr>";
	echo "</form></table>";
 }
?>
</FORM>
<br><br><br>
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
<P><BR><BR>
</P>
</BODY>
</HTML>


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
* @PHP-Script  de Gesti�n de Usuarios basado en sesiones
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

<h1> Estudiante Desactivado </h1>
<?php
 $char = strlen($cod);
 $charOpc = strlen($activo);
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 if ($char == 0 or $charOpc == 0){
 echo "No se puede realizar esta operaci�n<br>";
 echo "No se ha ingresado un c�digo v�lido para resolver la operaci�n � No selecion� la operaci�n a realizar";
 }else{
 	$sql = " update alumno set activo='$activo' WHERE numcarnet = upper('$cod')";
	 $exec = pg_exec($coneccion,$sql);

	if ($activo == 'NO'){
	        echo "Usted ha dado de baja al estudiante con c�digo:<br>";
	        echo $cod;
	 }else{
                echo "Usted ha dado de alta al estudiante con c�digo:<br>";
                echo $cod;
	}
 echo "<table border=0>";
 echo "<form action='borraralumno.php'>";
 echo "<tr><td>�Desea activar/retirar otro estudiante?<INPUT TYPE=SUBMIT VALUE='SI'></td></form>";
 echo "<td><form action='administracion.php'><INPUT TYPE=SUBMIT VALUE='NO'></td></tr>";
 echo "</form></table>";
 }
?>
</FORM>
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

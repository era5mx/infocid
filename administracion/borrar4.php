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
<h1> Resultado </h1>
<?php
 $char = strlen($dni);
 $charOpc = strlen($activo);
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 if ($char == 0 or $charOpc == 0){
 echo "No se puede realizar esta operación<br>";
 echo "No se ha ingresado un DNI válido para resolver la operación o no seleccionó la operación a 
realizar";
 }else{
        if ($activo == 'NO'){
                $sql = " update externo set activo='$activo' WHERE dni = '$dni'";
                $exec = pg_exec($coneccion,$sql);
                echo "Usted ha dado de baja al usuario externo con DNI:<br>";
                echo "<b>".$dni."</b>";
         }else{
                $sql = " update externo set activo='$activo' WHERE dni = '$dni'";
                $exec = pg_exec($coneccion,$sql);
                echo "Usted ha dado de alta al usuario externo con DNI:<br>";
                echo "<b>".$dni."</b>";
        }

	echo "<table border=0>";
	echo "<form action='borrarexterno.php'>";
	echo "<tr><td>¿Desea activar/retirar otro usuario externo?<INPUT TYPE=SUBMIT VALUE='SI'></td></form>";
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


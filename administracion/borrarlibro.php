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
<h1> Resultado </h1>
<FORM ACTION="borrar2.php" METHOD="POST">
<?php
//$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select *  from libro where registro = upper('$reg')";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);
if ($registro == 0){
	echo "<br>No se ha encontrado libro con ese código.<br>";
	echo "Por favor haga click <a href=\"javascript:history.back()\">Atrás</a> y vuelva a intentarlo<br>";
} else {
	$resultado = pg_fetch_object($exec,$i);
	echo "<INPUT TYPE='hidden' NAME='cod' VALUE =$reg>";
	echo "<table WIDTH=100% BORDER=1 BORDERCOLOR='#000000'>";
	echo "<thead>";
	echo "<tr>";
		echo "<th>Registro</th>";
		echo "<th>Código</th>";
		echo "<th>Autor</th>";
		echo "<th>Título</th>";
	echo "</tr>";
	echo "</thead>";

	echo "<tbody>";
	echo "<tr>";
		echo "<td>".strtoupper($reg)."</td>";
		echo "<td>$resultado->codigo</td>";
		echo "<td>$resultado->autor</td>";
		echo "<td>$resultado->titulo</td>";
	echo "</tr>";
	echo "<tr>";

	$baja=$resultado->baja;

	if ($baja=='SI'){
		echo "<td colspan=4>Activo<INPUT TYPE=Radio NAME='activo' VALUE='NO'> 
				Retirado<INPUT TYPE=Radio NAME='activo' VALUE='SI' CHECKED>
		<INPUT TYPE=SUBMIT NAME='borrar' VALUE='Actualizar'></td>";
	} else {
		echo "<td colspan=4>Activo<INPUT TYPE=Radio NAME='activo' VALUE='NO' CHECKED>
                                Retirado<INPUT TYPE=Radio NAME='activo' VALUE='SI'>
                <INPUT TYPE=SUBMIT NAME='borrar' VALUE='Actualizar'></td>";
	};

	echo "</tr>";
	echo "</tbody>";
	echo "</table>";
}
?>
</FORM>
<br><br>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>


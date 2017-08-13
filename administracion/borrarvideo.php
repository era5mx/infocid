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
//$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select titulo, autor, fecha, resumen, activo from video where registro = upper('$reg')";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

if ($registro ==0){
 	echo '<SCRIPT LANGUAJE="JavaScript">alert("NO SE HA ENCONTRADO NINGÚN VIDEO CON ESE NÚMERO DE REGISTRO")</SCRIPT>';
        echo '<SCRIPT LANGUAJE="JavaScript">history.go(-1); return</SCRIPT>';
        exit;
} else {
$resultado = pg_fetch_object($exec,0);

echo "<FORM ACTION='activacion.php' METHOD='POST'>";
echo "<INPUT TYPE=hidden NAME='reg' VALUE =$reg>";
echo "<table BORDER=1 BORDERCOLOR='#000000' WIDTH='100%'>";
echo "<thead>";
echo "<tr>";
echo "<th>Registro</th>";
echo "<th>Título</th>";
echo "<th>Autor</th>";
echo "<th>Fecha de Emisión</th>";
echo "<th>Resumen</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
echo "<tr>";
echo "<td>".strtoupper($reg)."</td>";
echo "<td>$resultado->titulo</td>";
echo "<td>$resultado->autor</td>";
echo "<td>$resultado->fecha</td>";
echo "<td>$resultado->resumen</td>";
echo "</tr>";
echo "<tr>";

$activo=$resultado->activo;

	if ($activo=='SI'){
		echo "<td colspan=5>Activo<INPUT TYPE=Radio NAME='activo' VALUE='SI' CHECKED>
				Retirado<INPUT TYPE=Radio NAME='activo' VALUE='NO'>
		<INPUT TYPE=SUBMIT NAME='borrar' VALUE='Actualizar'></td>";
	} else {
		echo "<td colspan=5>Activo<INPUT TYPE=Radio NAME='activo'VALUE='SI'>
                                Retirado<INPUT TYPE=Radio NAME='activo' VALUE='NO' CHECKED>
                <INPUT TYPE=SUBMIT NAME='borrar' VALUE='Actualizar'></td>";
	};
echo "</tr>";
echo "<tbody>";
echo "</table>";
}
?>
</FORM>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>


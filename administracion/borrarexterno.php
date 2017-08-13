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
<FORM ACTION="borrar4.php" METHOD="POST">
<?php
//$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select *  from externo where dni = '$dni'";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

if ($registro == 0){
echo "<br>No se ha encontrado usuario externo con ese DNI.<br>";
echo "Por favor <a href='javascript:history.back()'>regrese</a> e intentelo otra vez<br>";
} else {
$resultado = pg_fetch_object($exec,0);
echo "<INPUT TYPE=hidden NAME='dni' VALUE =$dni>";
echo "<table BORDER=1 BORDERCOLOR='#000000'>";
echo "<thead>";
echo "<tr>";
echo "<th>Num DNI</th>";
echo "<th>Nombre</th>";
echo "<th>Apellido Paterno</th>";
echo "<th>Apellido Materno</th>";
echo "<th>Dirección</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
echo "<tr>";
echo "<td>$dni</td>";
echo "<td>$resultado->nombre</td>";
echo "<td>$resultado->apepat</td>";
echo "<td>$resultado->apemat</td>";
echo "<td>$resultado->direccion</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan = 5>Activar<INPUT TYPE=Radio NAME='activo' VALUE='SI'> Desactivar<INPUT TYPE=Radio NAME='activo' VALUE='NO'>
        <INPUT TYPE=SUBMIT NAME='borrar' VALUE='Actualizar'></td>";
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


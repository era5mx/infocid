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

<h1> Resultado </h1>
<?php
//$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select *  from externo where dni = trim('$dni')";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

if ($registro == 0){
echo "<br>No se ha encontrado usuario externo con ese código.<br>";
echo "Por favor <a href='javascript:history.back()'>regrese</a> e intentelo otra vez<br>";
} else {
$resultado = pg_fetch_object($exec,0);

echo "<FORM ACTION='editar4.php' METHOD='POST'>";
echo "<INPUT TYPE=hidden NAME='dni' VALUE =$dni>";
echo "<table BORDER=1 BORDERCOLOR='#000000'>";
echo "<tr>";
echo "<td>NÚMERO DE DNI</td>";
echo "<td>$dni</td>";
echo "</tr>";
echo "<tr>";
echo "<td>NOMBRE</td>";
echo "<td><INPUT TYPE=TEXT NAME='nom' VALUE = '$resultado->nombre'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>APELLIDO PATERNO</td>";
echo "<td><INPUT TYPE=TEXT NAME='app' VALUE = '$resultado->apepat'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>APELLIDO MATERNO</td>";
echo "<td><INPUT TYPE=TEXT NAME='apm' VALUE = '$resultado->apemat'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>DIRECCIÓN</td>";
echo "<td><INPUT TYPE=TEXT NAME='dir' VALUE = '$resultado->direccion'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>TELÉFONO</td>";
echo "<td><INPUT TYPE=TEXT NAME='tel' VALUE = '$resultado->telefono'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>SEXO</td>";
echo "<td><INPUT TYPE=TEXT NAME='sex' VALUE = '$resultado->sexo'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>PROCEDENCIA</td>";
echo "<td><INPUT TYPE=TEXT NAME='pro' VALUE = '$resultado->procedencia'></td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan = 2><INPUT TYPE=SUBMIT NAME='Grabar' VALUE='Grabar'></td>";
echo "</tr>";
echo "</table>";
echo "</FORM>";
}

pie();
?>
 <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>


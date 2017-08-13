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
<FORM ACTION="editar3.php" METHOD="POST">
<table BORDER=1 BORDERCOLOR="#000000">
<?php
//$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select *  from interno where numcarnet = upper('$cod')";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);
 $cont=0;
for($i=0;$i<$registro;$i++)
{
$resultado = pg_fetch_object($exec,$i);
$cont=$cont + 1;
echo "<INPUT TYPE=hidden NAME='cod' VALUE ='$cod'>";
echo "<tr>";
echo "<td>Num. Carné</td>";
echo "<td>$cod</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Nombre</td>";
echo "<td><INPUT TYPE=TEXT NAME='nom' VALUE = '$resultado->nombre'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Apellido Paterno</td>";
echo "<td><INPUT TYPE=TEXT NAME='app' VALUE = '$resultado->apepat'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Apellido Materno</td>";
echo "<td><INPUT TYPE=TEXT NAME='apm' VALUE = '$resultado->apemat'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Dependencia</td>";
echo "<td><INPUT TYPE=TEXT NAME='dep' VALUE = '$resultado->dependencia'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Anexo</td>";
echo "<td><INPUT TYPE=TEXT NAME='ane' VALUE = '$resultado->anexo'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Sexo</td>";
echo "<td><INPUT TYPE=TEXT NAME='sex' VALUE = '$resultado->sexo'></td>";
echo "</tr>";

};
echo "</table>";
if ($registro == 0){
echo "<br>No se ha encontrado el código.<br>";
echo "Por favor <a href='javascript:history.back()'>regrese</a> e intentelo otra vez<br>";
echo "</table>";
exit;
}
?>
<INPUT TYPE=SUBMIT NAME='Grabar' VALUE='Grabar'>
</FORM>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

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
<?php
echo "<FORM NAME='libro' ACTION='Prestamo.php' METHOD=post>";
echo "<TABLE WIDTH=100% BORDER=0>";
echo "<TR VALIGN=RIGHT>";
echo "<TH COLSPAN=3>El lector tiene actualmente $nlibros libro(s) prestado(s)</TH>";
echo "</TR>";
echo "<TR VALIGN=RIGHT>";
echo "<TH COLSPAN=3>PRÉSTAMOS</TH>";
echo "</TR>";
echo "<TR VALIGN=CENTER>";
echo "<TH COLSPAN=3><INPUT TYPE=HIDDEN NAME='nreg' SIZE=8 VALUE='$nreg'></TH>";
echo "</TR>";
echo "<TR VALIGN=CENTER>";
echo "<TH ALIGN=RIGHT WIDTH=30%>Código: </TH>";
echo "<TH ALIGN=LEFT COLSPAN=2>".strtoupper($numcn)."<INPUT TYPE=HIDDEN NAME='numcn' SIZE=8 value='$numcn'></TH>";
echo "</TR>";
echo "<TR VALIGN=LEFT>";
echo "<TH ALIGN=RIGHT WIDTH=20%>Nombres y Apellidos: </TH>";
echo "<TD COLSPAN=2>$nombre, $apepat $apemat<INPUT TYPE=HIDDEN NAME='nomape' SIZE=8 value='$nombre, $apepat $apemat'></TD>";
echo "</TR>";
echo "<TR VALIGN=LEFT>";
echo "<TH ALIGN=RIGHT>Dirección ó Dependencia: </TH>";
echo "<TD COLSPAN=2>$depdir<INPUT TYPE=HIDDEN NAME='depdir' SIZE=8 value='$depdir'></TD>";
echo "</TR>";
echo "<TR VALIGN=LEFT>";
echo "<TH ALIGN=RIGHT>Teléfono ó Anexo: </TH>";
echo "<TD COLSPAN=2>$telanexo<INPUT TYPE=HIDDEN NAME='telanexo' SIZE=8 value='$telanexo'></TD>";
echo "</TR>";
echo "<TR VALIGN=LEFT>";
echo "<TH ALIGN=RIGHT>Sexo: </TH>";
echo "<TD COLSPAN=2>$sexo<INPUT TYPE=HIDDEN NAME='sexo' SIZE=8 value='$sexo'></TD>";
echo "</TR>";
echo "<TR VALIGN=CENTER>";
echo "<TH COLSPAN=3>DATOS DEL LIBRO</TH>";
echo "</TR>";
echo "<TR VALIGN=TOP>";
echo "<TH ALIGN=RIGHT>Número BD:</TH>";
echo "<TD ALIGN=CENTER><INPUT TYPE=TEXT NAME='numbd' SIZE=8></TD>";
echo "<TD ALIGN=LEFT><INPUT TYPE=SUBMIT NAME='verlib' VALUE='Visualizar'></TD>";
echo "</TR>";
echo "</TABLE>";
echo "</FORM>";
include ("funciones.php");
 prestamos($codlector);
 pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

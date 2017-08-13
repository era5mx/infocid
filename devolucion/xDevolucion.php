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
<script>
function sf(){
   document.dev.numbd.focus();}
</script>
<?php $pag_origen="administracion/xlibro.php";	?>
<!--		Inicio Autentificacion	-->
<?php require ("../usuarios/aut_verifica.inc.php");
$nivel_acceso=0; 
if ($nivel_acceso < $_SESSION['usuario_nivel']){
	header ("Location: $redir?error_login=5");
exit;
}?>
<!--		Fin Autentificacion	-->
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>

<FORM NAME="dev" ACTION="Devolucion.php" METHOD="POST">
<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>
<COL WIDTH=85*>
<COL WIDTH=85*>
<COL WIDTH=85*>
 
        <TR VALIGN=TOP>
                <TD><BR></TD>
                <TD><BR></TD>
                <TD><BR></TD>
        </TR>
 
        <TR VALIGN=TOP>
                <TD><BR></TD>
                <TD><BR></TD>
                <TD><BR></TD>
        </TR>
 
        <TR VALIGN=TOP>
                <TD><BR></TD>
                <TD><BR></TD>
                <TD><BR></TD>
        </TR>
 
        <TR VALIGN=TOP>
                <TD><BR></TD>
                <TD><BR></TD>
                <TD><BR></TD>
        </TR>

        <TR VALIGN=TOP>
                <TD WIDTH=40%></TD>
                <TD ALIGN=CENTER><B>DEVOLUCIONES</B></TD>
                <TD WIDTH=40%></TD>
        </TR>
        <TR VALIGN=TOP>
                <TD><BR></TD>
                <TD><BR></TD>
                <TD><BR></TD>
        </TR>
        <TR VALIGN=TOP>
                <TH><P ALIGN=RIGHT>N&uacute;mero BD:</P></TH>
                <TD><P ALIGN=CENTER><INPUT TYPE=TEXT NAME="numbd" SIZE=13></P></TD>
                <TD><P ALIGN=LEFT><INPUT TYPE=SUBMIT NAME="cmddevolver" VALUE="Devolver"></P></TD>
        </TR>
        </TABLE>
</FORM>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

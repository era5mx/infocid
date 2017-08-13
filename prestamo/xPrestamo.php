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
   document.libro.numcn.focus();}
</script>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>

<FORM NAME="libro" ACTION="Lector.php" METHOD=get >
<TABLE WIDTH=100% BORDER=0 CELLPADDING=1 CELLSPACING=3>
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
        	<TD WIDTH=40%></TD>
		<TD ALIGN=CENTER><B>PRÉSTAMOS</B></TD>
                <TD WIDTH=40%></TD>
        </TR>
	<TR VALIGN=TOP>
                <TD><BR></TD>
                <TD><BR></TD>
                <TD><BR></TD>
        </TR>
	<TR VALIGN=CENTER >
        	<TH ALIGN=RIGHT>Código de Usuario: </TH>
                <TH ALIGN=LEFT COLSPAN=2><INPUT TYPE=TEXT NAME="numcn" SIZE=8 value=""></TH>
	
        </TR>
 	<TR VALIGN=CENTER>
        </TR>
	 <TR VALIGN=CENTER>
                <TH ALIGN=RIGHT>Apellido Paterno: </TH>
                <TH><INPUT TYPE=TEXT NAME="apepat" SIZE=20>&nbsp</TH>
		<TH align=left>Usuario:&nbsp
                <SELECT NAME=usu>
                <OPTION VALUE='interno'>Interno
                <OPTION VALUE='alumno'>Estudiante
                <OPTION VALUE='externo'>Externo
                </SELECT></TH>
        </TR>
                <TD ALIGN=center colspan=3><INPUT TYPE=SUBMIT NAME="verlec" VALUE="Visualizar"></TD>
        </TR>
        </TABLE> 
</FORM>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

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
   document.bext.dni.focus();}
</script>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>
		
<P ALIGN=CENTER><FONT FACE="Nimbus Sans L" SIZE=5 STYLE="font-size: 20pt"><B>ACTIVAR/DESACTIVAR EXTERNO</B></FONT></P>
<P ALIGN=CENTER><BR><BR>
</P>
<FORM name=bext ACTION="borrarexterno.php" METHOD="POST">
	<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>
		<COL WIDTH=135*>
		<COL WIDTH=121*>
		<THEAD>
			<TR VALIGN=BOTTOM>
				<TD WIDTH=53% HEIGHT=33>
					<P ALIGN=RIGHT><B><FONT SIZE=2 FACE="Nimbus Sans L">Ingrese el número de DNI</FONT></B>
					</P>
				</TD>
				<TD WIDTH=47% ALIGN=LEFT><INPUT TYPE=TEXT NAME="dni" SIZE=8></TD>
			</TR>
		</THEAD>
		<TBODY>
			<TR VALIGN=BOTTOM>
				<TD WIDTH=53% HEIGHT=33 ALIGN=RIGHT><INPUT TYPE=SUBMIT VALUE="Mostrar"></TD>
				<TD WIDTH=47%><BR></TD>
			</TR>
		</TBODY>
	</TABLE>
</FORM>
    <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
<P><BR><BR>
</P>
</BODY>
</HTML>

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
   document.inv.reg.focus();}
</script>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1-->
<IMG SRC="../images/logoBiblio.gif" WIDTH="300" HIEGHT="60">
<BR>
<HR NOSHADE COLOR="#0058B0" SIZE="3">
<P ALIGN=CENTER><FONT FACE="Nimbus Sans L" SIZE=5 STYLE="font-size: 20pt"><B>RESULTADO DE LIBROS POR INVENTARIO</B></FONT></P>
<P ALIGN=CENTER><BR><BR></P>
 
<FORM name=inv ACTION="individual1.php" METHOD="POST">
<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>
        <COL WIDTH=135*>
        <COL WIDTH=121*>
		
		<TR VALIGN=CENTER>
                        <TH WIDTH=20% align=right><FONT SIZE=2>Registro del Libro</FONT></TH>
                        <TD WIDTH=15% align=left><INPUT TYPE=TEXT NAME="reg" SIZE=20></TD>
			<TD align=left><INPUT TYPE=SUBMIT VALUE="Buscar"></TD>
                </TR>
</TABLE>
</FORM>

<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

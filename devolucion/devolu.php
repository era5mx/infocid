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
<STYLE>	<!--		A:visited { color: #0000ff }	-->	</STYLE>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1-->
<? include("../Plantilla.rn");
        logo(); ?>

	<TABLE WIDTH=90% BORDER=0 CELLPADDING=2 CELLSPACING=0>
		<COL WIDTH=11*>
		<COL WIDTH=4*>
		<COL WIDTH=11*>
		<COL WIDTH=2*>
		<COL WIDTH=224*>
		<COL WIDTH=4*>
		<TR>
			<TD ROWSPAN=4 WIDTH=4%></TD>
			<TD COLSPAN=5 WIDTH=96%>
				 <A HREF="http://www.infocid.es.mw"><IMG SRC="../images/LOGOcid.jpg" NAME="Imagen1" 
				ALIGN=BOTTOM WIDTH=119 HEIGHT=113 BORDER=1 BORDERCOLOR='#0058B0'></A>
			</TD>
		</TR>
		<TR>
			<TD ROWSPAN=2 WIDTH=2% VALIGN=TOP></TD>
			<TD WIDTH=4%></TD>
			<TD COLSPAN=2 WIDTH=88%>
				<P ALIGN=LEFT><A HREF="ini.php"><B><FONT SIZE=2 FACE="Nimbus Sans L">INICIO
				</FONT></B></A></P>
			</TD>
			<TD ROWSPAN=2 WIDTH=2% VALIGN=TOP></TD>
		</TR>
		<TR>
			<TD COLSPAN=3 WIDTH=93%>
				<P><IMG SRC="../images/space.gif" NAME="Imagen2" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=96%></TD>
		</TR>
		<TR>
			<TD ROWSPAN=3 WIDTH=4%></TD>
			<TD ROWSPAN=2 WIDTH=2% VALIGN=TOP BGCOLOR="#0058B0"></TD>
			<TD COLSPAN=3 WIDTH=93% BGCOLOR="#0058B0">
				<P><IMG SRC="../images/space.gif" NAME="Imagen3" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD ROWSPAN=2 WIDTH=2% VALIGN=TOP BGCOLOR="#0058B0"></TD>
		</TR>
		<TR>
			<TD COLSPAN=2 WIDTH=5%>
				<P ALIGN=CENTER>&nbsp;</P>
			</TD>
			<TD WIDTH=88%>
				<P ALIGN=LEFT><A HREF="xDevolucion.php"><B><FONT SIZE=2 FACE="Nimbus Sans L">DEVOLUCIÓN
				</FONT></B></A></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=96% BGCOLOR="#0058B0"></TD>
		</TR>
		<TR>
			<TD COLSPAN=6 WIDTH=100% HEIGHT=5></TD>
		</TR>
	</TABLE>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

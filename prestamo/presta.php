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
<STYLE>	<!--	A:visited { color: #0000ff }	--> </STYLE>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1-->
<? include("../Plantilla.rn");
        logo(); ?>
<CENTER>
	<TABLE WIDTH=90% BORDER=0 CELLPADDING=2 CELLSPACING=0 STYLE="page-break-before: always">
		<COL WIDTH=11*>
		<COL WIDTH=4*>
		<COL WIDTH=11*>
		<COL WIDTH=2*>
		<COL WIDTH=13*>
		<COL WIDTH=185*>
		<COL WIDTH=26*>
		<COL WIDTH=4*>
		<TR>
			<TD ROWSPAN=4 WIDTH=4%></TD>
			<TD COLSPAN=7 WIDTH=96%>
				 <A HREF="http://www.infocid.es.mw"><IMG SRC="../images/LOGOcid.jpg" NAME="Imagen1"
				ALIGN=BOTTOM WIDTH=119 HEIGHT=113 BORDER="1" BORDERCOLOR="#0058B0"></A>
			</TD>
		</TR>
		<TR>
			<TD ROWSPAN=2 WIDTH=2% VALIGN=TOP></TD>
			<TD WIDTH=4%></TD>
			<TD COLSPAN=4 WIDTH=88%>
				<P ALIGN=LEFT><A HREF="ini.php"><FONT SIZE=2 FACE="Arial, Helvetica">Inicio
				</FONT></A></P>
			</TD>
			<TD ROWSPAN=2 WIDTH=2% VALIGN=TOP></TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93%>
				<P><IMG SRC="../images/space.gif" NAME="Imagen2" ALIGN=BOTTOM WIDTH=2 
HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=7 WIDTH=96%></TD>
		</TR>
		<TR>
			<TD ROWSPAN=16 WIDTH=4%></TD>
			<TD ROWSPAN=11 WIDTH=2% VALIGN=TOP BGCOLOR="#0058B0"></TD>
			<TD COLSPAN=5 WIDTH=93% BGCOLOR="#0058B0">
				<P><IMG SRC="../images/space.gif" NAME="Imagen3" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
			</TD>
			<TD ROWSPAN=10 WIDTH=2% VALIGN=TOP BGCOLOR="#0058B0"></TD>
		</TR>
                <TR>
                        <TD COLSPAN=5 WIDTH=93%>
                      <P><IMG SRC="../images/space.gif" NAME="Imagen2" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
                        </TD>
                </TR>

		<TR>
			<TD COLSPAN=2 WIDTH=5%>
				<P ALIGN=CENTER>&nbsp;</P>
			</TD>
			<TD COLSPAN=3 WIDTH=88%>
				<P ALIGN=LEFT><A HREF="xPrestamo.php"><FONT SIZE=2 FACE="Arial, Helvetica">Préstamos
				</FONT></A></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93%>
				<P><IMG SRC="../images/space.gif" NAME="Imagen4" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=3 WIDTH=10% VALIGN=TOP></TD>
			<TD WIDTH=72%>
				<P><IMG SRC="../images/line.gif" NAME="Imagen5" ALIGN=BOTTOM WIDTH=100% HEIGHT=2 BORDER=0></P>
			</TD>
			<TD WIDTH=10% VALIGN=TOP></TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93%></TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93%>
				<P><IMG SRC="../images/space.gif" NAME="Imagen6" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>
<!--		<TR>
			<TD COLSPAN=2 WIDTH=5%>
				<P>&nbsp;</P>
			</TD>
			<TD COLSPAN=3 WIDTH=88%>
				<P ALIGN=LEFT><A HREF="../construccion.php"><FONT SIZE=2 FACE="Arial, Helvetica">Préstamo
				de Revista</FONT></A></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93%>
				<P><IMG SRC="./[1]_archivos/space.gif" NAME="Imagen7" ALIGN=BOTTOM WIDTH=2 HEIGHT=5 BORDER=0></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=3 WIDTH=10% VALIGN=TOP></TD>
			<TD WIDTH=72%>
				<P><IMG SRC="./[1]_archivos/line.gif" NAME="Imagen8" ALIGN=BOTTOM WIDTH=100% HEIGHT=2 BORDER=0></P>
			</TD>
			<TD WIDTH=10% VALIGN=TOP></TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93%></TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93%>
				<P><IMG SRC="./[1]_archivos/space.gif" NAME="Imagen9" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93%>
				<P><IMG SRC="./[1]_archivos/space.gif" NAME="Imagen10" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>



		<TR>
			<TD COLSPAN=2 WIDTH=5% BGCOLOR="#66ccff">
				<P>&nbsp;</P>
			</TD>
			<TD COLSPAN=3 WIDTH=88% BGCOLOR="#66ccff">
				<P ALIGN=LEFT><A HREF="../PrestamoVideo.php"><FONT SIZE=2 FACE="Arial,
Helvetica">Préstamo
				de Video</FONT></FONT></A></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93% BGCOLOR="#66ccff">
				<P><IMG SRC="./[1]_archivos/space.gif" NAME="Imagen11" ALIGN=BOTTOM WIDTH=2 HEIGHT=5 BORDER=0></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=3 WIDTH=10% VALIGN=TOP BGCOLOR="#66ccff"></TD>
			<TD WIDTH=72% BGCOLOR="#66ccff">
				<P><IMG SRC="./[1]_archivos/line.gif" NAME="Imagen12" ALIGN=BOTTOM WIDTH=100% HEIGHT=2 BORDER=0></P>
			</TD>
			<TD WIDTH=10% VALIGN=TOP BGCOLOR="#66ccff"></TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93% BGCOLOR="#66ccff"></TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93% BGCOLOR="#66ccff">
				<P><IMG SRC="./[1]_archivos/space.gif" NAME="Imagen13" ALIGN=BOTTOM WIDTH=2 HEIGHT=5 BORDER=0></P>
			</TD>
		</TR>

-->

		<TR>
			<TD COLSPAN=2 WIDTH=5%>
				<P>&nbsp;</P>
			</TD>
			<TD COLSPAN=3 WIDTH=88%>
				<P ALIGN=LEFT><A HREF="histPrest.php"><FONT SIZE=2 FACE="Arial, Helvetica">Historial
				de préstamo</FONT></A></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93%>
				<P><IMG SRC="../images/space.gif" NAME="Imagen14" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=5 WIDTH=93%>
				<P><IMG SRC="../images/space.gif" NAME="Imagen15" ALIGN=BOTTOM WIDTH=2 HEIGHT=5 BORDER=0></P>
			</TD>
		</TR>
		<TR>
			<TD COLSPAN=7 WIDTH=96% BGCOLOR="#0058B0"></TD>
		</TR>
		<TR>
			<TD COLSPAN=8 WIDTH=100% HEIGHT=5></TD>
		</TR>
	</TABLE>
</CENTER>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

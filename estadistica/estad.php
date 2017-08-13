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
        logo(); ?><CENTER>
	<TABLE WIDTH=100% BORDER=0 CELLPADDING=2 CELLSPACING=0 STYLE="page-break-before: always">
		<TR>			
			<TD COLSPAN=5 WIDTH=96%>
				<A HREF="http://www.infocid.es.mw"><IMG SRC="../images/LOGOcid.jpg" NAME="Imagen1" 
				ALIGN=BOTTOM WIDTH=120 HEIGHT=113 BORDER=1 BORDERCOLOR='#0058B0'></A>
			</TD>
		</TR>

		<TR>
			<TD COLSPAN=5 WIDTH=88%>
				<P ALIGN=LEFT><A HREF="ini.php"><B><FONT SIZE=2 FACE="Nimbus Sans L">INICIO
				</FONT></B></A></P>
			</TD>
		</TR>

		<TR>
			<TD COLSPAN=5 WIDTH=93%>
				<P><IMG SRC="../images/space.gif" NAME="Imagen2" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
			</TD>
		</TR>

		<TR>
			<TD COLSPAN=5 WIDTH=96%></TD>
		</TR>

		<TR>
			<TD ROWSPAN=14 WIDTH=3%  BGCOLOR="#0058B0"></TD>
			<TD COLSPAN=3 WIDTH=94% BGCOLOR="#0058B0"></TD>
			<TD ROWSPAN=14 WIDTH=3%  BGCOLOR="#0058B0"></TD>
		</TR>


		  <TR>
                        <TD COLSPAN=3 WIDTH=93%>
                                <P><IMG SRC="../images/space.gif" NAME="Imagen4" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
                        </TD>
                </TR>




		<TR>
			<TD WIDTH=5%>
                                <P ALIGN=CENTER>&nbsp;</P>
                        </TD>

			<TD COLSPAN=2 WIDTH=88%>
				<P ALIGN=LEFT><A HREF="estadistica1.php"><B><FONT SIZE=2 FACE="Nimbus Sans 
				L">CONSULTAS
				</FONT></B></A></P>
			</TD>
		</TR>

		<TR>
                        <TD COLSPAN=3 WIDTH=93%>
                                <P><IMG SRC="../images/space.gif" NAME="Imagen4" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
                        </TD>
                </TR>
	
		<TR>
                        <TD WIDTH=10% VALIGN=TOP></TD>
                        <TD WIDTH=72%>
                                <P><FONT FACE="Nimbus Sans L"><B><IMG SRC="../images/line.gif" NAME="Imagen5" ALIGN=BOTTOM 
				WIDTH=100% HEIGHT=2 BORDER=0></B></FONT></P>
			</TD>
                        <TD WIDTH=10% VALIGN=TOP></TD>
                </TR>

		<TR>
                        <TD COLSPAN=3 WIDTH=93%></TD>
                </TR>
                <TR>
                        <TD COLSPAN=3 WIDTH=93%>
                                <P><IMG SRC="../images/space.gif" NAME="Imagen6" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
                        </TD>
                </TR>



		
                <TR>
                        <TD WIDTH=5%>
                                <P ALIGN=CENTER>&nbsp;</P>
                        </TD>

                        <TD COLSPAN=2 WIDTH=88%>
                                <P ALIGN=LEFT><A HREF="estadprest.php"><B><FONT SIZE=2 FACE="Nimbus Sans
                                L">PRÉSTAMOS
                                </FONT></B></A></P>
                        </TD>
                </TR>

                <TR>
                        <TD COLSPAN=3 WIDTH=93%>
                                <P><IMG SRC="../images/space.gif" NAME="Imagen4" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
                        </TD>
                </TR>

                <TR>
                        <TD WIDTH=10% VALIGN=TOP></TD>
                        <TD WIDTH=72%>
                                <P><FONT FACE="Nimbus Sans L"><B><IMG SRC="../images/line.gif" NAME="Imagen5" ALIGN=BOTTOM
                                WIDTH=100% HEIGHT=2 BORDER=0></B></FONT></P>
                        </TD>
                        <TD WIDTH=10% VALIGN=TOP></TD>
                </TR>

                <TR>
                        <TD COLSPAN=3 WIDTH=93%></TD>
                </TR>
                <TR>
                        <TD COLSPAN=3 WIDTH=93%>
                                <P><IMG SRC="../images/space.gif" NAME="Imagen6" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
                        </TD>
                </TR>




		<TR>
			<TD WIDTH=5%>
                                <P ALIGN=CENTER>&nbsp;</P>
                        </TD>

                        <TD COLSPAN=2>
                                <P ALIGN=LEFT><A HREF="estLibrosPrest.php"><B><FONT SIZE=2 FACE="Nimbus Sans 
				L">LIBROS
                                </FONT></B></A></P>
                        </TD>
                </TR>	


		<TR>
                        <TD COLSPAN=3 WIDTH=93%>
                                <P><IMG SRC="../images/space.gif" NAME="Imagen14" ALIGN=BOTTOM WIDTH=2 HEIGHT=3 BORDER=0></P>
                        </TD>
                </TR>
               <!--  <TR>
                        <TD COLSPAN=3 WIDTH=93%>
                                <P><IMG SRC="./[1]_archivos/space.gif" NAME="Imagen15" ALIGN=BOTTOM WIDTH=2 HEIGHT=5 BORDER=0></P>
                        </TD>
                </TR> -->	

		<TR>
			<TD COLSPAN=5 WIDTH=96% BGCOLOR="#0058B0"></TD>
		</TR>

		<TR>
			<TD COLSPAN=5 WIDTH=100% HEIGHT=5></TD>
		</TR>
	</TABLE>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

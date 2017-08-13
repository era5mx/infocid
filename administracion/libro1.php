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
<SCRIPT>
function sf(){
    document.lib.reg.focus(); }
</SCRIPT>
	<STYLE>
	<!--
		TD P { color: #0058b0 }
		P { color: #0058b0 }
	-->
	</STYLE>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>
<BR>
<P ALIGN=CENTER STYLE="margin-left: 2.28cm"><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=5 STYLE="font-size: 20pt"><B>INGRESO
DE LIBROS</B></FONT></FONT></FONT></P>
<FORM NAME="lib" ACTION="libro2.php" METHOD="POST">
	<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>
		<COL WIDTH=39*>
		<COL WIDTH=45*>
		<COL WIDTH=173*>
		<THEAD>
			<TR>
				<TD COLSPAN=3 WIDTH=100% VALIGN=BOTTOM></TD>
			</TR>
		</THEAD>
		<TBODY>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>REGISTRO
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="reg" SIZE=10> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>N&ordm;
					C&Oacute;DIGO </B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="cod" SIZE=12> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>AUTOR
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="aut" SIZE=50> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>T&Iacute;TULO
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="tit" SIZE=50> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>DESCRIPTORES<!-- <INPUT TYPE=TEXT NAME="des" SIZE=50 -->
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><TEXTAREA NAME="des" ROWS=5 COLS=60 WRAP=SOFT></TEXTAREA> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>RES&Uacute;MEN
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><TEXTAREA NAME="res" ROWS=20 COLS=60 WRAP=SOFT></TEXTAREA> 
					</P>
				</TD>
			</TR>
			<TR>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>IDIOMA
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><SELECT NAME="idi">
						<OPTION VALUE="AL" SELECTED>Alemán
						<OPTION VALUE="ES">Espa&ntilde;ol
						<OPTION VALUE="IN">Inglés
						<OPTION VALUE="FR">Francés
						<OPTION VALUE="IT">Italiano
						<OPTION VALUE="PO">Portugués</OPTION>
					</SELECT> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>PIE
					DE IMPRENTA </B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD WIDTH=17%>
					<P><B>LUGAR :</B></P>
					<P><B>EDITORIAL :</B></P>
					<P><B>A&Ntilde;O :</B></P>
				</TD>
				<TD WIDTH=67%>
					<P><INPUT TYPE=TEXT NAME="pie" SIZE=40> <BR><INPUT TYPE=TEXT NAME="pieedito" SIZE=40>
					<BR><INPUT TYPE=TEXT NAME="pieano" SIZE=5></P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>ISBN
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="isb" SIZE=10> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>P&Aacute;GINAS
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="pag" SIZE=4> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>PRECIO
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="pre" SIZE=10> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>EDICI&Oacute;N
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="edi" SIZE=6> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>FECHA
					DE INGRESO</B></FONT></FONT></FONT></P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="fec" SIZE=10> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>N&Uacute;MERO
					DE BC </B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="nbc" SIZE=10> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>N&Uacute;MERO
					DE INGRESO</B></FONT></FONT></FONT></P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="nui" SIZE=10> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=15%>
					<P ALIGN=RIGHT><FONT COLOR="#000080"><FONT FACE="Lucida, sans-serif"><FONT SIZE=1 STYLE="font-size: 8pt"><B>OBSERVACIONES
					</B></FONT></FONT></FONT>
					</P>
				</TD>
				<TD COLSPAN=2 WIDTH=85%>
					<P><INPUT TYPE=TEXT NAME="obs" SIZE=50> 
					</P>
				</TD>
			</TR>
			<TR>
				<TD COLSPAN=3 WIDTH=100% VALIGN=TOP>
					<DIV ALIGN=CENTER>
						<P><INPUT TYPE=SUBMIT VALUE="ACEPTAR"></P>
					</DIV>
				</TD>
			</TR>
		</TBODY>
	</TABLE>
</FORM>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>
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
   document.ndoc.cod.focus()}
</script>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>
<BR>

<P ALIGN=CENTER STYLE="margin-left: 2.28cm"><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=5 STYLE="font-size: 20pt"><B>INGRESO
	DE DOCUMENTOS</B></FONT></P>

<FORM name=ndoc ACTION="newdoc2.php" METHOD="POST">
	<TABLE WIDTH=719 BORDER=0 CELLPADDING=4 CELLSPACING=0>
		<COL WIDTH=109>
		<COL WIDTH=594>
		<THEAD>
                        <TR VALIGN=BOTTOM>
				<TD WIDTH=8%></TD>
			</TR>
                </THEAD>
		<TBODY>
                        <TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=1 STYLE="font-size: 8pt"><B>CÓDIGO
					</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="cod" value='LTX/RNI/'SIZE=20>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=1 STYLE="font-size: 8pt"><B>AUTOR
					</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="aut" SIZE=50>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=1 STYLE="font-size: 8pt"><B>TÍTULO
					</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="tit" SIZE=50>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=1 STYLE="font-size: 8pt"><B>DESCRIPTORES
					</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="des" value='RNI / RADIACIONES NO IONIZANTES / ' SIZE=50>
				</TD>
			</TR>
	<!-- 		<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=1 STYLE="font-size: 8pt"><B>RESÚMEN
					</B></FONT></P>
				</TD>
				<TD>
					<TEXTAREA NAME="res" ROWS=20 COLS=60 WRAP="VIRTUAL"></TEXTAREA>
				</TD>
			</TR> -->
			<TR>
				<TD ALIGN=RIGHT>
					<P><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=1 STYLE="font-size: 8pt"><B>IDIOMA
					</B></FONT></P>
				</TD>
				<TD>
						<select name="idi" size=1>
					   <option value='AL'>Alemán
                                           <option value='ES'>Español
					   <option value='IN'>Inglés
                                           <option value='FR'>Francés
                                           <option value='IT'>Italiano
                                           <option value='PO'>Portugués
					</select>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=1 STYLE="font-size: 8pt"><B>PIE	DE IMPRENTA
					</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="pie" SIZE=20>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=1 STYLE="font-size: 8pt"><B>PÁGINAS
					</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="pag" SIZE=4>
				</TD>
			</TR>

			<!-- <TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=1 STYLE="font-size: 8pt"><B>FECHA DE
					INGRESO</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="fec" SIZE=10>
				</TD>
			</TR> -->

			<TR VALIGN=TOP>
                                <TD ALIGN=RIGHT>
                                        <P><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=1 STYLE="font-size: 8pt"><B>OBSERVACIONES
					</B></FONT></P>
                                </TD>
                                <TD>
                                        <INPUT TYPE=TEXT NAME="obs" SIZE=50>
                                </TD>
                        </TR>
			<TR VALIGN=TOP>
				<TD>
					<P><INPUT TYPE=SUBMIT VALUE="ACEPTAR"></P>
				</TD>
				<TD><BR>
				</TD>
			</TR>
		</TBODY>
	</TABLE>
</FORM>

<? pie() ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>
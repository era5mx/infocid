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
   document.next.dni.focus();}
</script>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>

<P ALIGN=LEFT STYLE="margin-left: 2.28cm"><FONT FACE="Lucida, sans-serif" SIZE=5 STYLE="font-size: 20pt"><B>INGRESO</B></FONT></P>
<FORM name=next ACTION="externo2.php" METHOD="POST">
	<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>
		<COL WIDTH=96*>
		<COL WIDTH=160*>
		<THEAD>
			<TR VALIGN=TOP>
				<TD WIDTH=38%><BR></TD>
				<TD WIDTH=62%></TD>
			</TR>
		</THEAD>
		<TBODY>
			<TR VALIGN=TOP>
                                <TD WIDTH=38%>
                                        <P><FONT FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>DNI</B></FONT></P>
                                </TD>
                                <TD WIDTH=62%><INPUT TYPE=TEXT NAME="dni" SIZE=20></TD>
                        </TR>
			<TR VALIGN=TOP>
				<TD WIDTH=38%>
					<P><FONT FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>NOMBRES</B></FONT></P>
				</TD>
				<TD WIDTH=62%><INPUT TYPE=TEXT NAME="nom" SIZE=20></TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=38%>
					<P><FONT FACE="Lucida, sans-serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>APELLIDO
					PATERNO </B></FONT></FONT>
					</P>
				</TD>
				<TD WIDTH=62%><INPUT TYPE=TEXT NAME="app" SIZE=20></TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=38%>
					<P><FONT FACE="Lucida, sans-serif"><FONT SIZE=2 STYLE="font-size: 9pt"><B>APELLIDO
					MATERNO </B></FONT></FONT>
					</P>
				</TD>
				<TD WIDTH=62%><INPUT TYPE=TEXT NAME="apm" SIZE=20></TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=38%>
					<P><FONT FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>DOMICILIO</B></FONT></P>
			</TD>
				<TD WIDTH=62%><INPUT TYPE=TEXT NAME="dir" SIZE=40></TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=38%>
					<P><FONT FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>TEL&Eacute;FONO</B></FONT></P>
				</TD>
				<TD WIDTH=62%><INPUT TYPE=TEXT NAME="tel" SIZE=20></TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=38%>
					<P><FONT FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>SEXO</B></FONT></P>
				</TD>
				<TD WIDTH=62%><select name="sex" size=1>
	                                           <option value="M">Masculino
	                                           <option value="F">Femenino
        	                                   </select>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=38%>
					<P><FONT FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>PROCEDENCIA</B></FONT></P>
				</TD>
				<TD WIDTH=62%><INPUT TYPE=TEXT NAME="pro" SIZE=20></TD>
			</TR>
                        <TR VALIGN=TOP>
				<TD WIDTH=38%><INPUT TYPE=SUBMIT VALUE="SUBMIT"></TD>
				<TD WIDTH=62%><BR></TD>
			</TR>
		</TBODY>
	</TABLE>
</FORM>
  <? pie(); ?>
<!--end content --> 
</div>
</center>
</body>
</html>

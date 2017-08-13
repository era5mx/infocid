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
<STYLE><!-- A:visited { color: #0000ff } --></STYLE>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>
  <TABLE WIDTH=50% BORDER=0 CELLPADDING=2 CELLSPACING=0>
    <COL WIDTH=256*>
    <TR>
      <TD WIDTH=50%><P ALIGN=LEFT><FONT SIZE=1 FACE="Arial, Helvetica">&#160;<A
							HREF="listalibro.php?reg=A&val=0"><img src="../images/admin.gif" border="0" align="absmiddle"><B>Administraci&oacute;n</B></A></FONT></P>        </TD>
      <TD WIDTH=50%><font size=1 face="Arial, Helvetica">&#160;<a
							href="listalibro.php?reg=L&val=0"><img src="../images/otro.gif" border="0" align="absmiddle"><b>Otros</b></a></font></TD>
      <TD WIDTH=100%><font size=1 face="Arial, Helvetica">&#160;<a
							href="documentos.php"><img src="../images/document.gif" border="0" align="absmiddle"><b>Documentos</b></a></font></TD>
    </TR>
	<TR>
		<TD colspan='3' align='center'>
			<? 
				echo "<h1>Lista de Libros</h1><br>"; 
			?>
		</TD>
	</TR>

  </TABLE>
    <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
<P><BR><BR></P>
</BODY>
</HTML>

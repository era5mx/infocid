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

<?php

 //$coneccion = pg_connect("","","","","Biblio");
  include('../includes/connection.php');
 //$coneccion1 = pg_connect("","","","","Inventario");
  include('../includes/connection1.php');

//Total de Libros en BD:

 $sql5 = "select registro from libro";
 $exec5 = pg_exec($coneccion,$sql5);
 $row=pg_numrows($exec5);

//Inventario:
 //$sql2 = "select registro from libroinv1";
 $sql2 = "select registro from libroinv";
 $exec2 = pg_exec($coneccion1,$sql2);
 $row2=pg_numrows($exec2);

//Pendiente:
$pen= $row - $row2;

//porcentajes

	//Correcion Division by zero 
 	if ($row){
 		$pLibInv=round(($row2/$row)*100,2);
 		$pLibFal=round(($pen/$row)*100,2);
 	}
 	else{
 		$pLibInv=round(0,2);
 		$pLibFal=round(0,2);
	}
 	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML><HEAD>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>
<P ALIGN=CENTER STYLE="margin-left: 2.28cm"><BR><BR></P>
<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<COL WIDTH=256*>
	<THEAD>
		<TR>
			<TH WIDTH=100% VALIGN=TOP>
				<P ALIGN=CENTER><BR>
				<BR CLEAR=LEFT><BR></P>
			</TH>
		</TR>
	</THEAD>
</TABLE>

<?php
$an=getDate();
$a=$an["year"];
$a=$a - 1;
echo "<P ALIGN=CENTER><FONT COLOR='#000080' FACE='Nimbus Sans L' SIZE=8 STYLE='font-size: 14pt'>
	<B>RESUMEN FINAL DEL ESTADO DEL INVENTARIO $a</B></FONT></P>";
?>

<FORM ACTION="" METHOD="POST">

<table WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>
<TR VALIGN=BOTTOM>
        <TD WIDTH=50% align="right"></TD>
        <TD WIDTH=10% align="right"></TD>
        <TD WIDTH=40% align="center"><P><FONT COLOR="#000080" FACE="Nimbus Sans L" SIZE=2 STYLE="font-size: 9pt"><B>%</B></FONT></P></TD>
</TR>


<TR VALIGN=BOTTOM>
	<TD WIDTH=50% align="right"><P><FONT COLOR="#000080" FACE="Nimbus Sans L" SIZE=2 STYLE="font-size: 9pt"><B>Libros en BD:</B></FONT></P></TD>
        <TD WIDTH=10% align="right"><P><FONT COLOR="#000080" FACE="Nimbus Sans L" SIZE=2 STYLE="font-size: 9pt"><B><?php echo $row; ?></B></FONT></P></TD>
	<TD WIDTH=40% align="center"><P><FONT COLOR="#000080" FACE="Nimbus Sans L" SIZE=2 STYLE="font-size: 9pt"><B>100.00</B></FONT></P></TD>
</TR>


<TR VALIGN=BOTTOM>
        <TD align="right"><P><FONT COLOR="#000080" FACE="Nimbus Sans L" SIZE=2 STYLE="font-size: 
9pt"><B><A HREF="listainventariobk.php?val=0">Inventariados:</A></B></FONT></P></TD>
	<TD align="right"><P><FONT COLOR="#000080" FACE="Nimbus Sans L" SIZE=2 STYLE="font-size: 9pt"><B><?php echo $row2; ?></B></FONT></P></TD>
        <TD align="center"><P><FONT COLOR="#000080" FACE="Nimbus Sans L" SIZE=2 STYLE="font-size: 9pt"><B><?php echo $pLibInv; ?></B></FONT></P></TD>
</TR>

<TR VALIGN=BOTTOM>
        <TD align="right"><P><FONT COLOR="#000080" FACE="Nimbus Sans L" SIZE=2 STYLE="font-size: 9pt"><B><A HREF="pendiente.php">Pendientes:</B></A></FONT></P></TD>
        <TD align="right"><P><FONT COLOR="#000080" FACE="Nimbus Sans L" SIZE=2 STYLE="font-size: 9pt"><B><?php echo $pen; ?></B></FONT></P></TD>
        <TD align="center"><P><FONT COLOR="#000080" FACE="Nimbus Sans L" SIZE=2 STYLE="font-size: 9pt"><B><?php echo $pLibFal; ?></B></FONT></P></TD>
</TR>
<TR VALIGN=BOTTOM>
        <TD WIDTH=50% align="right"></TD>
        <TD WIDTH=10% align="right"></TD>
        <TD WIDTH=40% align="center"><P></td>
</TR>
<TR VALIGN=BOTTOM>
        <TD WIDTH=50% align="right"></TD>
        <TD WIDTH=10% align="right"></TD>
        <TD WIDTH=40% align="center"><P></td>
</TR>
</table>
</FORM>
<? pie(); ?>

  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>
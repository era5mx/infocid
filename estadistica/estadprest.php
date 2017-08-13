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
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>
<P ALIGN=CENTER><FONT SIZE=5 STYLE="font-size: 20pt"><B>Estadísticas de Préstamos</B></FONT></P>
<P ALIGN=CENTER><BR><BR>
</P>
<FORM ACTION="estadprest2.php" METHOD="POST">
	<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>
		<COL WIDTH=134*>
		<COL WIDTH=122*>
                <THEAD>
			<TR VALIGN=TOP>
				<TD WIDTH=38%>
					<BR>
				</TD>
				<TD WIDTH=62%><BR></TD>
			</TR>
		</THEAD>
                <TBODY>
			<TR VALIGN=TOP>
				<TD WIDTH=38%>
                                        <P ALIGN=RIGHT><FONT FACE="Nimbus Sans L" SIZE=2><B>DÍA </B></FONT></P>
                                </TD>
				<TD WIDTH=62%>
					<P><SELECT NAME="dia" SIZE=1>

					   <OPTION VALUE="">
	                       <?php for ($i=1;$i<32;$i++){
                                        if ($i<10){
                                        $d="0".$i;
                                        }else{ $d=$i; };
	                                        echo "<OPTION VALUE='$d'>$d";
                                }?>

                                           </SELECT>
					</P>
				</TD>
			</TR>
                        <TR VALIGN=TOP>
				<TD WIDTH=38%>
                                        <P ALIGN=RIGHT><FONT FACE="Nimbus Sans L" SIZE=2><B>MES</B></FONT></P>
                                </TD>
				<TD WIDTH=62%>
					<P><SELECT NAME="mes" SIZE=1>
					   
					   <OPTION VALUE="">
                               <?php for ($i=1;$i<13;$i++){
                                        if ($i<10){
                                        $m="0".$i;
                                        }else{ $m=$i; };
						echo "<OPTION VALUE='$m'>$m";
                                }?>

                                           </SELECT>
					</P>
				</TD>
			</TR>
                        <TR VALIGN=TOP>
				<TD WIDTH=38%>
                                        <P ALIGN=RIGHT><FONT FACE="Nimbus Sans L" SIZE=2><B>AÑO</B></FONT></P>
                                </TD>
				<TD WIDTH=62%>
					<select name="ano" size=1>
					<OPTION VALUE="">
					<?php
                                 $an=getDate();
                                 $a=$an["year"]+1;

                                for ($i=2002;$i<$a;$i++){
                                         echo "<OPTION VALUE='$i'>$i";
                                }; ?>
	
                                        </select>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD WIDTH=52%>
					<DIV ALIGN=RIGHT>
                                           <P><INPUT TYPE=SUBMIT VALUE="Aceptar"></P>
					</DIV>
				</TD>
				<TD WIDTH=48%>
					<BR>
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

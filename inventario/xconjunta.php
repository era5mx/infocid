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
   document.conj.aut.focus();}
</script>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>
<IMG SRC="../images/logoBiblio.gif" WIDTH="300" HIEGHT="60">
<BR>
<HR NOSHADE COLOR="#0058B0" SIZE="3">
<P ALIGN=CENTER><FONT FACE="Nimbus Sans L"><FONT SIZE=5 STYLE="font-size: 20pt"><B>B&Uacute;SQUEDA
CONJUNTA DE LIBROS POR INVENTARIO</B></FONT></FONT></P>
<P ALIGN=CENTER><BR><BR></P>
 
<FORM name=conj ACTION="conjunta.php" METHOD="POST">
<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>
        <COL WIDTH=135*>
        <COL WIDTH=121*>
 
                <TR VALIGN=CENTER>
                        <TD WIDTH=3%><INPUT TYPE=CHECKBOX NAME="chkAut" VALUE="SI"></TD>
                        <TH WIDTH=10%><FONT SIZE=2>Autor del Libro</FONT></TH>
                        <TD><INPUT TYPE=TEXT NAME="aut" SIZE=20></TD>
                        <TD WIDTH=40%><SELECT NAME="OLtit" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT></TD>
                </TR>
 
                <TR VALIGN=CENTER>
                        <TD><INPUT TYPE=CHECKBOX NAME="chkTit" VALUE="SI"></TD>
                        <TH><FONT SIZE=2>Título del Libro</FONT></TH>
                        <TD><INPUT TYPE=TEXT NAME="tit" SIZE=20></TD>
                        <TD><SELECT NAME="OLdes" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT>
                        </TD>
                </TR>
 
                <TR VALIGN=CENTER>
                        <TD><INPUT TYPE=CHECKBOX NAME="chkDes" VALUE="SI"></TD>
                        <TH><FONT SIZE=2>Descriptor</FONT></TH>
                        <TD><INPUT TYPE=TEXT NAME="des" SIZE=20></TD>
                        <TD><SELECT NAME="OLpre" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT>
                        </TD>
                </TR>

                <TR VALIGN=CENTER>
                        <TD><INPUT TYPE=CHECKBOX NAME="chkPre" VALUE="SI"></TD>
                        <TH><FONT SIZE=2>Prestado</FONT></TH>
                        <TD><SELECT NAME="pre" SIZE=1>
                                <OPTION VALUE="">
                                <OPTION VALUE="SI">Si
                                <OPTION VALUE="NO">No
                                </SELECT>
                        </TD>
                        <TD><SELECT NAME="OLdia" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT>
                        </TD>
                </TR>
 
                <TR VALIGN=CENTER>
                        <TD><INPUT TYPE=CHECKBOX NAME="chkFec" VALUE="SI"></TD>
                        <TH><FONT SIZE=2>Fecha Ingreso</FONT></TH>
                        <TD><P>Día: <SELECT NAME="dia" SIZE=1>
                                <OPTION VALUE="">
                                <OPTION VALUE="01">01
                                <OPTION VALUE="02">02
                                <OPTION VALUE="03">03
                                <OPTION VALUE="04">04
                                <OPTION VALUE="05">05
                                <OPTION VALUE="06">06
                                <OPTION VALUE="07">07
                                <OPTION VALUE="08">08
                                <OPTION VALUE="09">09
                                <OPTION VALUE="10">10
                                <OPTION VALUE="11">11
                                <OPTION VALUE="12">12
                                <OPTION VALUE="13">13
                                <OPTION VALUE="14">14
                                <OPTION VALUE="15">15
                                <OPTION VALUE="16">16
                                <OPTION VALUE="17">17
                                <OPTION VALUE="18">18
                                <OPTION VALUE="19">19
                                <OPTION VALUE="20">20
                                <OPTION VALUE="21">21
                                <OPTION VALUE="22">22
                                <OPTION VALUE="23">23
                                <OPTION VALUE="24">24
                                <OPTION VALUE="25">25
                                <OPTION VALUE="26">26
                                <OPTION VALUE="27">27
                                <OPTION VALUE="28">28
                                <OPTION VALUE="29">29
                                <OPTION VALUE="30">30
                                <OPTION VALUE="31">31
                                </SELECT></P>
                           <P> Mes: <SELECT NAME="mes" SIZE=1>
                                <OPTION VALUE="">
                                <OPTION VALUE="ENE">Enero
                                <OPTION VALUE="FEB">Febrero
				<OPTION VALUE="MAR">Marzo
                                <OPTION VALUE="ABR">Abril
				<OPTION VALUE="MAY">Mayo
                                <OPTION VALUE="JUN">Junio
                                <OPTION VALUE="JUL">Julio
                                <OPTION VALUE="AGO">Agosto
                                <OPTION VALUE="SEP">Septiembre
				<OPTION VALUE="OCT">Octubre
                                <OPTION VALUE="NOV">Noviembre
                                <OPTION VALUE="DIC">Diciembre
                                </SELECT></P>
                           <P> Año: <SELECT NAME="ano" SIZE=1>
                                <OPTION VALUE="">
                                <OPTION VALUE="01">2001
                                <OPTION VALUE="00">2000
				<OPTION VALUE="99">1999
                                <OPTION VALUE="98">1998
                                <OPTION VALUE="97">1997
				<OPTION VALUE="96">1996
                                <OPTION VALUE="95">1995
				<OPTION VALUE="99">1994
                                <OPTION VALUE="98">1993
                                <OPTION VALUE="97">1992
                                <OPTION VALUE="96">1991
                                <OPTION VALUE="95">1990
				<OPTION VALUE="95">1989
				<OPTION VALUE="95">1988
				<OPTION VALUE="95">1987
                                <OPTION VALUE="95">1986
				<OPTION VALUE="95">1985
                                <OPTION VALUE="95">1984
                                <OPTION VALUE="95">1983
                                <OPTION VALUE="95">1982
				<OPTION VALUE="95">1981
                                <OPTION VALUE="95">1980
				<OPTION VALUE="97">1979
                                <OPTION VALUE="96">1978
                                <OPTION VALUE="95">1977
                                </SELECT></P>
                        </TD>
                        <TD VALIGN=TOP><P><SELECT NAME="OLmes" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT></P>
                            <P><SELECT NAME="OLano" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT></P>
                        </TD>
                </TR>
 
                <TR VALIGN=BOTTOM>
                        <TD><BR></TD>
                        <TD><INPUT TYPE=SUBMIT VALUE="Buscar"></TD>
                        <TD><BR></TD>
                        <TD><BR></TD>
                </TR>
 
</TABLE>
<BR>
<BR>

<?php
echo "<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>";
 
echo "<TR VALIGN=RIGHT>";
         echo "<TH> </TH>";
         echo "<TH>DATOS DEL LIBRO</TH>";
         echo "<TH> </TH>";
echo "</TR>";
 
echo "<TR VALIGN=CENTER>";
         echo "<TH WIDTH=10%>Registro: </TH>";
         echo "<TD VALIGN=LEFT>$registro</TD>";
echo "</TR>";
 
echo "<TR VALIGN=CENTER>";
         echo "<TH>Codigo Libro: </TH>";
         echo "<TD VALIGN=LEFT>$codigo</TH>";
echo "</TR>";
 
echo "<TR VALIGN=LEFT>";
        echo "<TH>Autor Libro: </TH>";
        echo "<TD VALIGN=LEFT>$autor</TD>";
echo "</TR>";
 
echo "<TR VALIGN=LEFT>";
        echo "<TH>Titulo Libro: </TH>";
        echo "<TD VALIGN=LEFT>$titulo</TD>";
echo "</TR>";
 
echo "<TR VALIGN=CENTER>";
         echo "<TH WIDTH=10%>Nro BC: </TH>";
         echo "<TD VALIGN=LEFT>$numbc</TD>";
echo "</TR>";
 
echo "<TR VALIGN=CENTER>";
         echo "<TH>Nro Ingreso: </TH>";
         echo "<TD VALIGN=LEFT>$numingreso</TH>";
echo "</TR>";
 
echo "<TR VALIGN=LEFT>";
        echo "<TH>Fecha Ingreso: </TH>";
        echo "<TD VALIGN=LEFT>$fecha</TD>";
echo "</TR>";
 
echo "<TR VALIGN=LEFT>";
        echo "<TH>Pie Imprenta: </TH>";
        echo "<TD VALIGN=LEFT>$pie</TD>";
echo "</TR>";
 
echo "<TR VALIGN=LEFT>";
        echo "<TH>Precio Libro: </TH>";
        echo "<TD VALIGN=LEFT>$precio</TD>";
echo "</TR>";
 
echo "<TR VALIGN=LEFT>";
        echo "<TH>Prestado: </TH>";
        echo "<TD VALIGN=LEFT>$prestado</TD>";
echo "</TR>";
echo "</TABLE>";
 
?>
 
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>
<?
/**
* @Infocid version 2.0  feb-2005
* @Copyright (C) 2005 SPHERA5, C.A. <sphera5@gmail.com>
**
* @Obra basada en el Programa Infocid
* @Copyright (C) 2003 CIDTEL <cidtel@inictel.gob.pe>
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML><HEAD>
<script>
<!--
function sf(){document.doc.aut.focus();}
// -->
</script>
	<?php include('../includes/head.php'); ?>
  <?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 

<?php include("../Plantilla.rn");
        Logo()
 ?>
<BR><BR><BR><BR>
<P ALIGN=CENTER><FONT FACE="Nimbus Sans L" SIZE=5 STYLE="font-size: 20pt"><B>BÚSQUEDA DE DOCUMENTOS</B></FONT></P>
<BR>
<FORM name=doc ACTION="Buscadoc2.php" METHOD="POST">

<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>
        <COL WIDTH=135*>
        <COL WIDTH=121*>

                 
                <TR VALIGN=CENTER>
                        <TD WIDTH=40% ALIGN=RIGHT><BR></TD>
                        <TH WIDTH=10%><FONT SIZE=2>Autor :</FONT></TH>
                        <TD WIDTH=10%><INPUT TYPE=TEXT NAME="aut" SIZE=20></TD>
                        <TD WIDTH=40%><SELECT NAME="OLaut" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT></TD>
                </TR>

                <TR VALIGN=CENTER>
                        <TD ALIGN=RIGHT><BR></TD>
                        <TH><FONT SIZE=2>Título :</FONT></TH>
                        <TD><INPUT TYPE=TEXT NAME="tit" SIZE=20></TD>
                        <TD><SELECT NAME="OLtit" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT>
                        </TD>
                </TR>

                <TR VALIGN=CENTER>
                        <TD ALIGN=RIGHT><BR></TD>
                        <TH><FONT SIZE=2>Tema :</FONT></TH>
                        <TD><INPUT TYPE=TEXT NAME="des" SIZE=20></TD>
                        <TD><BR></TD>
                </TR>

                <TR VALIGN=BOTTOM>
                        <TD><BR></TD>
                        <TD><BR></TD>
                        <TD ALIGN=CENTER><INPUT TYPE=SUBMIT VALUE="Buscar"></TD>
                        <TD><BR></TD>
                </TR>

</TABLE>
</FORM>
<BR><BR><BR><BR>
<? pie() ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>


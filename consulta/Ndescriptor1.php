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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML><HEAD>
<script>
<!--
function sf(){document.desc.carne.focus();}
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
<P ALIGN=CENTER><FONT FACE="Nimbus Sans L" SIZE=5 STYLE="font-size: 20pt"><B>BÚSQUEDA DE LIBROS POR TEMA</B></FONT></P>
<BR>
<FORM name=desc ACTION="Ndescriptor2.php" METHOD="POST">

<? tablaNdescriptor() ?>

</FORM>
<BR><BR><BR><BR>
<? pie() ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>
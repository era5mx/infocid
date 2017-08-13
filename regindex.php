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
<html><head>
<?php include('includes/head.php'); ?>
<?php include('includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1-->
<IMG SRC="images/logoBiblio.gif" WIDTH="300" HEIGHT="60">
<BR><HR NOSHADE COLOR="#0058B0" SIZE="3"><BR>
<table border=0 cellspacing=0 cellpadding=0 align=center background="images/logo1.jpg" width=600 height=300>
<tr><td height=300><center>
<!--		Inicio ERROR Autentificacion	-->		
<?PHP
// Mostrar error de Autentificación.
include ("usuarios/aut_mensaje_error.inc.php");
if (isset($_GET['error_login'])){
$error=$_GET['error_login'];
echo "Error: $error_login_ms[$error]";
}
?>

<?php 
//Determinando pagina de origen

if (isset($_GET['url'])){
	$pag_origen=$path."/".$_GET['url'];
}
else {
	$pag_origen = $path."/administracion/xlibro.php";
}
?>


<!--		Fin ERROR Autentificacion	-->
 <!-- Inicio Formulario HTML-->
<p><form action="<? echo $pag_origen; ?>" method="post">
Usuario: <input type="text" name="user">
Password: <input type="password" name="pass">
&nbsp;&nbsp;&nbsp;<input type=submit value="Entrar">
</form>
<!-- Fin Formulario HTML-->
<p>&nbsp;<p>&nbsp;<p>&nbsp;<p>&nbsp;<p>&nbsp;</center>
</td></tr>
<tr><td align=center>
<BR><BR><BR><BR>
<HR NOSHADE COLOR="#0058B0" SIZE="3" align=center>
<font face='MS Sans Serif' size=1 align=center><B>© 
<?php echo "<A HREF=\"mailto: $mailto\">"; ?><?php echo "$copy"; ?></a> Todos los derechos
reservados - Este sistema es software libre publicado bajo la licencia <a
href="<?php echo "$path"; ?>/GPLes.htm" title="Libre no Gratis" target="blank">GNU/GPL</A></B></font><BR><BR>
</td></tr>
</table>
<!--end content --> 
</div>
</center>
</body>
</html>

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

<?php
$an=getDate();
$a=$an["year"];
$a=$a - 1;


echo "<P ALIGN=CENTER><FONT FACE='Nimbus Sans L' SIZE=5 STYLE='font-size: 20pt'><B>RESULTADO DE LISTA DE LIBROS INVENTARIADOS 
$a</B></FONT></P>";
echo "<P ALIGN=CENTER><BR><BR></P>";


$sql1="select * from libroinv1 order by registro asc";


//$coneccion = pg_connect("","","","","Inventario");
include('../includes/connection.php');
$exec =pg_exec($coneccion,$sql1);
$rows = pg_numrows($exec);


if ($rows >0) {
/* echo "<A HREF=\"javascript:history.back()\">Volver al Resumen del Estado del Inventario</A><BR><BR>";
        echo "Se encontró ".$rows." libro(s) de Inventariados";  */
        echo "<BR>";
        echo "<BR>";
        echo "<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>";
        echo "<TR VALIGN=RIGHT>";
                echo "<TH COLSPAN=11>DATOS DEL LIBRO</TH>";
        echo "</TR>";

        echo "<TR VALIGN=CENTER>";
		echo "<TH>N° </TH>";
		echo "<TH>Logística</TH>";
                echo "<TH WIDTH=10%>Registro </TH>";
                echo "<TH>Código</TH>";
                echo "<TH>Autor</TH>";
                echo "<TH>Título</TH>";
                echo "<TH>BC</TH>";
                echo "<TH>Ingreso</TH>";
                echo "<TH>Fecha Ingreso</TH>";
                echo "<TH>Pie Imprenta</TH>";
                echo "<TH>Precio</TH>";
        echo "</TR>";

        for($i=0;$i<$rows;$i++){
		$num=$i+1;
                $res = pg_fetch_object($exec,$i);
		$registro=$res->registro;

                echo "<TR>";
		echo "<TD ALIGN=CENTER>$num</TD>";
		echo "<TD ALIGN=CENTER>$res->dilog</TD>";
                echo "<TD ALIGN=CENTER>$res->registro</TD>";
                echo "<TD ALIGN=CENTER>$res->codigo</TD>";
                echo "<TD ALIGN=LEFT>$res->autor</TD>";
                echo "<TD ALIGN=LEFT>$res->titulo</TD>";
                echo "<TD ALIGN=CENTER>$res->numbc</TD>";
                echo "<TD ALIGN=CENTER>$res->numingreso</TD>";
                echo "<TD ALIGN=LEFT>$res->fechaingreso</TD>";
                echo "<TD ALIGN=LEFT>$res->piedeimprenta</TD>";
                echo "<TD ALIGN=CENTER>$res->precio</TD>";
                echo "</TR>";

                }; //for

         echo "</TABLE>";
        echo "<BR>";
        echo "Se encontró ".$rows." libro(s) de Inventariados";
} else {
        echo "No se encontró ningún libro con esas especificaciones";
}
?>


</FORM>
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

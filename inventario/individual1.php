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
   document.inv.reg.focus();}
</script>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 

<? include("../Plantilla.rn");
        logo(); ?>
<FORM name=inv ACTION="individual1.php" METHOD="POST">

<?php
//$coneccion1 = pg_connect("","","","","Inventario");
include('../includes/connection1.php');
$sqlSelect="Select * from libroinv where registro=upper('$reg')";
$exec3 =pg_exec($coneccion1,$sqlSelect);
$rows3 = pg_numrows($exec3);

if ($rows3 > 0){
	echo "¡Error!. No se puede inventariar un mismo libro dos veces";
} else {

if ($anular == 'SI'){
	$sqlDelete="Delete from libroinv where registro=upper('$reg1')";
	$exec2 =pg_exec($coneccion1,$sqlDelete);
	echo "El Registro del Libro ".$reg1." fue anulado satisfactoriamente";
} else {

	if ($reg == ''){
			echo "DEBE INGRESAR VALORES EN LAS CAJAS DE TEXTO ANTES DE REALIZAR SU CONSULTA";
	} else {

		//primero: se verifica si el usuario realizo alguna seleccion
		//segundo: se verifica si ingreso algun criterio de busqueda


		$sql="select registro,codigo,autor,titulo,numbc,numingreso,fechaingreso,piedeimprenta,precio,prestado
			from libro where registro=upper('$reg')";

		//$coneccion = pg_connect("","","","","Biblio");
		include('../includes/connection.php');
		$exec =pg_exec($coneccion,$sql);
		$rows = pg_numrows($exec);

		if ($rows > 0) {
			$res = pg_fetch_object($exec,0);
			$registro = $res->registro;
			$codigo = $res->codigo;
			$autor = $res->autor;
			$titulo = $res->titulo;
			$numbc = $res->numbc;
		        $numingreso = $res->numingreso;
		        $fecha = $res->fechaingreso;
		        $pie = $res->piedeimprenta;
			$precio = $res->precio;
		        $prestado = $res->prestado;


			$posaut=strpos($autor,"'");
			if ($posaut > 0){
			$autor= substr_replace ($autor, ' ', $posaut, 1);
			}

                        $postit=strpos($titulo,"'");
                        if ($postit > 0){
			$titulo= substr_replace ($titulo, ' ', $postit, 1);
			}

                        $pospie=strpos($pie,"'");
                        if ($pospie > 0){
			$pie= substr_replace ($pie, ' ', $pospie, 1);
			}


			$sqlInsert="insert into  libroinv
			values ('$registro','$codigo','$autor','$titulo','$numbc','$numingreso','$fecha','$pie','$precio','$prestado','$PHP_AUTH_USER',now())";
			$exec1 =pg_exec($coneccion1,$sqlInsert);
			//echo $sqlInsert;
			//echo $prueba2;
		} else {
			echo "No se encontró ningún libro con esas especificaciones ó Acaba de anular el ultimo Ingreso de datos";
		}
	}
}
}


echo "<INPUT TYPE='HIDDEN' NAME='reg1' VALUE=$registro>";
echo "<P ALIGN=CENTER><FONT FACE='Nimbus Sans L' SIZE=5 STYLE='font-size: 20pt'><B>RESULTADO DE LIBROS POR INVENTARIO</B></FONT></P>";

echo "===========================================================================================================";

echo "<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>";

echo "<TR VALIGN=RIGHT>";
         echo "<TD ALIGN=CENTER COLSPAN=5><FONT STYLE='font-size: 16pt'> DATOS DEL LIBRO</FONT></TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
         echo "<TH WIDTH=15% ALIGN=RIGHT>Registro: </TH>";
         echo "<TD ALIGN=LEFT WIDTH=50%>$registro</TD>";
	 echo "<TH WIDTH=15%><FONT SIZE=2>Nuevo Registro</FONT></TH>";
         echo "<TD WIDTH=10%><INPUT TYPE=TEXT NAME='reg' SIZE=8></TD>";
         echo "<TD WIDTH=10%><INPUT TYPE=SUBMIT VALUE='Buscar'></TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
         echo "<TH ALIGN=RIGHT>C&oacute;digo : </TH>";
         echo "<TD VALIGN=LEFT COLSPAN=4>$codigo</TH>";
echo "</TR>";

echo "<TR VALIGN=LEFT>";
        echo "<TH ALIGN=RIGHT>Autor : </TH>";
        echo "<TD VALIGN=LEFT COLSPAN=4>$autor</TD>";
echo "</TR>";

echo "<TR VALIGN=LEFT>";
        echo "<TH ALIGN=RIGHT>T&iacute;tulo : </TH>";
        echo "<TD VALIGN=LEFT COLSPAN=4>$titulo</TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
         echo "<TH WIDTH=10% ALIGN=RIGHT>Nº BC: </TH>";
         echo "<TD VALIGN=LEFT COLSPAN=4>$numbc</TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
         echo "<TH ALIGN=RIGHT>Nº Ingreso: </TH>";
         echo "<TD VALIGN=LEFT COLSPAN=4>$numingreso</TH>";
echo "</TR>";

echo "<TR VALIGN=LEFT>";
        echo "<TH ALIGN=RIGHT>Ingreso : </TH>";
        echo "<TD VALIGN=LEFT COLSPAN=4>$fecha</TD>";
echo "</TR>";

echo "<TR VALIGN=LEFT>";
        echo "<TH ALIGN=RIGHT>Pie de Imprenta: </TH>";
        echo "<TD VALIGN=LEFT COLSPAN=4>$pie</TD>";
echo "</TR>";

echo "<TR VALIGN=LEFT>";
        echo "<TH ALIGN=RIGHT>Precio : </TH>";
        echo "<TD VALIGN=LEFT COLSPAN=4>$precio</TD>";
echo "</TR>";

echo "<TR VALIGN=LEFT>";
        echo "<TH ALIGN=RIGHT>Prestado : </TH>";
        echo "<TD VALIGN=LEFT COLSPAN=3>$prestado</TD>";
	echo "<TD><INPUT TYPE=CHECKBOX NAME='anular' VALUE='SI'><INPUT TYPE=SUBMIT VALUE='ANULAR'></TD>";
echo "</TR>";
echo "</TABLE>";
echo "===========================================================================================================";
echo "<BR>";
?>
</TABLE>
</FORM>
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>


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
	<?php include('../includes/head.php'); ?>
  <?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 

<?php
include("../Plantilla.rn");
        Logo();

//$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select registro, titulo, autor, fecha, duracion from video where activo='SI' order by registro asc";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

echo "<H1>Listado de videos</H1>";

if ($registro>0){
	echo "<table BORDER=1 BORDERCOLOR='#0058B0' CELLPADDING=3 CELLSPACING=0 WIDTH=100%>";
	echo "<thead>";
	echo "<tr>";
		echo "<th>Registro</th>";
		echo "<th>Título</th>";
		echo "<th>Autor</th>";
		echo "<th>Fecha de Emisión</th>";
		echo "<th>Duración</th>";
	echo "</tr>";
	echo "</thead>";

	for($i=0;$i<$registro;$i++){
		$resultado = pg_fetch_object($exec,$i);
		echo "<tbody>";
		echo "<tr>";

		$detalle=$resultado->registro;

		echo '<td><a href="detalle2.php?detalle='.$detalle.'">'.$resultado->registro.'</a></td>';
		echo "<td>$resultado->titulo</td>";
		echo "<td align='center'>$resultado->autor</td>";
		echo "<td align='center'>$resultado->fecha</td>";
                echo "<td>$resultado->duracion</td>";

		echo "</tr>";
		echo "<tbody>";
	};
	echo "</table>";

	echo "<BR><BR>";
	
}
else{
	echo "<BR><BR><BR><BR><BR><BR><BR><BR><H2> * * * No hay videos listados * * *</H2><BR><BR><BR><BR><BR><BR><BR><BR>";
} 

pie();
?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>



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
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 

<?php include("../Plantilla.rn");
        Logo();

$long=strlen($carne);
$longitud=strlen($nom);


if ($longitud>0){

 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select registro, codigo, autor, titulo, prestado, piedeimprenta  from libro where autor like upper('%$nom%') order by registro asc";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

 $sql1 = "select numero  from estadistica";
 $exec1 = pg_exec($coneccion,$sql1);
 $registro1 = pg_numrows($exec1);
 $att = $registro1 + 1;

 $sql2 = "insert into estadistica (numero, item, encont, fecha, lector, criterio) 
	  values ('$att', upper('$nom'), '$registro',now(), upper('$carne'),'AUTOR')";
 $exec2 = pg_exec($coneccion,$sql2);
 $registro2 = pg_numrows($exec2);

$cadena=strtoupper($nom);

echo "Si el resultado de su consulta no es satisfactoria, haga click <a href=\"javascript:history.back()\">Atrás
                                        </a> e intente nuevamente<BR>";

$mensaje='Se ha encontrado '.$registro.' libro(s) con la cadena <B>"'.$cadena.'"</B> incluida en el 
nombre del autor';

echo "<BR>".$mensaje."<BR><BR>";
if ($registro>0){
	echo "<table BORDER=1 BORDERCOLOR='#0058B0' CELLPADDING=3 CELLSPACING=0 WIDTH='70%'>";
	echo "<thead>";
	echo "<tr>";
                echo "<th align=center>Nº</th>";
		echo "<th>Registro</th>";
		echo "<th>Código</th>";
		echo "<th>Autor</th>";
                echo "<th>Edición</th>";
		echo "<th>Título</th>";
                echo "<th>Prestado</th>";
	echo "</tr>";
	echo "</thead>";

	for($i=0;$i<$registro;$i++){
		$resultado = pg_fetch_object($exec,$i);
		$p=$i+1;
		echo "<tbody>";
		echo "<tr>";

		$detalle=$resultado->registro;
		echo '<input type=hidden name=detalle value= $detalle>';
                echo "<td align=center>$p</td>";
		echo '<td><a href="detalle.php?detalle='.$detalle.'">'.$resultado->registro.'</a></td>';
		echo "<td>$resultado->codigo</td>";
		echo "<td>$resultado->autor</td>";
                echo "<td>$resultado->piedeimprenta</td>";
		echo "<td>$resultado->titulo</td>";
                echo "<td align='center'>$resultado->prestado</td>";
		echo "</tr>";
		echo "<tbody>";
	};
	echo "</table>";
	echo "<BR>".$mensaje."<BR>";
}

}else{

mensajeVacio();
exit;

}//if longitud
?>
</table>
<? pie() ?>

  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

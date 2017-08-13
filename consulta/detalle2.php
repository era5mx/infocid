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
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1-->
<?php include("../Plantilla.rn"); 
	Logo();
	
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select * from video WHERE registro = '$detalle'";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

echo "<a href=\"javascript:history.back()\">Volver a la Lista</a><BR><BR>";

$resultado = pg_fetch_object($exec,$i);

echo "<table BORDER='1' BORDERCOLOR='#0058B0' CELLPADDING=3 CELLSPACING=0 WIDTH='100%'>";

        echo "<tr>";
                echo "<th>Registro</th>";
                echo "<td>$resultado->registro</td>";
        echo "</tr>";

	echo "<tr>";
                echo "<th>Autor</th>";
                echo "<td>$resultado->autor</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Título</th>";
                echo "<td>$resultado->titulo</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Fecha de Emisión</th>";
                echo "<td>$resultado->fecha</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Duración</th>";
                echo "<td>$resultado->duracion</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Mesa</th>";
                echo "<td>$resultado->mesa</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Debate</th>";
                echo "<td>$resultado->debate</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Entrevista</th>";
                echo "<td>$resultado->entrevista</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Curso 1</th>";
                echo "<td>$resultado->curso1</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Curso 2</th>";
                echo "<td>$resultado->curso2</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Magazine</th>";
                echo "<td>$resultado->magazine</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Documental</th>";
                echo "<td>$resultado->documental</td>";
        echo "</tr>";

        echo "<tr>";
                echo "<th>Resumen</th>";
                echo "<td>$resultado->resumen</td>";
        echo "</tr>";

 echo "</table>";

 echo "<BR><BR>";
 pie();
?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>


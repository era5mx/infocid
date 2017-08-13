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
        logo();
echo "<BR>";
 $coneccion=pg_connect("","","","","Biblio");
 $sql1 = "select codigo from documento where  codigo like upper('$deta%')";
 $exec1 = pg_exec($coneccion,$sql1);
 $registro1 = pg_numrows($exec1);
 $sql = "select codigo, autor, titulo, pieimprenta, paginacion from documento where codigo like upper('$deta%') order by orden asc  limit 10 offset $val";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

$pag=ceil($registro1/10);
/* echo $registro1;
echo "<br>";
echo $pag; */
// $mensaje='Se ha encontrado '.$registro.' Libro(s) de un total de '.$registro1 ;

echo "<BR>".$mensaje."<BR><BR>";
if ($registro>0){
	echo "<table align=center BORDER=1 BORDERCOLOR='#0058B0' CELLPADDING=3 CELLSPACING=0 WIDTH=95%>";
	echo "<thead>";
	echo "<tr>";
		echo "<th>Código</th>";
		echo "<th>Autor</th>";
		echo "<th>Título</th>";
		echo "<th>Pie de Imprenta</th>";
		echo "<th>Páginas</th>";
	echo "</tr>";
	echo "</thead>";

	for($i=0;$i<$registro;$i++){
		$resultado = pg_fetch_object($exec,$i);
		echo "<tbody>";
		echo "<tr>";

		$detalle=$resultado->registro;
		echo "<td><a href='../consulta/detalledoc.php?detalle=$resultado->codigo'>$resultado->codigo</a></td>";
		echo "<td width=20%>$resultado->autor</td>";
		echo "<td>$resultado->titulo</td>";
		echo "<td>$resultado->pieimprenta</td>";
		echo "<td align=center>$resultado->paginacion</td>";
		echo "</tr>";
		echo "<tbody>";
	};
	echo "</table>";
//	echo "<BR>".$mensaje."<BR>";
echo "<table border=0 width=100%>";
echo " <tr><td align=right><a href=documentos.php>Volver al inicio</a></td></TR>";
echo " </table>";

echo "<table  BORDER=0 BORDERCOLOR='#0058B0'  CELLPADDING=3 CELLSPACING=0 align=center bordercolor>";
echo "<tr>";
	for ($i=0;$i<$pag;$i++){
	  $j=$i+1;
	  $p=$i*10;	
	  echo " <td><a href=muestradoc.php?deta=$deta&val=$p>$j</a></td>";
	  if($j==$pag){
	  } else {	
	  echo " <td><font color=#0000FF>|</font></td>"; }	 
	  }
echo "</tr>";
echo " </table>";
}

pie();

?>
</table>

  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

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
//Select para determinar la cantidad de registros
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $query=" select count(registro) from libro where registro like upper('$reg%')";
 $exe=pg_exec($coneccion,$query);
 $res=pg_fetch_object($exe,0);
 $num=$res->count;

//Proceso de Paginacion - Select con limit y offset
 $sql = "select registro, codigo, autor, titulo, prestado  from libro where registro like upper('$reg%') 
order by registro asc limit 50 offset $val";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

$pag=ceil($num/50); //Para determinar el numero de paginas
//echo $pag;
//echo $registro;
$mensaje='Se ha encontrado '.$num.' Libro(s).' ;

echo "<BR>".$mensaje."<BR><BR>";

//Proceso de Listado de Libros
if ($registro>0){
	echo "<table BORDER=1 BORDERCOLOR='#0058B0' CELLPADDING=3 CELLSPACING=0 WIDTH=100%>";
	echo "<thead>";
	echo "<tr>";
		echo "<th>Registro</th>";
		echo "<th>Código</th>";
		echo "<th>Autor</th>";
		echo "<th>Título</th>";
                echo "<th>Prestado</th>";
	echo "</tr>";
	echo "</thead>";

	for($i=0;$i<$registro;$i++){
		$resultado = pg_fetch_object($exec,$i);
		echo "<tbody>";
		echo "<tr>";

		$detalle=$resultado->registro;
		echo '<input type=hidden name=detalle value= $detalle>';
		echo '<td><a href="../consulta/detalle.php?detalle='.$detalle.'">'.$resultado->registro.'</a></td>';
		echo "<td>$resultado->codigo</td>";
		echo "<td>$resultado->autor</td>";
		echo "<td>$resultado->titulo</td>";
                echo "<td align='center'>$resultado->prestado</td>";
		echo "</tr>";
		echo "<tbody>";
	};
	echo "</table>";
//	echo "<BR>".$mensaje."<BR>";
// Paginacion - Creacion de los numeros y links a las siguientes paginas
// Variables para la paginacion - Se listaran registros de 50 en 50
$salt=$val+50;
$ret=$val-50;
$ult=($pag-1)*50;
 echo "<table  BORDER=0 BORDERCOLOR='#0058B0'  CELLPADDING=3 CELLSPACING=0 align=center>";
 echo "<TR>";
// Para los link Inicio y Anterior
 if ($val<>0){
 echo "<td align=left><a href=listalibro.php?reg=$reg&val=0><< Inicio </a><font color=#0000FF>|</font></td>";
 echo "<td align=left><a href=listalibro.php?reg=$reg&val=$ret><  Anterior </a><font 
color=#0000FF>|</font></td>";
 }
// Genera los numeros con los links las otras paginas

if ($pag>12){
$lim=$n+10;
 for ($i=$n;$i<$lim;$i++){
          $j=$i+1;
          $p=$i*50;
          $n=$i;
	 	
          echo " <td><a href=listalibro.php?reg=$reg&val=$p&n=$n>$j</a></td>";
          if($j==$pag){
	   exit;
	 }
	  if($j==$lim){
          } else {
          echo " <td><font color=#0000FF>|</font></td>"; }
          }

} else{
//$lim=$pag;
   for ($i=0;$i<$pag;$i++){
          $j=$i+1;
          $p=$i*50;
	  echo " <td><a href=listalibro.php?reg=$reg&val=$p>$j</a></td>";
          if($j==$pag){
          } else {
          echo " <td><font color=#0000FF>|</font></td>"; }
          }
}
// Para crear links a Siguiente y Ultimo
if($val<>$ult){
echo " <td align=right><font color=#0000FF>| </font><a href=listalibro.php?reg=$reg&val=$salt&n=$n>Siguiente ></a></td>";
echo " <td align=left><font color=#0000FF>| </font><a href=listalibro.php?reg=$reg&val=$ult>Último >></a></td>";
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

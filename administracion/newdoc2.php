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
<BR>
<FORM ACTION="newdoc.php">
<h1> Resultado </h1>
<?php
 $char2 = strlen($cod);
 $char3 = strlen($aut);
 $char4 = strlen($tit);
 $char5 = strlen($des);
 $char6 = strlen($res);
 $char7 = strlen($idi);
 $char8 = strlen($pie);
 $char10 = strlen($pag);
 // $char13 = strlen($fec);
 $char16 = strlen($obs);

 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 if($char2 == 0){
  echo "Falta llenar código del libro";
  }elseif($char2 > 15){
  echo "El código del libro solo tiene 12 cifras";
  }elseif ($char3 == 0) {
  echo "Falta llenar autor del libro";
  }elseif ($char4 == 0) {
  echo "Falta llenar título del libro";
  }elseif ($char5 == 0) {
  echo "Falta llenar descriptor del libro";
/*  }elseif ($char6 == 0) {
  echo "Falta llenar resumen del libro"; */
  }elseif ($char7 == 0) {
  echo "Falta llenar idioma del libro";
  }elseif ($char8 == 0) {
  echo "Falta llenar pie de pagina del libro";
  }elseif ($char10 == 0) {
  echo "Falta llenar numero de página del libro";
 /* }elseif ($char13 == 0) {
  echo "Falta llenar fecha de ingreso del libro";*/
  }else{

	if ($char16 == 0) {
		$obs='-';
	}

 $sql4="select * from documento where codigo = upper('$cod')";
 $exec4=pg_exec($coneccion,$sql4);
 $registro4 = pg_numrows($exec4);

$codi=$cod;
$fec=date('d/m/Y');
$desc=$des;
 if($registro4==0){
$query="select orden from documento order by orden desc";
$exe=pg_exec($coneccion,$query);
$reg=pg_fetch_object($exe,0);
$valor=$reg->orden;
$orden=$valor+1;
/* echo "valor= ".$valor;
echo "<br>";
echo "orden= ".$orden; */

$sql = "insert into documento (codigo, autor, titulo, descriptor, idioma, pieimprenta, paginacion, 
ingreso, observaciones, orden)
	 VALUES (upper('$codi'), upper('$aut'), upper('$tit'), upper('$desc'), upper('$idi'), upper('$pie'), upper('$pag'), upper('$fec'), upper('$obs'), $orden)";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec); 

 echo "Usted ha ingresado satisfactoriamente el libro:<br>";
        echo strtoupper($codi)."<br>";
        echo strtoupper($aut)."<br>";
        echo strtoupper($tit)."<br>";
        echo strtoupper($des)."<br>"; 
        // echo strtoupper($res)."<br>";
        echo strtoupper($idi)."<br>";
        echo strtoupper($pie)."<br>";
        echo strtoupper($pag)."<br>";
        echo strtoupper($fec)."<br>";
        echo strtoupper($obs)."<br><br>";
	// echo $orden; 
	echo "<table border=0>";
        echo "<tr><td>¿Desea registrar otro documento?<INPUT TYPE=SUBMIT VALUE='SI'></td></form>";
        echo "<td><form action='administracion.php'><INPUT TYPE=SUBMIT VALUE='NO'></td></tr>";
        echo "</form></table>";

}else
echo "Código duplicado ";
}
pie(); 
?>

  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

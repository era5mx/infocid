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
<FORM ACTION="libro1.php">
<h1> Resultado </h1>
<?php
 $char1 = strlen($reg);
 $char2 = strlen($cod);
 $char3 = strlen($aut);
 $char4 = strlen($tit);
 $char5 = strlen($des);
 $char6 = strlen($res);
 $char7 = strlen($idi);
 $char8 = strlen($pie);
 $char9 = strlen($isb);
 $char10 = strlen($pag);
 $char11 = strlen($edi);
 $char12 = strlen($pre);
 $char13 = strlen($fec);
 $char14 = strlen($nbc);
 $char15 = strlen($nui);
 $char16 = strlen($obs);

 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 if($char1 == 0){
  echo "Falta llenar registro del libro";
  }elseif($char1 > 6){
  echo "El registro no debe exceder de 6 dígitos";
  }elseif($char2 == 0){
  echo "Falta llenar código del libro";
  }elseif($char2 >20){
  echo "El código del libro solo tiene 12 cifras";
  }elseif ($char3 == 0) {
  echo "Falta llenar autor del libro";
  }elseif ($char4 == 0) {
  echo "Falta llenar título del libro";
  }elseif ($char5 == 0) {
  echo "Falta llenar descriptor del libro";
  }elseif ($char6 == 0) {
  echo "Falta llenar resumen del libro";
  }elseif ($char7 == 0) {
  echo "Falta llenar idioma del libro";
  }elseif ($char8 == 0) {
  echo "Falta llenar pie de página del libro";
  }elseif ($char9 == 0) {
  echo "Falta llenar isbn del libro";
  }elseif ($char10 == 0) {
  echo "Falta llenar número de página del libro";
  }elseif ($char11 == 0) {
  echo "Falta llenar precio del libro";
  }elseif($char11 > 16){
  echo "La edicion no debe exceder de 15 digitos";
  }elseif ($char12 == 0) {
  echo "Falta llenar edición del libro";
  }elseif ($char13 == 0) {
  echo "Falta llenar fecha de ingreso del libro";
  }elseif ($char14 == 0) {
  echo "Falta llenar numero de BC";
  }elseif ($char15 == 0) {
  echo "Falta llenar número de ingreso";
  }else{

	if ($char16 == 0) {
		$obs='-';
	}

 $sql3="select * from libro where registro = upper('$reg')";
 $exec3=pg_exec($coneccion,$sql3);
 $registro3 = pg_numrows($exec3);

 $sql4="select * from libro where codigo = upper('$cod')";
 $exec4=pg_exec($coneccion,$sql4);
 $registro4 = pg_numrows($exec4);

 if($registro3==0){
 if($registro4==0){
 $sql = "insert into libro (registro, codigo, autor, titulo, descriptor, resumen, idioma, piedeimprenta, isbn, numpag, precio, edicion,
 	fechaingreso, numbc, numingreso, obs, pieedito, pieano)
	 VALUES (upper('$reg'), upper('$cod'), upper('$aut'), upper('$tit'), upper('$des'), upper('$res'),
	 upper('$idi'), upper('$pie'), upper('$isb'), upper('$pag'), upper('$edi'), upper('$pre'), upper('$fec'), upper('$nbc'),
	 upper('$nui'), upper('$obs'), upper('$pieedito'), upper('$pieano'))";

 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

 echo "Usted ha ingresado satisfactoriamente el libro:<br>";
        echo strtoupper($reg)."<br>";
        echo strtoupper($cod)."<br>";
        echo strtoupper($aut)."<br>";
        echo strtoupper($tit)."<br>";
        echo strtoupper($des)."<br>";
        echo strtoupper($res)."<br>";
        echo strtoupper($idi)."<br>";
        echo strtoupper($pie)."<br>";
        echo strtoupper($isb)."<br>";
        echo strtoupper($pag)."<br>";
        echo strtoupper($pre)."<br>";
        echo strtoupper($fec)."<br>";
        echo strtoupper($nbc)."<br>";
        echo strtoupper($nui)."<br>";
        echo strtoupper($obs)."<br><br>";
	echo "<table border=0>";
        echo "<tr><td>¿Desea registrar otro libro?<INPUT TYPE=SUBMIT VALUE='SI'></td></form>";
        echo "<td><form action='administracion.php'><INPUT TYPE=SUBMIT VALUE='NO'></td></tr>";
        echo "</form></table>";

}else
echo "Código duplicado ";
}else
echo "Registro duplicado";
} 
pie();
?>

  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

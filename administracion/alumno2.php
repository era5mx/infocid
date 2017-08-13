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

<h1> Resultado </h1>
<?php
 $char1 = strlen($num);
 $char2 = strlen($nom);
 $char3 = strlen($app);
 $char4 = strlen($apm);
 $char5 = strlen($esp);
 $char6 = strlen($dir);
 $char7 = strlen($tel);
 $char8 = strlen($sex);
 $char9 = strlen($ie);
 $char10 = strlen($cic);
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 if ($char1 == 0) {
  echo "Falta llenar el código del estudiante";
  }elseif($char1 > 8){
  echo "El código del estudiante debe de ser de 8 digitos incluyendo la letra";
  }elseif($char2 == 0){
  echo "Falta llenar nombre del estudiante";
  }elseif ($char3 == 0) {
  echo "Falta llenar apellido paterno del estudiante";
  }elseif ($char4 == 0) {
  echo "Falta llenar apellido materno del estudiante";
  }elseif ($char5 == 0) {
  echo "Falta llenar especialidad del estudiante";
  }elseif ($char6 == 0) {
  echo "Falta llenar dirección del estudiante";
  }elseif ($char7 == 0) {
  echo "Falta llenar teléfono del estudiante";
  }elseif ($char8 == 0) {
  echo "Falta llenar sexo del estudiante";
  }elseif ($char9 == 0) {
  echo "Falta especificar la modalidad del estudiante";
  }elseif ($char10 == 0) {
  echo "Falta llenar nivel del estudiante";
  }else{
	//Verifica que el codigo del estudiante no sea repetido
 $sql3="select * from alumno where numcarnet = '$num'";
 $exec3=pg_exec($coneccion,$sql3);
 $registro3 = pg_numrows($exec3);

 if($registro3 == 0){
 	//crea el codigo del nuevo lector
	 $sql1= "select *  from lector";
	 $exec1 = pg_exec($coneccion,$sql1);
	 $registro1 = pg_numrows($exec1);
	 $att = $registro1 + 1;
	 $sql2 = "insert into lector(codlector,tipo) values('$att','A')";
	 $exec = pg_exec($coneccion,$sql2);

 $sql = "insert into alumno (numcarnet, nombre, apemat, apepat, especialidad,  ciclo, direccion, telefono, sexo, ie, codlector, activo)
	VALUES (upper('$num'), upper('$nom'), upper('$apm'), upper('$app'), upper('$esp'), '$cic', upper('$dir'),
	'$tel', upper('$sex'), upper('$ie'), $att, 'SI')";

 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

echo "Usted ha ingresado satisfactoriamente a:<br>";
        echo strtoupper($num)."<br>";
        echo strtoupper($nom)."<br>";
        echo strtoupper($app)."<br>";
        echo strtoupper($apm)."<br>";
        echo strtoupper($esp)."<br>";
        echo strtoupper($dir)."<br>";
        echo strtoupper($tel)."<br>";
        echo strtoupper($sex)."<br>";
        echo strtoupper($ie)."<br>";
        echo strtoupper($cic)."<br>";
	echo "<table border=0>";
	echo "<form action='alumno1.php' >";
	echo "<tr><td>¿Desea ingresar otro estudiante?<INPUT TYPE=SUBMIT VALUE='SI'></td></form>";
	echo "<td><form action='administracion.php'><INPUT TYPE=SUBMIT VALUE='NO'></td></tr>";
	echo "</form></table>";

}else
echo "Codigo duplicado";
}
?>
<BR><BR><BR>
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
<P><BR><BR>
</P>
</BODY>
</HTML>


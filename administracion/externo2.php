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

<h1> Resultado </h1>
<?php
 $char2 = strlen($nom);
 $char3 = strlen($app);
 $char4 = strlen($apm);
 $char5 = strlen($dir);
 $char6 = strlen($tel);
 $char7 = strlen($dni);
 $char8 = strlen($pro);
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 if ($char7 == 0) {
  echo "Falta llenar el DNI ";
  }elseif($char7 > 8){
  echo "El Nro de DNI debe de ser de 8 dígitos";
  }elseif($char2 == 0){
  echo "Falta llenar nombre ";
  }elseif ($char3 == 0) {
  echo "Falta llenar apellido paterno ";
  }elseif ($char4 == 0) {
  echo "Falta llenar apellido materno ";
  }elseif ($char5 == 0) {
  echo "Falta llenar dirección";
  }elseif ($char6 == 0) {
  echo "Falta llenar teléfono ";
  }elseif ($char8 == 0) {
  echo "Falta llenar procedencia del usuario externo";
  }else{

 $sql3="select * from externo where dni = '$dni'";
 $exec3=pg_exec($coneccion,$sql3);
 $registro3 = pg_numrows($exec3);

 if($registro3 == 0){
 //crea elcodigo para el nuevo lector
 $sql1= "select *  from lector";
 $exec1 = pg_exec($coneccion,$sql1);
 $registro1 = pg_numrows($exec1);

 $att = $registro1 + 1;

 $sql2 = "insert into lector(codlector,tipo) values('$att','X')";
 $exec = pg_exec($coneccion,$sql2);

 $sql = "insert into externo (dni, nombre, apemat, apepat, direccion, telefono,  sexo, procedencia, codlector, activo) 
VALUES (upper('$dni'), upper('$nom'), upper('$apm'), upper('$app'), upper('$dir'), '$tel', upper('$sex'), upper('$pro'), $att, 'SI')";

 $exec = pg_exec($coneccion,$sql);

echo "Usted ha ingresado satisfactoriamente a:<br>";
        echo "$dni <br>";
        echo "$nom <br>";
        echo "$app <br>";
        echo "$apm <br>";
        echo "$dir <br>";
        echo "$tel <br>";
        echo "$sex <br>";
        echo "$pro <br>";

 echo "<table border=0>";
 echo "<form action='externo1.php'>";
 echo "<tr><td>¿Desea ingresar otro usuario externo?<INPUT TYPE=SUBMIT 
VALUE='SI'></td></form>";
 echo "<td><form action='administracion.php'><INPUT TYPE=SUBMIT VALUE='NO'></td></tr>";
 echo "</form></table>";

}else
echo "Código duplicado";
}

pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

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
 $char1 = strlen($num);
 $char2 = strlen($nom);
 $char3 = strlen($app);
 $char4 = strlen($apm);
 $char5 = strlen($dep);
 $char6 = strlen($ane);
 $char7 = strlen($sex);
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');

 if ($char1 == 0) {
  	echo "Falta llenar el código";
  }elseif($char1 > 6){
  	echo "El código debe de ser de 6 dígitos incluyendo la letra";
  	}elseif($char2 == 0){
		echo "Falta llenar nombre";
	  	}elseif ($char3 == 0) {
	  		echo "Falta llenar apellido paterno";
		  	}elseif ($char4 == 0) {
				echo "Falta llenar apellido materno";
			  	}elseif ($char5 == 0) {
			  		echo "Falta llenar la dependencia";
				  	}elseif ($char6 == 0) {
				  		echo "Falta llenar el anexo";
				  		}elseif ($char7 == 0) {
					  		echo "Falta llenar sexo";
					  	}else{

 $sql3="select * from interno where numcarnet = '$num'";
 $exec3=pg_exec($coneccion,$sql3);
 $registro3 = pg_numrows($exec3);

 if($registro3==0){
 	//crea el codigo para el nuevo lector
	 $sql1= "select *  from lector";
	 $exec1 = pg_exec($coneccion,$sql1);
	 $registro1 = pg_numrows($exec1);
	 $att = $registro1 + 1;

	 $sql2 = "insert into lector(codlector,tipo) values('$att','I')";
	 $exec = pg_exec($coneccion,$sql2);
	 $apepate=trim($app);
	 $sql = "insert into interno (numcarnet, nombre, apemat, apepat, dependencia, anexo, sexo, codlector,activo) 
		VALUES (upper('$num'), upper('$nom'), upper('$apm'), upper('$apepate'), upper('$dep'), upper('$ane'),upper('$sex'),'$att','SI')";
	 $exec = pg_exec($coneccion,$sql);
	echo "Usted ha ingresado satisfactoriamente a:<br>";
        echo "$num <br>";
        echo "$nom <br>";
        echo "$app <br>";
        echo "$apm <br>";
        echo "$dep <br>";
        echo "$sex <br>";
	echo "<table border=0>";
	echo "<form action='interno1.php'>";
	echo "<tr><td>¿Desea ingresar otro usuario interno?<INPUT TYPE=SUBMIT VALUE='SI'></td></form>";
	echo "<td><form action='administracion.php'><INPUT TYPE=SUBMIT VALUE='NO'></td></tr>";
	echo "</form></table>";

}else{
echo "Código Duplicado";
}
}

pie();
?>
<!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

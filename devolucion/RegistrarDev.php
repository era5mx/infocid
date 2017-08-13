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
<?php
if(!isset($PHP_AUTH_USER)) {
        echo '<SCRIPT LANGUAJE="JavaScript">alert("Ud. No es un Usuario Registrado!!!")</SCRIPT>';
        exit;
} else {

 //$coneccion = pg_connect("","","","","Biblio");
  include('../includes/connection.php');

	//hallando si se trata de un video o de un libro
	$char = substr (strtoupper($numbd),0,1);

//echo $char;
//echo "<BR>";

//hallando el codigo de devolucion
 $sqlcount = "select * from devolucion";
 $execount = pg_exec($coneccion,$sqlcount);
 $nreg = pg_numrows($execount);
 $nreg=$nreg+1;
//echo $nreg;
//echo "<BR>";

//hallando el codigo de prestamo del libro
 $sql = "select codprest from detprest where registro=upper('$numbd') and devuelto='NO'";
 $exec = pg_exec($coneccion,$sql);
 $res = pg_fetch_object($exec,0);
 $codprest = $res->codprest;
//echo $codprest;
//echo "<BR>";

//hallando el codigo del lector
 $sql = "select codlector from regprest where codprest=$codprest";
 $exec = pg_exec($coneccion,$sql);
 $res = pg_fetch_object($exec,0);
 $codlector = $res->codlector;


//hallando el codigo de usuario
 $sqlcodusu = "select codusuario from usuario where login = '$PHP_AUTH_USER'";
 $execodusu = pg_exec($coneccion,$sqlcodusu);
 $codusu = pg_fetch_object($execodusu,0);
 $codigousu = $codusu->codusuario;
//echo $codigousu;


//ingresando el registro
 $sqlinsert = "insert into devolucion values($nreg,$codprest,$codigousu,now())";
// echo $sqlinsert;
// echo "<BR>";
 $exec = pg_exec($coneccion,$sqlinsert);


//hallando el codigo del detalle de devolucion
 $sqlcountdet = "select * from detdev";
 $execountdet = pg_exec($coneccion,$sqlcountdet);
 $nregdet = pg_numrows($execountdet);
 $nregdet = $nregdet + 1;
//echo $nregdet;


//ingresando el detalle
 $sqlinsertdet = "insert into detdev values($nregdet,$nreg,upper('$numbd'))";
// echo $sqlinsertdet;
 $exec = pg_exec($coneccion,$sqlinsertdet);


//actualizando el estado del prestamo
 $sqlupdate1 = "update detprest set devuelto='SI' where codprest = $codprest and registro = upper('$numbd')";
 $exec1 = pg_exec($coneccion,$sqlupdate1);


if ($char == 'V') {
	//actualizando el estado del video
	$sqlupdate = "update video set prestado='NO' where registro = upper('$numbd')";
} else {
	$sqlupdate = "update libro set prestado='NO' where registro = upper('$numbd')";
}

 $exec = pg_exec($coneccion,$sqlupdate);

//actualizando el nlibros del lector
 $sqlupdate2 = "update parametro set nlibros = nlibros - 1 where codlector = $codlector";
 $exec = pg_exec($coneccion,$sqlupdate2);


echo "<HTML>";
echo "<HEAD>";
echo "<TITLE>Página de Devoluciones</TITLE>";
echo "</HEAD>";

echo "<BODY  BACKGROUND='../images/bgInictel1.jpg'>";
echo "<FORM NAME='libro' ACTION='Devolucion.php'>";
echo "<TABLE WIDTH=100% BORDER=0>";

echo "<TR VALIGN=RIGHT>";
        echo "<TH> </TH>";
        echo "<TH>DEVOLUCIONES</TH>";
        echo "<TH> </TH>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
        echo "<TH> </TH>";
        echo "<TD>Su devolución ha sido registrada satisfactoriamente!!!</TD>";
        echo "<TD> </TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
        echo "<TH> </TH>";
        echo "<TD>Gracias por su preferencia</TD>";
        echo "<TD> </TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
        echo "<TH WIDTH=33%> </TH>";
        echo "<TH WIDTH=33%><INPUT TYPE=SUBMIT NAME='return' VALUE='Volver a Devolución'></TH>";
        echo "<TH WIDTH=33%> </TH>";
echo "</TR>";
echo "</TABLE>";
echo "</FORM>";
echo "<BR><BR><BR><BR><BR><BR>";
echo "</BODY>";
echo "</HTML>";

}

pie(); 

?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

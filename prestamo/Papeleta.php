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

	//$coneccion = pg_connect("","","","","Biblio");
	 include('../includes/connection.php');
	//echo $nreg;

	//hallando si se trata de un video o de un libro
	$char = substr (strtoupper($numbd),0,1);

	if ($nreg == 0 or $nreg == ''){
		//hallando el codigo del prestamo
		 $sqlcount = "select * from regprest";
		 $execount = pg_exec($coneccion,$sqlcount);
		 $nreg = pg_numrows($execount);
		 $nreg = $nreg+1;
		 $estPrest="true";
		//echo $nreg;
	}else{
		$estPrest="false";
	}	//if del nreg

	//hallando el tipo del codigo del lector
	$charIn = substr (strtoupper($numcn),0,1);
	$len=strlen($numcn);
	switch ($len) {
	case 5:
	case 6:
	if ($charIn == 'C' or $charIn == 'I' or $charIn == 'P') {
        	$sqlcodlec = "select codlector from interno where numcarnet = upper('$numcn')";
	        $tlec="interno"; //indica que el lector es personal interno
	}

	if ($charIn == 'E' or $charIn > 0) {
	        $sqlcodlec = "select codlector from alumno where numcarnet = upper('$numcn')";
        	$tlec="alumno"; //indica que el lector es alumno
	}

	 if ($charIn == 'X') {
                $sqlcodlec = "select codlector from externo where dni = upper('$numcn')";
                $tlec="externo"; //indica que el lector es usuario externo
        }
	break;
        case 8:
		 $sqlcodlec = "select codlector from externo where dni = upper('$numcn')";
                $tlec="externo"; //indica que el lector es usuario externo
	  break;
	}
	 $execodlec = pg_exec($coneccion,$sqlcodlec);
	 $codlec = pg_fetch_object($execodlec,0);
	 $codigolec = $codlec->codlector;
	//echo $codigolec;

	//hallando el codigo de usuario
	 $sqlcodusu = "select codusuario, login from usuario where login = '$PHP_AUTH_USER'";
	 $execodusu = pg_exec($coneccion,$sqlcodusu);
	 $codusu = pg_fetch_object($execodusu,0);
	 $codigousu = $codusu->codusuario;
	 $login = $codusu->login;

	//echo $codigousu;

	if ($estPrest == 'true'){
		//ingresando el registro
		 $sqlinsert = "insert into regprest values($nreg,$codigolec,$codigousu) ";
		 $exec = pg_exec($coneccion,$sqlinsert);
	 }

	//hallando el codigo del detalle del prestamo
	 $sqlcountdet = "select * from detprest";
	 $execountdet = pg_exec($coneccion,$sqlcountdet);
	 $nregdet = pg_numrows($execountdet);
	 $nregdet = $nregdet + 1;
	//echo $nregdet;

	//ingresando el detalle
	 $sqlinsertdet = "insert into detprest values($nregdet,$nreg,upper('$numbd'),'NO',now())";
	 $exec = pg_exec($coneccion,$sqlinsertdet);

	//hallando el numero de registro, en caso que sea el primer prestamo del lector en el sistema
	$sqlcount = "select * from parametro";
	 $execcount = pg_exec($coneccion,$sqlcount);
	 $rowscount = pg_numrows($execcount);
	 $rowscount = $rowscount + 1;

	//hallando el numero de materiales prestados
	 $sql1 = "select nlibros from parametro where codlector='$codigolec'";
	 $exec1 = pg_exec($coneccion,$sql1);
	 $rows1 = pg_numrows($exec1);

	 if ($rows1 > 0) {
	         //actualizando el registro
	         $sqlupdate = "update parametro set nlibros = nlibros + 1 where codlector='$codigolec'";
        	 $exec = pg_exec($coneccion,$sqlupdate);
	 } else {
        	 //ingresando el registro
	         $sqlinsert = "insert into parametro values($rowscount,$codigolec,1)";
        	 $exec = pg_exec($coneccion,$sqlinsert);
	 }


	if ($char == 'V') {
		 $sqlupdate = "update video set prestado='SI' where registro=upper('$numbd')";
		 $exec = pg_exec($coneccion,$sqlupdate);
	} else {
	//actualizando el estado del libro
	 	$sqlupdate = "update libro set prestado='SI' where registro=upper('$numbd')";
	 	$exec = pg_exec($coneccion,$sqlupdate);
	}

echo "<FORM NAME='libro' ACTION='Lector.php' METHOD='POST'>";
echo "<TABLE WIDTH=50% BORDER=0 align=center>";

echo "<TR>";
        echo "<TD VALIGN=BOTTOM COLSPAN=4 
ALIGN=CENTER>-----------------------------------------------------------------------------------------------</TD>";
echo "</TR>";

echo "<TR VALIGN=RIGHT>";
        echo "<TH COLSPAN=4>SOLICITUD DE LECTURA<INPUT TYPE=HIDDEN NAME='nreg' SIZE=8 VALUE='$nreg'></TH>";
//	echo "<TD ALIGN=RIGHT><B>R: $login</B></TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
	echo "<TD ALIGN=CENTER COLSPAN=2><B>DC-INFOCID</B></TD>";
	echo "<TD ALIGN=RIGHT COLSPAN=2><B>FECHA: ".date("d/m/Y")."</B></TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
        echo "<TH ALIGN=RIGHT WIDTH=10%>Nº BD: </TH>";
        echo "<TD WIDTH=10%>".strtoupper($numbd)."</TD>";
	echo "<TH ALIGN=RIGHT WIDTH=10%>Código: </TH>";
        echo "<TD>$codigo</TH>";
echo "</TR>";

echo "<TR VALIGN=LEFT>";
       echo "<TH ALIGN=RIGHT>Autor: </TH>";
        echo "<TD COLSPAN=3>$autor</TD>";
echo "</TR>";

echo "<TR VALIGN=LEFT>";
        echo "<TH ALIGN=RIGHT>Título: </TH>";
        echo "<TD COLSPAN=3>$titulo</TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
	echo "<TH ALIGN=RIGHT>Carne: </TH>";
	echo "<TD ALIGN=LEFT>".strtoupper($numcn)."<INPUT TYPE=HIDDEN NAME='numcn' value='$numcn'></TD>";
	echo "<TH ALIGN=RIGHT>Usuario: </TH>";
        echo "<TD>$nomape</TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
        echo "<TD COLSPAN=4 ALIGN=CENTER><BR></TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
        echo "<TD COLSPAN=4 ALIGN=LEFT><B>Registrado por: $login</B></TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
	echo "<TD COLSPAN=3></TD>";
        echo "<TD ALIGN=CENTER>--------------------------------</TD>";
echo "</TR>";

echo "<TR VALIGN=CENTER>";
	echo "<TD COLSPAN=3 ALIGN=LEFT><INPUT TYPE=SUBMIT NAME='return' VALUE='Otro Préstamo'></TD>";
        echo "<TD ALIGN=CENTER>FIRMA</TD>";
echo "</TR>";

echo "<TR>";
        echo "<TD VALIGN=TOP COLSPAN=4 
ALIGN=CENTER>-----------------------------------------------------------------------------------------------</TD>";
echo "</TR>";

/*
echo "<TR VALIGN=CENTER>";
        echo "<TH COLSPAN=2 ALIGN=RIGHT>¿El lector desea solicitar otro libro en Préstamo?</TH>";
	echo "<TD ALIGN=LEFT><INPUT TYPE=SUBMIT NAME='return' VALUE='SI'></TD>";
echo "</TR>";
*/

echo "</TABLE>";
echo "</FORM>";


pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

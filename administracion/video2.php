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
<h1> Confirmación </h1>
<?php

 function mensaje ($arg_1) {
 	echo '<SCRIPT LANGUAJE="JavaScript">alert("DEBE DIGITAR '.$arg_1.' ANTES DE REALIZAR SU INGRESO")</SCRIPT>';
        echo '<SCRIPT LANGUAJE="JavaScript">history.go(-1); return</SCRIPT>';
        exit;
 }


 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');

 if ($reg == '') {
  $arg_1="EL Nº DE REGISTRO";
  mensaje($arg_1);
  }

  if($tit == ''){
  $arg_1="EL TÍTULO";
  mensaje($arg_1);
  }

  if($aut == ''){
  $arg_1="EL NOMBRE DEL AUTOR";
  mensaje($arg_1);
  }

  if ($fec == '') {
  $arg_1="LA FECHA DE EMISIÓN";
  mensaje($arg_1);
  }

  if ($mesa == '') {
  $mesa = "-";
  }

  if ($deb == '') {
  $deb = "-";
  }

  if ($ent == '') {
  $ent = "-";
  }

  if ($cur1 == '') {
  $cur1 = "-";
  }

  if ($cur2 == '') {
  $cur2 = "-";
  }

  if ($mag == '') {
  $mag = "-";
  }

  if ($doc == '') {
  $doc = "-";
  }

  if ($dur == '') {
  $dur = "-";
  }

  if ($res == '') {
  $res = "-";
  }

  if ($obs == '') {
  $obs = "-";
  }

  if ($prest == '') {
  $prest = "-";
  }

 $sql = "insert into video (registro, titulo, autor, fecha, mesa, debate, entrevista, curso1, curso2, magazine, documental,
 	 duracion, resumen, prestado, operador, obs, activo)
	VALUES (upper('$reg'), upper('$tit'), upper('$aut'), upper('$fec'), upper('$mesa'), upper('$deb'), upper('$ent'),
	upper('$cur1'), upper('$cur2'), upper('$mag'), upper('$doc'), upper('$dur'), upper('$res'), upper('$prest'),
	upper('$PHP_AUTH_USER'),upper('$obs'), 'SI')";

 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

echo "Usted ha ingresado satisfactoriamente el registro:<br>";
        echo strtoupper($reg)."<br>";
        echo strtoupper($tit)."<br>";
        echo strtoupper($aut)."<br>";
        echo strtoupper($fec)."<br>";
        echo strtoupper($mesa)."<br>";
        echo strtoupper($deb)."<br>";
        echo strtoupper($ent)."<br>";
        echo strtoupper($cur1)."<br>";
        echo strtoupper($cur2)."<br>";
        echo strtoupper($mag)."<br>";
        echo strtoupper($doc)."<br>";
        echo strtoupper($dur)."<br>";
        echo strtoupper($res)."<br>";
        echo strtoupper($prest)."<br>";
        echo strtoupper($PHP_AUTH_USER)."<br>";
        echo strtoupper($obs)."<br><br>";

pie();
?>

<!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>


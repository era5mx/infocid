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
<P ALIGN=CENTER><FONT FACE="Nimbus Sans L" SIZE=5 STYLE="font-size: 20pt"><B>HISTORIAL DE LIBROS EN PRÉSTAMO</B></FONT></P>
<P ALIGN=CENTER><BR><BR></P>


<?php
//$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');

$sql="select codprest, codlector, codusuario from regprest";
$exec =pg_exec($coneccion,$sql);
$rows = pg_numrows($exec);


if ($rows > 0) {
	echo "Se encontró ".$rows." registro(s) de préstamo de libro(s)<BR>";
        echo "<BR>";
        echo "<BR>";
//	echo "====================";
        echo "<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=4>";

	echo "<TR>";
	        echo "<TD ALIGN=CENTER COLSPAN=4>===================================================================</TD>";
        echo "</TR>";

	for($i=0;$i<$rows;$i++){
                $res = pg_fetch_object($exec,$i);

                $codprest=$res->codprest;
                $codlector=$res->codlector;
                $codusuario=$res->codusuario;
                //$fechorprest=$res->fechorprest;

		$sql1="select tipo from lector where codlector = $codlector";
		$exec1 = pg_exec($coneccion,$sql1);
		$res1 = pg_fetch_object($exec1,0);
		$tipo=$res1->tipo;

		switch ($tipo) {
  		case 'A':
         		$tabla="alumno";
			$campos="select nombre, apepat, apemat, numcarnet from ";
         		break;
     		case 'E':
                        $tabla="alumno";
                        $campos="select nombre, apepat, apemat, numcarnet from ";
                        break;

                case 'X':
                        $tabla="externo";
                        $campos="select nombre, apepat, apemat, dni from ";
                        break;

		case 'P':
                        $tabla="interno";
                        $campos="select nombre, apepat, apemat, numcarnet from ";
                        break;

                case 'C':
                        $tabla="interno";
                        $campos="select nombre, apepat, apemat, numcarnet from ";
                        break;

     		case 'I':
         		$tabla="interno";
			$campos="select nombre, apepat, apemat, numcarnet from ";
         		break;
 		}

		$sql2 = $campos.$tabla." where codlector = $codlector";
//		echo $sql2;
		$exec2 = pg_exec($coneccion,$sql2);
		$res2 = pg_fetch_object($exec2,0);
		$nombre=$res2->nombre;
		$paterno=$res2->apepat;
		$materno=$res2->apemat;


		if ($tipo == 'X'){
			$cardni=$res2->dni;
		} else {
			$cardni=$res2->numcarnet;
		}


		$sql3 = "select identificacion from usuario where codusuario=$codusuario";
		$exec3 = pg_exec($coneccion,$sql3);
		$res3 = pg_fetch_object($exec3,0);
		$identificacion = $res3->identificacion;

		echo "<TR VALIGN=CENTER>";
        	        echo "<TH WIDTH=15% ALIGN=RIGHT>Registro Nº: </TH>";
                        echo "<TD COLSPAN=3>$codprest </TD>";
		echo "</TR>";

		echo "<TR VALIGN=CENTER>";
                        echo "<TH ALIGN=RIGHT>Lector: </TH>";
                        echo "<TD COLSPAN=3>Nº $codlector - $paterno $materno, $nombre - Carnet / DNI $cardni</TD>";
                echo "</TR>";

                echo "<TR VALIGN=CENTER>";
                        echo "<TH ALIGN=RIGHT>Usuario: </TH>";
                        echo "<TD COLSPAN=3>Nº $codusuario - $identificacion</TD>";
                echo "</TR>";


		//listando los detalles de cada registro
		$sql1="select registro, devuelto, fechorprest from detprest where codprest =$codprest ";
		$exec1 =pg_exec($coneccion,$sql1);
		$rows1 = pg_numrows($exec1);


		if ($rows1 > 0) {
			echo "<TR>";
		                echo "<TH COLSPAN=4>DETALLE :</TH>";
                        echo "</TR>";

                        echo "<TR>";
                                echo "<TH>Nº</TH>";
                                echo "<TH>Registro del Libro</TH>";
                                echo "<TH>Devuelto</TH>";
				echo "<TH>Fecha del Préstamo</TH>";
                        echo "</TR>";

			for($d=0;$d<$rows1;$d++){
		                $res1 = pg_fetch_object($exec1,$d);
				$nd=$d+1;
                		echo "<TR>";
			                echo "<TD ALIGN=CENTER>$nd</TD>";
			                echo "<TD ALIGN=CENTER>$res1->registro</TD>";
			                echo "<TD ALIGN=CENTER>$res1->devuelto</TD>";
					echo "<TD ALIGN=CENTER>$res1->fechorprest</TD>";
                                echo "</TR>";
			};	// for del detalle

			echo "<TR>";
                                echo "<TD ALIGN=CENTER 
				COLSPAN=4>===================================================================</TD>";
                        echo "</TR>";

		};	// if del detalle
	};	// for de la cabecera
	
	echo "</TABLE>";
	echo "<BR>";
        echo "<BR>";
} else {
	echo "No se ha registrado ningún préstamo aún.";
};	// if de la cabecera



echo "<BR>";
?>

<BR>
<BR>
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

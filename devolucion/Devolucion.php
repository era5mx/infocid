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
 $char = strlen($numbd);
//echo $char;

 if ($char == 6 or $char == 5) {
	 //$coneccion = pg_connect("","","","","Biblio");
	 include('../includes/connection.php');

	//hallando si se trata de un video o de un libro
	$char = substr (strtoupper($numbd),0,1);



	//hallando el codigo de prestamo del material en la tabla detalle prestamo
	 $sql = "select codprest, fechorprest from detprest where registro=upper('$numbd') and devuelto='NO'";
	 $exec = pg_exec($coneccion,$sql);
         $rows = pg_numrows($exec);

         if ($rows > 0) {
	 	 $res = pg_fetch_object($exec,0);
		 $codprest = $res->codprest;
		 $fechorprest = $res->fechorprest;
		//echo $codprest;


		//hallando el codigo del lector que figura en el prestamo
		 $sqlcodprest = "select codlector from regprest where codprest=$codprest";
		 $exec2 = pg_exec($coneccion,$sqlcodprest);
		 $res2 = pg_fetch_object($exec2,0);
		 $codlector = $res2->codlector;
		//echo $codlector;
		//echo $fechorprest;


		//hallando los datos del lector
		$charIn = substr (strtoupper($numcn),0,1);;
 
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
                        $tlec="externo"; //indica que el lector es usuario externo(a)
                }

		 $sqllec = "select numcarnet,nombre,apemat,apepat from alumno where codlector=$codlector";
		 $exec = pg_exec($coneccion,$sqllec);
		 $rows = pg_numrows($exec);
		 
		 if ($rows == 0) {
			$sqllec = "select numcarnet,nombre,apemat,apepat from interno where codlector=$codlector";
	                $exec = pg_exec($coneccion,$sqllec);
			$rows2 = pg_numrows($exec);
		} else {
			$rows2 = 0;
		}
		if($rows2==0 and $rows==0) {
		    $sqllec = "select dni,nombre,apemat,apepat from externo where codlector=$codlector";
                    $exec = pg_exec($coneccion,$sqllec); 
		    $user = 'ext';	
		}

		 if ($user == 'ext') {
		 $res = pg_fetch_object($exec,0);
		 $numcarnet = $res->dni;
		 $nombre = $res->nombre;
		 $apepat = $res->apepat;
		 $apemat = $res->apemat;
		} else {
		 $res = pg_fetch_object($exec,0);
                 $numcarnet = $res->numcarnet;
                 $nombre = $res->nombre;
                 $apepat = $res->apepat;
                 $apemat = $res->apemat;	
		}
	if ($char == 'V') {

		//hallando los datos del video
		 $sqlinfo = "select autor,titulo from video where registro=upper('$numbd')";
	} else {

		//hallando los datos del libro
		 $sqlinfo = "select codigo,autor,titulo from libro where registro=upper('$numbd')";

	}

		 $exec3 = pg_exec($coneccion,$sqlinfo);


		 $resinfo = pg_fetch_object($exec3,0);
		 $codigo = $resinfo->codigo;
		 $autor = $resinfo->autor;
		 $titulo = $resinfo->titulo;

                echo "<FORM NAME='Standard' ACTION='RegistrarDev.php' method='POST'>";
                echo "<TABLE WIDTH=100% BORDER=0>";

                echo "<TR VALIGN=RIGHT>";
                        echo "<TH> </TH>";
                        echo "<TH>DEVOLUCIONES</TH>";
                        echo "<TH> </TH>";
                echo "</TR>";

                echo "<TR VALIGN=CENTER>";
                        echo "<TD WIDTH=30% ALIGN=RIGHT><B>Número BD: </B></TD>";
                        echo "<TD VALIGN=LEFT>".strtoupper($numbd)."<INPUT TYPE=HIDDEN NAME='numbd' SIZE=8 VALUE ='$numbd'></TD>";
                        echo "<TD> </TD>";
                echo "</TR>";

                echo "<TR VALIGN=CENTER>";
                        echo "<TD ALIGN=RIGHT><B>Código: </B></TD>";
                        echo "<TD VALIGN=LEFT>$codigo</TH>";
                        echo "<TH> </TH>";
                echo "</TR>";

                echo "<TR VALIGN=LEFT>";
                        echo "<TD ALIGN=RIGHT><B>Autor: </B></TD>";
                        echo "<TD COLSPAN=2>$autor</TD>";
                echo "</TR>";

                echo "<TR VALIGN=LEFT>";
                        echo "<TD ALIGN=RIGHT><B>Título: </B></TH>";
                        echo "<TD COLSPAN=2>$titulo</TD>";
                echo "</TR>";

		echo "<TR VALIGN=CENTER>";
                        echo "<TH><BR></TH>";
                        echo "<TH></TH>";
                        echo "<TH></TH>";
                echo "</TR>";

                echo "<TR VALIGN=CENTER>";
                        echo "<TH></TH>";
                        echo "<TH>DATOS DEL LECTOR</TH>";
                        echo "<TH> </TH>";
                echo "</TR>";

                echo "<TR VALIGN=LEFT>";
                        echo "<TD ALIGN=RIGHT><B>Código: </B></TH>";
                        echo "<TD>$numcarnet</TD>";
                        echo "<TH></TH>";
                echo "</TR>";
 
                echo "<TR VALIGN=LEFT>";
                        echo "<TD ALIGN=RIGHT><B>Nombres y Apellidos: </B></TH>";
                        echo "<TD COLSPAN=2>$nombre, $apepat $apemat</TD>";
                echo "</TR>";
 
                echo "<TR VALIGN=LEFT>";
                        echo "<TD ALIGN=RIGHT><B>Fecha de Préstamo: </B></TH>";
                        echo "<TD COLSPAN=2>$fechorprest</TD>";
                echo "</TR>";
 
		echo "<TR VALIGN=CENTER>";
                        echo "<TH></TH>";
                        echo "<TH><INPUT TYPE=SUBMIT NAME='cmddevolver' VALUE='Devolver'></TH>";
                        echo "<TH> </TH>";
                echo "</TR>";
                echo "</TABLE>"; 
		echo "</FORM>";

	} else {

                echo "<FORM NAME='libro' ACTION='Devolucion.php'>";
		echo "<TABLE WIDTH=100% BORDER=0>";
 
                echo "<TR VALIGN=CENTER>";
                        echo "<TH> </TH>";
                        echo "<TH>DEVOLUCIONES</TH>";
                        echo "<TH> </TH>";
                echo "</TR>";
 
                echo "<TR VALIGN=CENTER>";
                        echo "<TH> </TH>";
                        echo "<TD ALIGN=CENTER>No existe ningún préstamo registrado con el código de ese Libro en la Base 
				de Datos, por favor haga click <A HREF=\"javascript:history.back()\">Atrás</A> y vuelva a 
				intentarlo</TD>";
                        echo "<TD> </TD>";
                echo "</TR>";
 
                echo "<TR VALIGN=CENTER>";
                        echo "<TH> </TH>";
                        echo "<TD WIDTH=33% ALIGN=CENTER></TH>";
                        echo "<TH> </TH>";
                echo "</TR>";
		echo "</TABLE>";
                echo "</FORM>";
         }
 
} else {
 
        echo "<FORM NAME='libro' ACTION='Devolucion.php'>";
	echo "<TABLE WIDTH=100% BORDER=0>";
 
        echo "<TR VALIGN=CENTER>";
                echo "<TH> </TH>";
                echo "<TH>DEVOLUCIONES</TH>";
                echo "<TH> </TH>";
        echo "</TR>";
 
        echo "<TR VALIGN=CENTER>";
                echo "<TH> </TH>";
                echo "<TD ALIGN=CENTER>Los datos que ingresó no son correctos, el código del Libro debe 
tener 7 
			caracteres, además el primer caracter debe ser una letra (A,I o L);  por favor haga click <A 
			HREF=\"javascript:history.back()\">Atrás</A> y vuelva a intentarlo</TD>";
                echo "<TD> </TD>";
        echo "</TR>";
 
        echo "<TR VALIGN=CENTER>";
                echo "<TH> </TH>";
                echo "<TD WIDTH=33% ALIGN=CENTER></TH>";
                echo "<TH> </TH>";
        echo "</TR>";
        echo "</TABLE>";
        echo "</FORM>";
}

		pie();
		echo "<!--end content -->"; 
		echo "</div></CENTER></BODY></HTML>";
		
?>


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

$char = strlen($numbd);
 //echo $char;
 if ($char == 5 or $char == 6) {
 	$charIn = substr (strtoupper($numbd),0,1);

	if ($charIn == 'V') {
		$tabla="video";
		$campos="autor,titulo,resumen,prestado ";
	} else {
		$tabla="libro";
		$campos="codigo,autor,titulo,resumen,prestado ";
	}

	$sql = "select ".$campos."from ".$tabla." where registro=upper('$numbd')";
	$exec =pg_exec($coneccion,$sql);
	$rows = pg_numrows($exec);

	if ($rows > 0) {
		$res = pg_fetch_object($exec,0);
		$prest = $res->prestado;
		//echo $prest;
		if ($prest == 'NO') {
			$codigo = $res->codigo;
			$autor = $res->autor;
			$titulo = $res->titulo;
			$resumen =$res->resumen;

			echo "<HTML>";

                        echo "<FORM NAME='libro' ACTION='Papeleta.php' METHOD='POST'>";
                        echo "<TABLE WIDTH=100% BORDER=0>";

                        echo "<TR VALIGN=RIGHT>";
                                echo "<TH COLSPAN=3>PRÉSTAMOS</TH>";
                        echo "</TR>";

                        echo "<TR VALIGN=CENTER>";
                                echo "<TH COLSPAN=3><INPUT TYPE=HIDDEN NAME='nreg' SIZE=8 VALUE='$nreg'></TH>";
                        echo "</TR>";

                        echo "<TR VALIGN=CENTER>";
                                echo "<TH ALIGN=RIGHT WIDTH=30%>Código: </TH>";
                                echo "<TD ALIGN=LEFT COLSPAN=2>".strtoupper($numcn)."<INPUT TYPE=HIDDEN NAME='numcn' SIZE=8 
				value='$numcn'></TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=LEFT>";
                                echo "<TH ALIGN=RIGHT>Nombres y Apellidos: </TH>";
                                echo "<TD COLSPAN=2>$nomape<INPUT TYPE=HIDDEN NAME='nomape' value='$nomape'></TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=LEFT>";
                                echo "<TH WIDTH=20% ALIGN=RIGHT>Dirección ó Dependencia: </TH>";
                                echo "<TD COLSPAN=2>$depdir</TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=LEFT>";
                                echo "<TH ALIGN=RIGHT>Teléfono ó Anexo: </TH>";
                                echo "<TD COLSPAN=2>$telanexo</TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=LEFT>";
	                        echo "<TH ALIGN=RIGHT>Sexo: </TH>";
        	                echo "<TD COLSPAN=2>$sexo</TD>";
                	echo "</TR>";

			echo "<TR VALIGN=CENTER>";
                                echo "<TH COLSPAN=3><BR></TH>";
  			echo "</TR>";


                        echo "<TR VALIGN=CENTER>";
                                echo "<TH COLSPAN=3>DATOS DEL LIBRO</TH>";
                        echo "</TR>";


                        echo "<TR VALIGN=CENTER>";
                                echo "<TH ALIGN=RIGHT>Número BD: </TH>";
                                echo "<TD COLSPAN=2>".strtoupper($numbd)."<INPUT TYPE=HIDDEN NAME='numbd' SIZE=8 VALUE='$numbd'></TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=CENTER>";
                                echo "<TH ALIGN=RIGHT>Código: </TH>";
                                echo "<TD COLSPAN=2>$codigo<INPUT TYPE=HIDDEN NAME='codigo' value='$codigo'></TH>";
                        echo "</TR>";

			echo "<TR VALIGN=LEFT>";
                                echo "<TH ALIGN=RIGHT>Autor: </TH>";
                                echo "<TD COLSPAN=2>$autor<INPUT TYPE=HIDDEN NAME='autor' value='$autor'></TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=LEFT>";
                                echo "<TH ALIGN=RIGHT>Título: </TH>";
                                echo "<TD COLSPAN=2>$titulo<INPUT TYPE=HIDDEN NAME='titulo' value='$titulo'></TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=LEFT>";
                                echo "<TH ALIGN=RIGHT>Resúmen: </TH>";
                                echo "<TD COLSPAN=2>$resumen</TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=CENTER>";
                                echo "<TH COLSPAN=3><BR></TH>";
                        echo "</TR>";

			echo "<TR VALIGN=CENTER>";
        	                        echo "<TH COLSPAN=3><INPUT TYPE=SUBMIT NAME='reg' VALUE='Registrar'></TH>";
  			echo "</TR>";

			echo "</TABLE>";
			echo "</FORM>";

		} else {

                        echo "<FORM NAME='libro' ACTION='Lector.php'>";
			echo "<TABLE WIDTH=100% BORDER=0>";
   			echo "<COL WIDTH=33*>";
                        echo "<COL WIDTH=33*>";
                        echo "<COL WIDTH=33*>";

			echo "<TR VALIGN=CENTER>";
                        	echo "<TH COLSPAN=3>PRÉSTAMOS</TH>";
                        echo "</TR>";

                        echo "<TR VALIGN= CENTER>";
                                echo "<TH COLSPAN=3>El libro esta prestado, haga click <a href=\"javascript:history.back()\">Atrás
					</a> e intente con otro libro</TH>";
                        echo "</TR>";

			echo "</TABLE>";
			echo "</FORM>";
		}
	 } else {

		echo "<FORM NAME='libro' ACTION='Prestamo.php'>";
                echo "<TABLE WIDTH=100% BORDER=0>";
                echo "<COL WIDTH=33*>";
                echo "<COL WIDTH=33*>";
                echo "<COL WIDTH=33*>";

                echo "<TR VALIGN=CENTER>";
                	echo "<TH COLSPAN=3>PRÉSTAMOS</TH>";
                echo "</TR>";

                echo "<TR VALIGN= CENTER>";
			echo "<TH COLSPAN=3>No existe ningún libro con ese código en la base de datos, por favor
				haga click en <a href=\"javascript:history.back()\">Atrás</a> y vuelva a intentarlo</TH>";
                echo "</TR>";

                echo "</FORM>";

        	echo "</BODY>";
        	echo "</HTML>";
	}
} else {

	echo "<HTML>";
        echo "<HEAD>";
        echo "<TITLE>Página de Préstamos</TITLE>";
        echo "</HEAD>";
        echo "<BODY BACKGROUND='../images/bgInictel1.jpg'>";

	echo "<FORM NAME='libro' ACTION='Prestamo.php'>";
        echo "<TABLE WIDTH=100% BORDER=0>";
        echo "<COL WIDTH=33*>";
        echo "<COL WIDTH=33*>";
        echo "<COL WIDTH=33*>";

        echo "<TR VALIGN=CENTER>";
                echo "<TH COLSPAN=3>PRÉSTAMOS</TH>";
        echo "</TR>";

        echo "<TR VALIGN= CENTER>";
                echo "<TH COLSPAN=3>El código del libro debe tener 6 caracteres y el primer caracter debe ser
		una letra (A00001); por favor haga click en <a href=\"javascript:history.back()\">Atrás</a> y vuelva a intentarlo</TH>";
        echo "</TR>";


        echo "</FORM>";

}

pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

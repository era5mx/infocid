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
* @PHP-Script  de Gesti�n de Usuarios basado en sesiones
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
<html><HEAD>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>
<BR>

<h1> Resultado </h1>
<FORM ACTION="editar2.php" METHOD="POST">
<?php
if ($reg <> ''){

//$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select *  from libro where registro = upper('$reg')";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

if ($registro == 0){
echo "<br>No se ha encontrado libro con ese c�digo.<br>";
echo "Por favor regrese e intentelo otra vez.";

} else {

$resultado = pg_fetch_object($exec,0);
echo "<INPUT TYPE='HIDDEN' NAME='reg1' VALUE =$reg>";
echo "<table WIDTH=100%  BORDER=1 BORDERCOLOR='#000000'>";
echo "<tr>";
echo "<td WIDTH=25%>REGISTRO</td>";
echo "<td colspan=2>".strtoupper($reg)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>C�DIGO</td>";
echo "<td colspan=2><INPUT TYPE=TEXT NAME='cod' VALUE = '$resultado->codigo'></td>";
echo "</tr>";

echo "<tr>";
echo "<td >AUTOR</td>";
echo "<td colspan=2><INPUT TYPE=TEXT SIZE=60 NAME='aut' VALUE = '$resultado->autor'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>T�TULO</td>";
echo "<td  colspan=2><INPUT TYPE=TEXT SIZE=60 NAME='tit' VALUE = '$resultado->titulo'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>TEMA</td>";
echo "<td colspan=2><TEXTAREA NAME='des' ROWS=5 COLS=60 WRAP='VIRTUAL'>$resultado->descriptor</TEXTAREA>";

// echo " <INPUT TYPE=TEXT SIZE=60 NAME='des' VALUE = '$resultado->descriptor'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>RESUMEN</td>";
echo "<td  colspan=2><TEXTAREA NAME='res' ROWS=20 COLS=60 WRAP='VIRTUAL'>$resultado->resumen</TEXTAREA></td>";
echo "</tr>";

echo "<tr>";
echo "<td>IDIOMA</td>";
echo "<td  colspan=2>	<select name='idi' size=1>";
			$idioma=$resultado->idioma;

			if ($idioma=='ES'){
				echo "<option value='ES' SELECTED>Espa�ol";
			} else {
				echo "<option value='ES'>Espa�ol";
			}
			
                        if ($idioma=='IN'){
                                echo "<option value='IN' SELECTED>Ingl�s";
                        } else {
                                echo "<option value='IN'>Ingl�s";
                        }
			
			if ($idioma=='FR'){
                                echo "<option value='FR' SELECTED>Franc�s";
                        } else {
                                echo "<option value='FR'>Franc�s";
                        }

			if ($idioma=='IT'){
                                echo "<option value='IT' SELECTED>Italiano";
                        } else {
                                echo "<option value='IT'>Italiano";
                        }

			 if ($idioma=='AL'){
                                echo "<option value='AL' SELECTED>Alem�n";
                        } else {
                                echo "<option value='AL'>Alem�n";
                        }

			 if ($idioma=='PO'){
                                echo "<option value='PO' SELECTED>Portugu�s";
                        } else {
                                echo "<option value='PO'>Portugu�s";
                        }
echo "            </select>";
echo "</tr>";

echo "<tr>";
echo "<td>PRESTADO</td>";
echo "<td  colspan=2>	<select name='pre' size=1>";
                        $prestado=$resultado->prestado;

                        if ($prestado=='SI'){
                                echo "<option value='SI' SELECTED>S�";
                        } else {
                                echo "<option value='SI'>S�";
                        }

                        if ($prestado=='NO'){
                                echo "<option value='NO' SELECTED>No";
                        } else {
                                echo "<option value='NO'>No";
                        }
echo "            </select>";
echo "</tr>";

echo "<tr>";
echo "<td>PIE DE IMPRENTA</td>";
echo "<td width=10%>LUGAR :<p>EDITORIAL :<p>A�O :</TD>";
echo "<td><INPUT TYPE=TEXT SIZE=40 NAME='pie' VALUE = '$resultado->piedeimprenta'>";
echo "<br>";
echo "<INPUT TYPE=TEXT SIZE=40 NAME='pieedito' VALUE = '$resultado->pieedito'>";
echo "<br>";
echo "<INPUT TYPE=TEXT SIZE=5 NAME='pieano' VALUE = '$resultado->pieano'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>ISBN</td>";
echo "<td  colspan=2><INPUT TYPE=TEXT SIZE=20 NAME='isb' VALUE = '$resultado->isbn'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>N�MERO DE P�GINAS</td>";
echo "<td  colspan=2><INPUT TYPE=TEXT SIZE=10 NAME='pag' VALUE = '$resultado->numpag'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>PRECIO</td>";
echo "<td  colspan=2><INPUT TYPE=TEXT SIZE=10 NAME='prec' VALUE = '$resultado->precio'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>EDICI�N</td>";
echo "<td  colspan=2><INPUT TYPE=TEXT SIZE=60 NAME='edi' VALUE = '$resultado->edicion'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>FECHA DE INGRESO</td>";
echo "<td  colspan=2><INPUT TYPE=TEXT SIZE=15 NAME='fec' VALUE = '$resultado->fechaingreso'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>N�MERO DE BC</td>";
echo "<td  colspan=2><INPUT TYPE=TEXT SIZE=30 NAME='num' VALUE = '$resultado->numbc'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>N�MERO DE INGRESO</td>";
echo "<td  colspan=2><INPUT TYPE=TEXT SIZE=30 NAME='ing' VALUE = '$resultado->numingreso'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>OBSERVACIONES</td>";
echo "<td  colspan=2><INPUT TYPE=TEXT SIZE=60 NAME='obs' VALUE = '$resultado->obs'></td>";
echo "</tr>";

echo "<tr>";
echo "<td colspan = 3><INPUT TYPE=SUBMIT NAME='Grabar' VALUE='Grabar'></td>";
echo "</tr>";
echo "</table>";
}//if de $registro

} else {
echo "No ingres� ning�n valor para completar la operaci�n, por favor haga click  <a href=\"javascript:history.back()\">Atr�s
                                        </a> e intente nuevamente<BR>";
}
?>
</FORM>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

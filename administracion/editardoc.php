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
<body TEXT="#0058B0" BACKGROUND="../images/bgInictel1.jpg">

<FORM ACTION="editardoc2.php" METHOD="POST">
<?php
if ($reg <> ''){

//$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select *  from documento where codigo = upper('$reg')";
 $exec = pg_exec($coneccion,$sql);
 $registro = pg_numrows($exec);

if ($registro == 0){
echo "<br>No se ha encontrado documentos con ese código.<br>";
echo "Por favor <a href=javascript:history.back()>regrese</a> e intentelo otra vez.";

} else {

$resultado = pg_fetch_object($exec,0);
echo "<INPUT TYPE='HIDDEN' NAME='reg1' VALUE = '$reg'>";
echo "<table WIDTH=100%  BORDER=1 BORDERCOLOR='#0058b0'>";

echo "<tr>";
echo "<td><b>CÓDIGO</td>";
echo "<td><INPUT TYPE=TEXT NAME='cod' VALUE = '$resultado->codigo'></td>";
echo "</tr>";

echo "<tr>";
echo "<td><b>AUTOR</td>";
echo "<td><INPUT TYPE=TEXT SIZE=60 NAME='aut' VALUE = '$resultado->autor'></td>";
echo "</tr>";

echo "<tr>";
echo "<td><b>TÍTULO</td>";
echo "<td><INPUT TYPE=TEXT SIZE=60 NAME='tit' VALUE = '$resultado->titulo'></td>";
echo "</tr>";

echo "<tr>";
echo "<td><b>TEMA</td>";
echo "<td><TEXTAREA NAME='des' ROWS=4 COLS=60 WRAP='VIRTUAL'>$resultado->descriptor</TEXTAREA></td>";
echo "</tr>";

/* echo "<tr>";
echo "<td>RESUMEN</td>";
echo "<td><TEXTAREA NAME='res' ROWS=20 COLS=60 WRAP='VIRTUAL'>$resultado->resumen</TEXTAREA></td>";
echo "</tr>"; */

echo "<tr>";
echo "<td><b>IDIOMA</td>";
echo "<td>	<select name='idi' size=1>";
			$idioma=$resultado->idioma;

			if ($idioma=='ES'){
				echo "<option value='ES' SELECTED>Español";
			} else {
				echo "<option value='ES'>Español";
			}

                        if ($idioma=='IN'){
                                echo "<option value='IN' SELECTED>Inglés";
                        } else {
                                echo "<option value='IN'>Inglés";
                        }

			if ($idioma=='FR'){
                                echo "<option value='FR' SELECTED>Francés";
                        } else {
                                echo "<option value='FR'>Francés";
                        }

			if ($idioma=='IT'){
                                echo "<option value='IT' SELECTED>Italiano";
                        } else {
                                echo "<option value='IT'>Italiano";
                        }

			 if ($idioma=='AL'){
                                echo "<option value='AL' SELECTED>Alemán";
                        } else {
                                echo "<option value='AL'>Aleman";
                        }

			 if ($idioma=='PO'){
                                echo "<option value='PO' SELECTED>Portugués";
                        } else {
                                echo "<option value='PO'>Portugues";
                        }
echo "            </select>";
echo "</tr>";

/* echo "<tr>";
echo "<td>PRESTADO</td>";
echo "<td>	<select name='pre' size=1>";
                        $prestado=$resultado->prestado;

                        if ($prestado=='SI'){
                                echo "<option value='SI' SELECTED>Sí";
                        } else {
                                echo "<option value='SI'>Sí";
                        }

                        if ($prestado=='NO'){
                                echo "<option value='NO' SELECTED>No";
                        } else {
                                echo "<option value='NO'>No";
                        }
echo "            </select>";
echo "</tr>";*/

echo "<tr>";
echo "<td><b>PIE DE IMPRENTA</td>";
echo "<td><INPUT TYPE=TEXT SIZE=60 NAME='pie' VALUE = '$resultado->pieimprenta'></td>";
echo "</tr>";
/*
echo "<tr>";
echo "<td>ISBN</td>";
echo "<td><INPUT TYPE=TEXT SIZE=20 NAME='isb' VALUE = '$resultado->isbn'></td>";
echo "</tr>";
*/
echo "<tr>";
echo "<td><b>NÚMERO DE PÁGINAS</td>";
echo "<td><INPUT TYPE=TEXT SIZE=10 NAME='pag' VALUE = '$resultado->paginacion'></td>";
echo "</tr>";
/*
echo "<tr>";
echo "<td>PRECIO</td>";
echo "<td><INPUT TYPE=TEXT SIZE=10 NAME='prec' VALUE = '$resultado->precio'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>EDICIÓN</td>";
echo "<td><INPUT TYPE=TEXT SIZE=60 NAME='edi' VALUE = '$resultado->edicion'></td>";
echo "</tr>";
*/
echo "<tr>";
echo "<td><b>FECHA DE INGRESO</td>";
echo "<td><INPUT TYPE=TEXT SIZE=15 NAME='fec' VALUE = '$resultado->ingreso'></td>";
echo "</tr>";
/*
echo "<tr>";
echo "<td>NÚMERO DE BC</td>";
echo "<td><INPUT TYPE=TEXT SIZE=30 NAME='num' VALUE = '$resultado->numbc'></td>";
echo "</tr>";

echo "<tr>";
echo "<td>NÚMERO DE INGRESO</td>";
echo "<td><INPUT TYPE=TEXT SIZE=30 NAME='ing' VALUE = '$resultado->numingreso'></td>";
echo "</tr>";
*/
echo "<tr>";
echo "<td><b>OBSERVACIONES</td>";
echo "<td><INPUT TYPE=TEXT SIZE=60 NAME='obs' VALUE = '$resultado->observaciones'></td>";
echo "</tr>";

echo "<tr>";
echo "<td colspan = 2 align=center><INPUT TYPE=SUBMIT NAME='Grabar' VALUE='Grabar'></td>";
echo "</tr>";
echo "</table>";
}//if de $registro

} else {
echo "No ingresó ningún valor para completar la operación, por favor haga click  <a href=\"javascript:history.back()\">Atrás
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

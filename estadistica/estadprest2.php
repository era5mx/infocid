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
<table WIDTH=100% BORDER=0 BORDERCOLOR="#000000">
        <TR>
            <TH><FONT size=6>Resultado de Prestamos</FONT></TH>
        </TR>
</table>
<br>
<?php 

if ($ano=='' and $mes=='' and $dia==''){
        echo "No ingresó datos suficientes para completar la operación";
        echo "Haga click en <A HREF=\"javascript:history.back()\">Atrás</A> e intentelo de nuevo";
} else {
 //$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');

 $mensaje1="Se ha(n) realizado <B>";
 $mensaje2="</B> prestamo(s) el ";

 if ($ano=='' and $mes==''){ //solo se ingreso el dia
      $sql1 = "select *  from vpresta where fechorprest like '%-$dia %' order by fechorprest desc";
  $sql = "select distinct codlector, codprest, codusuario from vpresta where fechorprest like '%-$dia%' order by codprest desc";
 
       $p=$dia;
        $mensaje3="día <B>".$p."</B><BR><BR>";
 }

 if ($ano=='' and $dia==''){ //solo se ingreso el mes
        $sql1 = "select *  from vpresta where fechorprest like '%-$mes-%' order by fechorprest desc";
 $sql = "select distinct codlector, codprest, codusuario from vpresta where fechorprest like '%-$mes-%' order by codprest desc";

        $mes=$mes+1;
        $p=date( "F",mktime(0,0,0,$mes,0,0));
	switch ($p) {
	case 'January':
		$p1='Enero';
		break;
	case 'February':
		$p1='Febrero';
		 break;
	case 'March':
                $p1='Marzo';
		 break;
        case 'April':
                $p1='Abril';
		 break;
	case 'May':
                $p1='Mayo';
		 break;
        case 'June':
                $p1='Junio';
		 break;
	case 'July':
                $p1='Julio';
		 break;
        case 'August':
                $p1='Agosto';
		 break;
	case 'September':
                $p1='Setiembre';
		 break;
        case 'October':
                $p1='Octubre';
		 break;
	case 'November':
                $p1='Noviembre';
		 break;
        case 'December':
                $p1='Diciembre';
		 break; }
        $mensaje3="mes de <B>".$p1."</B><BR><BR>";
 }

 if ($mes=='' and $dia==''){ //solo se ingreso el año
     $sql1 = "select *  from vpresta where fechorprest like '$ano-%' order by fechorprest desc";
  $sql = "select distinct codlector, codprest, codusuario from vpresta where fechorprest like '$ano-%' order by codprest desc";

	$p=$ano;
        $mensaje3="año <B>".$p."</B><BR><BR>";
 }
 if ($mes<>'' and $dia<>'' and $ano==''){ //se ingreso mes y dia
      $sql1 = "select *  from vpresta where fechorprest like '%-$mes-$dia %' order by fechorprest desc";
   $sql = "select distinct codlector, codprest, codusuario from vpresta where fechorprest like '%-$mes-$dia %' order by codprest desc";

	$mes=$mes+1;
        $p=date( "F",mktime(0,0,0,$mes,0,0));
	 switch ($p) {
        case 'January':
                $p1='Enero';
                break;
        case 'February':
                $p1='Febrero';
                 break;
        case 'March':
                $p1='Marzo';
                 break;
        case 'April':
                $p1='Abril';
                 break;
        case 'May':
                $p1='Mayo';
                 break;
        case 'June':
                $p1='Junio';
                 break;
        case 'July':
                $p1='Julio';
                 break;
        case 'August':
                $p1='Agosto';
                 break;
        case 'September':
                $p1='Setiembre';
                 break;
        case 'October':
                $p1='Octubre';
                 break;
        case 'November':
                $p1='Noviembre';
                 break;
        case 'December':
		 $p1='Diciembre';
                 break; }
        $mensaje3="día <B>".$dia."</B> del mes de <B>".$p1."</B><BR><BR>";
 }

 if ($ano<>'' and $dia<>'' and $mes==''){ //se ingreso año y dia
        $sql1 = "select *  from vpresta where fechorprest like '$ano-%-$dia %' order by fechorprest desc";
 $sql = "select distinct codlector, codprest, codusuario from vpresta where fechorprest like '$ano-%-$dia %' order by codprest desc";
        $mensaje3="día <B>".$dia."</B> del año <B>".$ano."</B><BR><BR>";
 }

 if ($ano<>'' and $mes<>'' and $dia==''){ //se ingreso año y mes
        $sql1 = "select *  from vpresta where fechorprest like '$ano-$mes-%' order by fechorprest desc";
    $sql = "select distinct codlector, codprest, codusuario from vpresta where fechorprest like '$ano-$mes-%' order by codprest desc";
        $mes=$mes+1;
        $p=date( "F",mktime(0,0,0,$mes,0,0));
	   switch ($p) {
        case 'January':
                $p1='Enero';
                break;
        case 'February':
                $p1='Febrero';
                 break;
        case 'March':
                $p1='Marzo';
                 break;
        case 'April':
                $p1='Abril';
                 break;
        case 'May':
                $p1='Mayo';
                 break;
        case 'June':
                $p1='Junio';
                 break;
        case 'July':
                $p1='Julio';
                 break;
        case 'August':
                $p1='Agosto';
                 break;
        case 'September':
                $p1='Setiembre';
                 break;
        case 'October':
                $p1='Octubre';
                 break;
        case 'November':
                $p1='Noviembre';
                 break;
        case 'December':
                 $p1='Diciembre';
                 break; }

        $mensaje3="mes de  <B>".$p1."</B> del año <B>".$ano."</B><BR><BR>";
 }

 if ($ano<>'' and $mes<>'' and $dia<>''){ //se ingreso año,mes y dia
        $fecha= $ano.'-'.$mes.'-'.$dia;
         $sql1 = "select  *  from vpresta where fechorprest like '$fecha%' order by fechorprest desc";
        $sql = "select distinct codlector, codprest, codusuario from vpresta where fechorprest like '$fecha%' order by codprest desc";
	$p=date( "l, d F Y",mktime(0,0,0,$mes,$dia,$ano));
        $mensaje3="día <B>".$p."</B><BR><BR>";
 }
 $exec = pg_exec($coneccion,$sql);
  $exec1 = pg_exec($coneccion,$sql1);
 $rows = pg_numrows($exec);
 $rows1 = pg_numrows($exec1);
 $mensaje=$mensaje1.$rows.$mensaje2.$mensaje3;

echo "Si el resultado de su consulta no es satisfactoria, haga click <a href=\"javascript:history.back()\">Atrás
                                        </a> e intente nuevamente<BR>";
echo $mensaje;
echo "Se ha(n) prestado <B>".$rows1." </B>libro(s)";
}
?>
<? if ($rows > 0) {
        echo "<TABLE align=center WIDTH=80% BORDER=0 CELLPADDING=0 CELLSPACING=4>";

        echo "<TR>";
    echo "<TD ALIGN=CENTER 
COLSPAN=4>==============================================================================================</TD>";
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
                        $campos="select nombre, apepat, apemat, numcarnet, sexo from ";
                        $tipalum="INICTEL";
			break;
                case 'E':
                        $tabla="alumno";
                        $campos="select nombre, apepat, apemat, numcarnet, sexo from ";
			$tipalum ="ESUTEL";
                        break;

                case 'X':
                        $tabla="externo";
                        $campos="select nombre, apepat, apemat, dni, sexo from ";
			$tipalum='EXTERNO';
                        break;

                case 'P':
                        $tabla="interno";
                        $campos="select nombre, apepat, apemat, numcarnet, sexo from ";
			$tipalum='INTERNO';
                        break;

                case 'C':
                        $tabla="interno";
                        $campos="select nombre, apepat, apemat, numcarnet, sexo from ";
                        $tipalum='INTERNO';
			break;

                case 'I':
                        $tabla="interno";
                        $campos="select nombre, apepat, apemat, numcarnet, sexo from ";
	                $tipalum='INTERNO';
			break;
                }

                $sql2 = $campos.$tabla." where codlector = $codlector";
//              echo $sql2;
                $exec2 = pg_exec($coneccion,$sql2);
                $res2 = pg_fetch_object($exec2,0);
                $nombre=$res2->nombre;
                $paterno=$res2->apepat;
                $materno=$res2->apemat;
		$sexo=$res2->sexo;

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
                        echo "<TH ALIGN=RIGHT>Sexo: </TH>";
                        echo "<TD width=8%> $sexo</TD>";
			echo "<th align=right width=8%>Lector : </th>";
			echo "<td>$tipalum<td>" ; 
                echo "</TR>";

                echo "<TR VALIGN=CENTER>";
                        echo "<TH ALIGN=RIGHT>Usuario: </TH>";
                        echo "<TD COLSPAN=3>Nº $codusuario - $identificacion</TD>";
                echo "</TR>";

		// listando los detalles de cada registro
                $sql8="select registro, devuelto, fechorprest from vpresta where codprest = $codprest";
                $exec8 =pg_exec($coneccion,$sql8);
                $rows8 = pg_numrows($exec8); 


    		 if ($rows8 > 0) {
                        echo "<TR>";
                                echo "<TH COLSPAN=4>DETALLE :</TH>";
                        echo "</TR>";

                        echo "<TR>";
                                echo "<TH>Nº</TH>";
                                echo "<TH>Registro del Libro</TH>";
                                echo "<TH>Devuelto</TH>";
                                echo "<TH>Fecha del Préstamo</TH>";
                        echo "</TR>";

                        for($d=0;$d<$rows8;$d++){
                                $res1 = pg_fetch_object($exec8,$d); 
                                $nd=$d+1;
                                echo "<TR>";
                                        echo "<TD ALIGN=CENTER>$nd</TD>";
                                        echo "<TD ALIGN=CENTER>$res1->registro</TD>";
                                        echo "<TD ALIGN=CENTER>$res1->devuelto</TD>";
                                        echo "<TD ALIGN=CENTER>$res1->fechorprest</TD>";
                                echo "</TR>";
                       };    //   for del detalle

                        echo "<TR>";
  echo "<TD ALIGN=CENTER 
COLSPAN=4>===============================================================================================</TD>";
                        echo "</TR>";

               };    //   if del detalle
        };      // for de la cabecera
  echo "</table>";
  echo "<BR>";
        echo "<BR>";
} else {
        echo "No se ha registrado ningún préstamo aún.";
};      // if de la cabecera



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

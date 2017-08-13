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
<script>
function sf(){
   document.estlib.limit.focus();}
</script>
	<?php include('../includes/head.php'); ?>
  <?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 

<? include("../Plantilla.rn");
        logo(); ?>
<P ALIGN=CENTER><FONT FACE="Nimbus Sans L" SIZE=5 STYLE="font-size: 20pt"><B>RANKING DE LOS LIBROS MÁS PEDIDOS</B></FONT></P>
<P ALIGN=CENTER><BR><BR></P>

<FORM name=estlib ACTION="estLibrosPrest.php" METHOD="POST">
	<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=4>
	<TR>
	<TD ALIGN=RIGHT WIDTH=70%>Ingrese la cantidad de libros que desea ver en el RANKING</TD>
	<TD WIDTH=5% ALIGN=CENTER><INPUT TYPE=TEXT NAME="limit" SIZE=3></TD>
	<TD ALIGN=LEFT><INPUT TYPE=SUBMIT NAME="verlec" VALUE="Visualizar"></TD>
	</TR>

        <TR>
<!--        <TD ALIGN=RIGHT WIDTH=70%>Si desea visualizar el RANKING mensual de Libros, ingrese el mes deseado</TD>
        <TD WIDTH=5% ALIGN=CENTER><INPUT TYPE=TEXT NAME="mes" SIZE=3></TD>
        <TD ALIGN=LEFT><INPUT TYPE=SUBMIT NAME="verlec" VALUE="Visualizar"></TD> -->
        </TR>


	</TABLE>
</FORM>


<?php
//$coneccion = pg_connect("","","","","Biblio");
include('../includes/connection.php');

//sql="select registro, count(registro) AS cantidad from detprest where fechorprest like '%-mes-%'

if ($limit==''){
	$sql="select registro, count(registro) AS cantidad from detprest group by registro order by cantidad desc LIMIT 3";
} else {


$limit = (integer) trim($limit);


	if ($limit > 0){
		$limit =  $limit+1;
		$sql="select registro, count(registro) AS cantidad from detprest group by registro order by cantidad desc LIMIT ".$limit;
	} else {
		echo '<SCRIPT LANGUAJE="JavaScript">alert("DEBE INGRESAR VALORES ENTEROS SOLAMENTE")</SCRIPT>';
	        echo '<SCRIPT LANGUAJE="JavaScript">history.go(-1); return</SCRIPT>';
        	exit;
	}
}

$exec =pg_exec($coneccion,$sql);
$rows = pg_numrows($exec);


if ($rows > 0) {
        echo "<BR>";
        echo "<BR>";
        echo "<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=4>";
	echo "<TR>";
	        echo "<TD ALIGN=CENTER  COLSPAN=5>===================================================================</TD>";
        echo "</TR>";

	echo "<TR>";
                echo "<TH>Lugar</TH>";
	        echo "<TH>Registro</TH>";
                //echo "<TH>Código</TH>";
                echo "<TH>Título</TH>";
		echo "<TH>Autor</TH>";
                echo "<TH>Préstamos</TH>";
        echo "</TR>";

	for($i=0;$i<$rows;$i++){
                $res = pg_fetch_object($exec,$i);

                $registro=$res->registro;
                $cantidad=$res->cantidad;

		$sql1="select codigo,titulo,autor from libro where registro= upper('$registro')";
		$exec1 = pg_exec($coneccion,$sql1);
		$rows1 = pg_numrows($exec1);


		if ($rows1 > 0) {

	                $res1 = pg_fetch_object($exec1,0);
			
			$lugar=$lugar+1;

               		echo "<TR>";
                                echo "<TD ALIGN=CENTER>$lugar º</TD>";
	                        echo "<TD ALIGN=CENTER>$registro</TD>";
                                //echo "<TD ALIGN=CENTER>$res1->codigo</TD>";
                                echo "<TD ALIGN=LEFT>$res1->titulo</TD>";
				echo "<TD ALIGN=LEFT>$res1->autor</TD>";
			        echo "<TD ALIGN=CENTER>$cantidad</TD>";
                        echo "</TR>";

		};	// if del detalle
	};	// for de la cabecera
	
	
	echo "<TR>";
	        echo "<TD ALIGN=CENTER  COLSPAN=5>===================================================================</TD>";
        echo "</TR>";

	echo "</TABLE>";
	echo "<BR>";
        echo "<BR>";
} else {
	echo "No se ha registrado ningun préstamo aún.";
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

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
<P ALIGN=CENTER><FONT FACE="Nimbus Sans L"><FONT SIZE=5 STYLE="font-size: 20pt"><B>RESULTADO DE LISTA GENERAL DE LIBROS POR 
INVENTARIO</B></FONT></FONT></P>
<P ALIGN=CENTER><BR><BR></P>


<?php
if ($chkAut<>'SI' and $chkTit<>'SI' and $chkDes<>'SI' and $chkPre<>'SI' and $chkFec<>'SI'){
	echo "DEBE MARCA AL MENOS UNA CASILLA PARA OBTENER RESULTADOS DE LA CONSULTA";
} else {
if ($aut=='' and $tit=='' and $des==''and $pre=='' and $dia=='' and $mes=='' and $ano==''){
		echo "DEBE INGRESAR VALORES ANTES DE REALIZAR SU CONSULTA";
} else {

$sql2=" from libro where ";

//primero: se verifica si el usuario realizo alguna seleccion
	//segundo: se verifica si ingreso algun criterio de busqueda

if ($chkAut=='SI'){
	if ($aut<>''){
		$sql2=$sql2."autor like upper('%$aut%') ";
	} else {
                $chkAut='NO';
        };	
};

//echo $chkAut;
//echo $OLtit;

if ($chkTit=='SI'){
        if ($tit<>''){
		if ($chkAut=='SI'){
			$sql2=$sql2.$OLtit." titulo like upper('%$tit%') ";
		} else {
			$sql2=$sql2." titulo like upper('%$tit%') ";
		};
        } else {
                $chkTit='NO';
        };
};

if ($chkDes=='SI'){
        if ($des<>''){
		if ($chkAut=='SI' or $chkTit=='SI'){
			$sql2=$sql2.$OLdes." descriptor like upper('%$des%') ";
                } else {
			$sql2=$sql2." descriptor like upper('%$des%') ";
                };
        } else {
                $chkDes='NO';
        };
};

if ($chkPre=='SI'){
        if ($pre<>""){
                if ($chkAut=='SI' or $chkTit=='SI' or $chkDes=='SI'){ 
                        $sql2=$sql2.$OLpre." prestado='$pre' ";
                } else {
                        $sql2=$sql2." prestado='$pre'  ";
                };
        } else {
                $chkPre='NO';
        };
};

//echo $dia;
if ($chkFec=='SI'){
        if ($dia<>''){
		//if ($dia < 10){
		//	$dia="0".$dia;
		//};

                if ($chkAut=='SI' or $chkTit=='SI' or $chkDes=='SI' or $chkPre=='SI'){
                        $sql2=$sql2.$OLdia." fechaingreso like '$dia-%' ";
                } else {
                        $sql2=$sql2." fechaingreso like '$dia-%' ";
                };
	};

	if ($mes<>''){
                if ($chkAut=='SI' or $chkTit=='SI' or $chkDes=='SI' or $chkPre=='SI' or $dia<>''){
                        $sql2=$sql2.$OLmes." fechaingreso like '%-$mes-%' ";
                } else {
                        $sql2=$sql2." fechaingreso like '%-$mes-%' ";
                };
	};

	if ($ano<>''){
                if ($chkAut=='SI' or $chkTit=='SI' or $chkDes=='SI' or $chkPre=='SI' or $dia<>'' or $mes<>''){
                        $sql2=$sql2.$OLano." fechaingreso like '%-$ano' ";
                } else {
                        $sql2=$sql2." fechaingreso like '%-$ano' ";
                };
        };

        if ($dia=='' and $mes=='' and $ano=='') {
                $chkFec='NO';
        };
};



$sql1="select registro,codigo,autor,titulo,numbc,numingreso,fechaingreso,piedeimprenta,precio,prestado";
$sql=$sql1.$sql2." order by registro";
//echo $dia;
//echo $sql;

//$coneccion = pg_connect("","","","","Biblio");
include('../includes/connection.php');
$exec =pg_exec($coneccion,$sql);
$rows = pg_numrows($exec);

} 
} 

if ($rows >0) {
        echo "Se encontró ".$rows." libro(s) con esa(s) especificacion(es)";
        echo "<BR>";
        echo "<BR>";
        echo "<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>";
        echo "<TR VALIGN=RIGHT>";
                echo "<TH COLSPAN=10>DATOS DEL LIBRO</TH>";
        echo "</TR>";

        echo "<TR VALIGN=CENTER>";
                echo "<TH WIDTH=10%>Registro: </TH>";
                echo "<TH>Código Libro</TH>";
                echo "<TH>Autor Libro</TH>";
                echo "<TH>Título Libro</TH>";
                echo "<TH>Nro BC</TH>";
                echo "<TH>Nro Ingreso</TH>";
                echo "<TH>Fecha Ingreso</TH>";
                echo "<TH>Pie Imprenta</TH>";
                echo "<TH>Precio Libro</TH>";
                echo "<TH>Prestado</TH>";
        echo "</TR>";

        for($i=0;$i<$rows;$i++){
                $res = pg_fetch_object($exec,$i);

                echo "<TR>";
                echo "<TD VALIGN=LEFT>$res->registro</TD>";
                echo "<TD VALIGN=LEFT>$res->codigo</TD>";
                echo "<TD VALIGN=LEFT>$res->autor</TD>";
                echo "<TD VALIGN=LEFT>$res->titulo</TD>";
                echo "<TD VALIGN=LEFT>$res->numbc</TD>";
                echo "<TD VALIGN=LEFT>$res->numingreso</TD>";
                echo "<TD VALIGN=LEFT>$res->fechaingreso</TD>";
                echo "<TD VALIGN=LEFT>$res->piedeimprenta</TD>";
                echo "<TD VALIGN=LEFT>$res->precio</TD>";
                echo "<TD VALIGN=LEFT>$res->prestado</TD>";
                echo "</TR>";
                };

        echo "</TABLE>";
        echo "<BR>";
        echo "Se encontró ".$rows." libro(s) con esa(s) especificacion(es)";
} else {
        echo "No se encontro ningún libro con esas especificaciones";
}
echo "<BR>";
echo "===========================================================================================================";
?>

<FORM ACTION="conjunta.php" METHOD="POST">
<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=0>
	<COL WIDTH=135*>
	<COL WIDTH=121*>
	
		<TR VALIGN=CENTER>
			<TD WIDTH=3%><INPUT TYPE=CHECKBOX NAME="chkAut" VALUE="SI"></TD>
                        <TH WIDTH=10%><FONT SIZE=2>Autor del Libro</FONT></TH>
                        <TD><INPUT TYPE=TEXT NAME="aut" SIZE=20></TD>
                        <TD WIDTH=40%><SELECT NAME="OLtit" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT></TD>
                </TR>
 
                <TR VALIGN=CENTER>
			<TD><INPUT TYPE=CHECKBOX NAME="chkTit" VALUE="SI"></TD>
                        <TH><FONT SIZE=2>Título del Libro</FONT></TH>
                        <TD><INPUT TYPE=TEXT NAME="tit" SIZE=20></TD>
			<TD><SELECT NAME="OLdes" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
				</SELECT>
                        </TD>
                </TR>		
		
		<TR VALIGN=CENTER>
                        <TD><INPUT TYPE=CHECKBOX NAME="chkDes" VALUE="SI"></TD>
                        <TH><FONT SIZE=2>Descriptor</FONT></TH>
                        <TD><INPUT TYPE=TEXT NAME="des" SIZE=20></TD>
			<TD><SELECT NAME="OLpre" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT>
                        </TD>
                </TR>	
		
		<TR VALIGN=CENTER>
                        <TD><INPUT TYPE=CHECKBOX NAME="chkPre" VALUE="SI"></TD>
                        <TH><FONT SIZE=2>Prestado</FONT></TH>
                        <TD><SELECT NAME="pre" SIZE=1>
				<OPTION VALUE="">
                                <OPTION VALUE="SI">Si
                                <OPTION VALUE="NO">No
                                </SELECT>
			</TD>
                        <TD><SELECT NAME="OLdia" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT>
                        </TD>
                </TR>

                <TR VALIGN=CENTER>
                        <TD><INPUT TYPE=CHECKBOX NAME="chkFec" VALUE="SI"></TD>
                        <TH><FONT SIZE=2>Fecha Ingreso</FONT></TH>
                        <TD><P>Día: <SELECT NAME="dia" SIZE=1>
			    	<OPTION VALUE="">
                                <OPTION VALUE="01">01
                                <OPTION VALUE="02">02
				<OPTION VALUE="03">03
                                <OPTION VALUE="04">04
                                <OPTION VALUE="05">05
				<OPTION VALUE="06">06
                                <OPTION VALUE="07">07
                                <OPTION VALUE="08">08
                                <OPTION VALUE="09">09
                                <OPTION VALUE="10">10
				<OPTION VALUE="11">11
                                <OPTION VALUE="12">12
                                <OPTION VALUE="13">13
                                <OPTION VALUE="14">14
                                <OPTION VALUE="15">15
                                <OPTION VALUE="16">16
                                <OPTION VALUE="17">17
                                <OPTION VALUE="18">18
                                <OPTION VALUE="19">19
                                <OPTION VALUE="20">20
				<OPTION VALUE="21">21
                                <OPTION VALUE="22">22
                                <OPTION VALUE="23">23
                                <OPTION VALUE="24">24
                                <OPTION VALUE="25">25
                                <OPTION VALUE="26">26
                                <OPTION VALUE="27">27
                                <OPTION VALUE="28">28
                                <OPTION VALUE="29">29
                                <OPTION VALUE="30">30
				<OPTION VALUE="31">31
                                </SELECT></P>
			   <P> Mes: <SELECT NAME="mes" SIZE=1>
                                <OPTION VALUE="">
                                <OPTION VALUE="ENE">Enero
                                <OPTION VALUE="FEB">Febrero
				<OPTION VALUE="MAR">Marzo
                                <OPTION VALUE="ABR">Abril
                                <OPTION VALUE="MAY">Mayo
                                <OPTION VALUE="JUN">Junio
                                <OPTION VALUE="JUL">Julio
                                <OPTION VALUE="AGO">Agosto
                                <OPTION VALUE="SEP">Septiembre
                                <OPTION VALUE="OCT">Octubre
                                <OPTION VALUE="NOV">Noviembre
                                <OPTION VALUE="DIC">Diciembre
                                </SELECT></P>
			   <P> Año: <SELECT NAME="ano" SIZE=1>
                                <OPTION VALUE="">
				
				<?php
                                 $an=getDate();
                                 $a=$an["year"]+1;

                                for ($i=1977;$i<$a;$i++){
					$aa=substr($i,2,2);
                                        if ($i==$ano){
                                        echo "<OPTION VALUE='$aa' SELECTED>$i";
                                        }else{  echo "<OPTION VALUE='$aa'>$i"; };
                                }; 
				?>
                                </SELECT></P>
			</TD>
                        <TD VALIGN=TOP><P><SELECT NAME="OLmes" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT></P>
			    <P><SELECT NAME="OLano" SIZE=1>
                                <OPTION VALUE="and">Y
                                <OPTION VALUE="or">O
                                </SELECT></P>
                        </TD>
                </TR>

		<TR VALIGN=BOTTOM>
			<TD><BR></TD>
			<TD><INPUT TYPE=SUBMIT VALUE="Buscar"></TD>
			<TD><BR></TD>
			<TD><BR></TD>
		</TR>
		
</TABLE>
<BR>
<BR>

</FORM>
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML><HEAD>InfoCID</HEAD>
<BODY BGCOLOR="#ffffff" TEXT="#283868" BACKGROUND="../images/bgInictel1.jpg">

<?php
include("../Plantilla.rn");
        Logo();

$long=strlen($carne);

if ($aut=='' and $tit=='' and $des==''){

	mensajeVacio();
	exit;

} else {

if ($carne==''){

        mensajeCarneVacio();
	exit;

} else {
        switch (strtoupper($carne)){
                case INVITADO:
                        break;
                case LARANDA:
                        break;
                case SBEJAR:
                        break;
                case RVILA:
                        break;
                case RESPINOZA:
                        break;
                case JTITTO:
                        break;
                case is_numeric($carne):
                        if ($long<>6){

                                mensajeCarneInvalido();
				exit;

                        }
                        break;
                default:
                                switch (strtoupper($carne[0])){
                                        case E:
                                                break;
                                        case I:
                                                break;
                                        case C:
                                                break;
                                        case P:
                                                break;
                                        default:

                                                mensajeUsuarioInvalido();
						exit;

                                }// switch ($carne[0])

                }// switch ($carne)
}// if $carne


$sql2=" from libro where ";

$sqlVideo=" from video where ";

	if ($aut<>''){
		$flag=1;
		$sqlAut="autor like upper('%$aut%') ";
		$critAut="AUTOR";

		$itemAut=strtoupper($aut);
		$mensajeAut=" ".' materia(les) con la cadena <B>"'.strtoupper($aut).'"</B> incluida en el nombre del autor';
        };

        if ($tit<>''){
		$flag=2;
		$sqlTit=" titulo like upper('%$tit%') ";
		$critTit="TITULO";

		$itemTit=strtoupper($tit);
		$mensajeTit=" ".' materia(les) con la cadena <B>"'.strtoupper($tit).'"</B> incluida en el título';
        };

        if ($des<>''){
		$flag=3;
		$sqlDes=" descriptor like upper('%$des%') ";
		$critTem="TEMA";

		$itemDes=strtoupper($des);
		$mensajeDes=" ".' materia(les) con la cadena <B>"'.strtoupper($des).'"</B> incluida en el resumen';
        };

        if ($aut<>'' and $tit<>'' and $des=='') {
		$flag=4;
			$sql2=$sql2.$sqlAut.$OLaut.$sqlTit;
			$sqlVideo=$sqlVideo.$sqlAut.$OLaut.$sqlTit;

			$criterio=$critAut." / ".$critTit;
			$item=$itemAut." / ".$itemTit;
			if ($OLaut=='and'){
				$separador="y";
			}else{
				$separador="ó";
			}
			$mensaje=$mensajeAut." ".$separador.$mensajeTit;
        };

        if ($aut<>'' and $des<>'' and $tit=='') {
		$flag=4;
			$sql2=$sql2.$sqlAut.$OLaut.$sqlDes;
			$criterio=$critAut." / ".$critTem;
			$item=$itemAut." / ".$itemDes;
                        if ($OLaut=='and'){
                                $separador="y";
                        }else{
                                $separador="ó";
                        }
                        $mensaje=$mensajeAut." ".$separador.$mensajeDes;
        };


        if ($tit<>'' and $des<>'' and $aut==''){
		$flag=4;
			$sql2=$sql2.$sqlTit.$OLtit.$sqlDes;
			$criterio=$critTit." / ".$critTem;
			$item=$itemTit." / ".$itemDes;
                        if ($OLtit=='and'){
                                $separador="y";
                        }else{
                                $separador="ó";
                        }
                        $mensaje=$mensajeTit." ".$separador.$mensajeDes;
        };

        if ($aut<>'' and $tit<>'' and $des<>'') {
		$flag=4;
			$sql2=$sql2.$sqlAut.$OLaut.$sqlTit.$OLtit.$sqlDes;
			$criterio=$critAut." / ".$critTit." / ".$critTem;
			$item=$itemAut." / ".$itemTit." / ".$itemDes;
			if ($OLaut=='and'){
				$separador="y";
			}else{
				$separador="ó";
			}

			if ($OLtit=='and'){
				$separador1="y";
			}else{
				$separador1="ó";
			}

			$mensaje=$mensajeAut." ".$separador.$mensajeTit." ".$separador1.$mensajeDes;
        };

$sql1="select registro, codigo, autor, titulo, prestado";

$sqlV="select registro, autor, titulo, prestado";

switch ($flag) {
     case 1://Solo Autor
         $sql=$sql1.$sql2.$sqlAut." order by registro";
	 $sqlF=$sqlV.$sqlVideo.$sqlAut." order by registro";
	 $mensaje=$mensajeAut;
	 $item = $itemAut;
	 $criterio=$critAut;
         break;

     case 2://Solo Titulo
         $sql=$sql1.$sql2.$sqlTit." order by registro";
	 $sqlF=$sqlV.$sqlVideo.$sqlTit." order by registro";
	 $mensaje=$mensajeTit;
	 $item = $itemTit;
         $criterio=$critTit;
         break;

     case 3://Solo descriptor
         $sql=$sql1.$sql2.$sqlDes." order by registro";
	 $mensaje=$mensajeDes;
	 $item = $itemDes;
         $criterio=$critTem;
         break;

     default:
         $sql=$sql1.$sql2." order by registro";
 }

//echo $sql."<BR>";

//$coneccion = pg_connect("","","","","Biblio");
include('../includes/connection.php');
$exec =pg_exec($coneccion,$sql);
$rows1 = pg_numrows($exec);

if (strlen($sqlF) > 46){
$exec0 =pg_exec($coneccion,$sqlF);
$rows2 = pg_numrows($exec0);
}

$rows = $rows1 + $rows2;

//if ($rows > 0) {
 $sql1 = "select numero  from estadistica";
 $exec1 = pg_exec($coneccion,$sql1);
 $registro1 = pg_numrows($exec1);
 $att = $registro1 + 1;

//echo $item;

 $sql2 = "insert into estadistica (numero, item, encont, fecha, lector, criterio)
	 values ('$att', '$item', '$rows', now(), upper('$carne'),'$criterio')";

 $exec2 = pg_exec($coneccion,$sql2);
 $registro2 = pg_numrows($exec2);
//}//del if $rows

}

$mensajeF='Se ha(n) encontrado '.$rows.$mensaje;

echo "Si el resultado de su consulta no es satisfactoria, haga click <a href=\"javascript:history.back()\">Atrás
                                        </a> e intente nuevamente<BR>";
echo "<BR>".$mensajeF."<BR><BR>";

if ($rows > 0) {
        echo "<TABLE BORDER=1 BORDERCOLOR='#0058B0' CELLPADDING=3 CELLSPACING=0 WIDTH=100%>";
        echo "<TR VALIGN=RIGHT>";
                echo "<TH COLSPAN=5>DATOS DEL LIBRO</TH>";
        echo "</TR>";

        echo "<TR VALIGN=CENTER>";
                echo "<TH WIDTH=10%>Registro</TH>";
                echo "<TH>Código</TH>";
                echo "<TH>Autor</TH>";
                echo "<TH>Título</TH>";
                echo "<TH>Prestado</TH>";
        echo "</TR>";

        for($i=0;$i<$rows1;$i++){
                $res = pg_fetch_object($exec,$i);

                echo "<TR>";

		$detalle=$res->registro;

                echo '<TD ALIGN=LEFT><A HREF="detalle.php?detalle='.$detalle.'">'.$res->registro.'</A></TD>';
                echo "<TD ALIGN=LEFT>$res->codigo</TD>";
                echo "<TD ALIGN=LEFT>$res->autor</TD>";
                echo "<TD ALIGN=LEFT>$res->titulo</TD>";
		echo "<TD ALIGN=CENTER>$res->prestado</TD>";         
	        echo "</TR>";
                };


        for($j=0;$j<$rows2;$j++){
                $res = pg_fetch_object($exec0,$j);

                echo "<TR>";

                $detalle=$res->registro;

                echo '<TD VALIGN=LEFT><A HREF="detalle2.php?detalle='.$detalle.'">'.$res->registro.'</A></TD>';
                echo "<TD VALIGN=LEFT>-</TD>";
                echo "<TD VALIGN=LEFT>$res->autor</TD>";
                echo "<TD VALIGN=LEFT>$res->titulo</TD>";
                echo "<TD VALIGN=CENTER>$res->prestado</TD>";
                echo "</TR>";
                };


        echo "</TABLE>";
        echo "<BR>".$mensajeF."<BR>";

}
pie();
?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

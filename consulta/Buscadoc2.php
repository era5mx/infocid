<?
/**
* @Infocid version 2.0  feb-2005
* @Copyright (C) 2005 SPHERA5, C.A. <sphera5@gmail.com>
**
* @Obra basada en el Programa Infocid
* @Copyright (C) 2003 CIDTEL <cidtel@inictel.gob.pe>
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML><HEAD>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1-->
<?php include("../Plantilla.rn"); 
	Logo();

if ($aut=='' and $tit=='' and $des==''){

	mensajeVacio();
	exit;

} else {

$sql2=" from documento where ";

	if ($aut<>''){
		$flag=1;
		$sqlAut="autor like upper('%$aut%') ";
		$critAut="AUTOR";

		$itemAut=strtoupper($aut);
		$mensajeAut=" ".' materia(les) con la cadena <B>"'.strtoupper($aut).'"</B> incluida en 
el nombre del autor';
        };

        if ($tit<>''){
		$flag=2;
		$sqlTit=" titulo like upper('%$tit%') ";
		$critTit="TITULO";

		$itemTit=strtoupper($tit);
		$mensajeTit=" ".' materia(les) con la cadena <B>"'.strtoupper($tit).'"</B> incluida en 
el t�tulo';
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
			$criterio=$critAut." / ".$critTit;
			$item=$itemAut." / ".$itemTit;
			if ($OLaut=='and'){
				$separador="y";
			}else{
				$separador="�";
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
                                $separador="�";
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
                                $separador="�";
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
				$separador="�";
			}

			if ($OLtit=='and'){
				$separador1="y";
			}else{
				$separador1="�";
			}

			$mensaje=$mensajeAut." ".$separador.$mensajeTit." ".$separador1.$mensajeDes;
        };

$sql1="select codigo, titulo, idioma, paginacion, ubicacion";

switch ($flag) {
     case 1://Solo Autor
         $sql=$sql1.$sql2.$sqlAut." order by orden";
	 $mensaje=$mensajeAut;
	 $item = $itemAut;
	 $criterio=$critAut;
         break;

     case 2://Solo Titulo
         $sql=$sql1.$sql2.$sqlTit." order by orden";
	 $mensaje=$mensajeTit;
	 $item = $itemTit;
         $criterio=$critTit;
         break;

     case 3://Solo descriptor
         $sql=$sql1.$sql2.$sqlDes." order by orden";
	 $mensaje=$mensajeDes;
	 $item = $itemDes;
         $criterio=$critTem;
         break;

     default:
         $sql=$sql1.$sql2." order by orden";
 }

//echo $sql."<BR>";

//$coneccion = pg_connect("","","","","Biblio");
include('../includes/connection.php');
$exec =pg_exec($coneccion,$sql);
$rows1 = pg_numrows($exec);

$mensajeF='Se ha(n) encontrado '.$rows1.$mensaje;

echo "Si el resultado de su consulta no es satisfactoria, haga click <a href=\"javascript:history.back()\">Atr�s </a> e intente nuevamente<BR>";
echo "<BR>".$mensajeF."<BR><BR>";

if ($rows1 > 0) {
        echo "<TABLE BORDER=1 BORDERCOLOR='#0058B0' CELLPADDING=3 CELLSPACING=0 WIDTH=100%>";
        echo "<TR VALIGN=RIGHT>";
                echo "<TH COLSPAN=5>DATOS DEL DOCUMENTO</TH>";
        echo "</TR>";

        echo "<TR VALIGN=CENTER>";
                // echo "<TH WIDTH=10%>Registro</TH>";
                echo "<TH>C�digo</TH>";
                echo "<TH>T�tulo</TH>";
                echo "<TH>Idioma</TH>";
                echo "<TH>Paginas</TH>";
		echo "<TH>Ubicaci�n F�sica</TH>";
        echo "</TR>";

        for($i=0;$i<$rows1;$i++){
                $res = pg_fetch_object($exec,$i);

                echo "<TR>";

		// $detalle=$res->registro;

                // echo '<TD ALIGN=LEFT><A HREF="detalle.php?detalle='.$detalle.'">'.$res->registro.'</A></TD>';
                echo "<TD ALIGN=LEFT>$res->codigo</TD>";
                echo "<TD ALIGN=LEFT>$res->titulo</TD>";
                echo "<TD ALIGN=LEFT>$res->idioma</TD>";
		echo "<TD ALIGN=CENTER>$res->paginacion</TD>";
		echo "<TD ALIGN=CENTER>$res->ubicacion</TD>";
	        echo "</TR>";
                }
        echo "</TABLE>";
        echo "<BR>".$mensajeF."<BR>";

}
}
 pie() ?>

  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

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
<?php
	include('../includes/head.php');
	include('../includes/menu.php');
	echo"<div id=\"pagecell1\">"; 
	echo"<!--pagecell1-->";
	include("../Plantilla.rn");
	logo();



 if($apepat<>""){
   switch ($usu) {
	case 'externo': $carne=dni; break;
        default : $carne=numcarnet; break; }
			
  //$coneccion = pg_connect("","","","","Biblio");
  include('../includes/connection.php');
  $sql="select * from $usu where apepat=upper('$apepat') and activo='SI'";
//  echo $sql;
  $exe=pg_exec($coneccion,$sql);
  $rows=pg_numrows($exe);
   if($rows == 0){
    
    echo ' <SCRIPT LANGUAGE="JavaScript">';
    echo ' alert("El usuario no existe vuelva a intentarlo");  ';
    echo ' history.back();  ';
    echo ' </SCRIPT> ';   
    	
   } 
   if($rows==1) {
     $numc = pg_fetch_object($exe,0);
     $numcn = $numc->$carne;	
     $char =  strlen($numcn);
     echo $carnet;
	
    }
   if($rows>1){

     echo "<table border=0 align=center cellspacing=7>";
     echo "<tr><th align=center>Se encontraron $rows usuarios con $apepat elija uno</th></tr>";
     echo "</table>";	
     echo "<FORM NAME=STANDARD ACTION='Lector.php'>";
     echo "<table ALIGN=CENTER border=1 bordercolor=#5A8EFF cellspacing=0 cellpadding=3>";
	
      for ($i=0;$i<$rows;$i++){
	 $numc = pg_fetch_object($exe,$i);
         $numcn = $numc->$carne;
	 $nombre=$numc->nombre;
    	 $apepat=$numc->apepat;
	 $apemat=$numc->apemat;
     echo "<TR>";
     echo "<TD><INPUT TYPE=radio NAME=numcn VALUE=$numcn> $nombre $apepat $apemat</TD>";	
     echo "</TR>";
 	}
     echo "<table border=0 align=center><TH align=center colspan=2><INPUT TYPE=SUBMIT VALUE=Enviar></TH></table>";
     echo "</table>";
     echo "</FORM>";


      exit;	
    }	
  }
  else {
 $char = strlen($numcn); 
}
//echo $nreg;
//echo $char;
 if ($char == 6 or $char == 5 or $char==8) {

      //$coneccion = pg_connect("","","","","Biblio");
      include('../includes/connection.php');

	$charIn = substr (strtoupper($numcn),0,1);

	// echo $charIn;

	$estado="RIGHT";
	switch ($char){
	case 5:
	case 6:
	  if ($charIn == 'C' or $charIn == 'I' or $charIn == 'P') {
		$sql = "select nombre,apemat,apepat,dependencia,anexo,codlector,sexo from interno where numcarnet=upper('$numcn')";
		$tlec="interno"; //indica que el lector es personal interno
		$dir=dependencia;
		$tel=anexo;
	  } else  {
            if ($charIn == 'E' or $charIn > 0) {
		        $sql = "select nombre,apemat,apepat,direccion,telefono,codlector,sexo from alumno where numcarnet=upper('$numcn')";
		        $tlec="alumno"; //indica que el lector es alumno
			 $dir=dirección;
	                 $tel=teléfono;	
	       }  else  {
		   if ($charIn == 'X') {
                        $sql = "select dni,nombre,apemat,apepat,direccion,telefono,codlector,sexo from externo where dni=upper('$numcn')";                       
 			$tlec="externo"; //indica que el lector es usuario externo 
                         $dir=dirección;
                         $tel=teléfono;
		}  else {
			$estado="WRONG";
		} 
		}
	}
	break;
	case 8:
		$sql = "select dni,nombre,apemat,apepat,direccion,telefono,codlector,sexo from externo where dni=upper('$numcn')";
  		$tlec="externo"; //indica que el lector es usuario externo 	
                $dir=direccion;
                $tel=telefono;
		
		break;
       }
	if ($estado=='RIGHT') {
		$exec = pg_exec($coneccion,$sql);
	        $rows = pg_numrows($exec);
	} else {
		$rows=0;
	}

         if ($rows > 0) {
                 $res = pg_fetch_object($exec,0);
                 $codlector = $res->codlector;

                 $sql1 = "select nlibros from parametro where codlector='$codlector'";
                 $exec1 = pg_exec($coneccion,$sql1);
                 $rows1 = pg_numrows($exec1);

                 if ($rows1 > 0) {
			$res1 = pg_fetch_object($exec1,0);
	                $nlibros = $res1->nlibros;

                        if ($nlibros > 2) { 
			  if ($tlec == 'interno'){
			    $nombre = $res->nombre;
                            $apepat = $res->apepat;
                            $apemat = $res->apemat;
                            $depdir = $res->dependencia;
                            $telanexo = $res->anexo;
                            $sexo = $res->sexo;

                           echo "<FORM NAME='libro' ACTION='PrestInt.php'>";
                           echo "<TABLE WIDTH=100% BORDER=0>";
                           echo "<TR VALIGN=RIGHT>";
                           echo "<TH COLSPAN=2>PRÉSTAMOS</TH>";
                           echo "</TR>";
                           echo "<TR VALIGN=CENTER>";
                           echo "<TH COLSPAN=2>El usuario interno no puede solicitar más libros, porque ya está en su límite de prestamos, si desea habilitar mas prestamos haga click en <B>Habilitar</b> </TH>";
                           echo "</TR>";
                           echo "<TR VALIGN=CENTER>";
	                   echo "<input type=hidden name=nombre value=$nombre >";
			   echo "<input type=hidden name=apepat value=$apepat >";
			   echo "<input type=hidden name=apemat value=$apemat >";
			   echo "<input type=hidden name=depdir value=$dependencia >";
			   echo "<input type=hidden name=telanexo value=$anexo >";
			   echo "<input type=hidden name=sexo value=$sexo >";
	           	   echo "<input type=hidden name=nlibros value=$nlibros >";
			   echo "<input type=hidden name=numcn value=$numcn >";
			   echo "<input type=hidden name=nreg value=$nreg >";
                           echo "<input type=hidden name=codlector value=$codlector >";
	  	 	   echo "<TH align=right width=50% ><INPUT TYPE=SUBMIT NAME='habilitar' VALUE='Habilitar'></TH>";
			   echo "<TH width=50% align=left><INPUT TYPE=button VALUE='Cancelar' onclick='javascript: history.back()'></TH>";
			   echo	 "</TR>";
                                echo "</TABLE>";
                                echo "</FORM>";


			}else{

                     		echo "<FORM NAME='libro' ACTION='Prestamo.php'>";
	                        echo "<TABLE WIDTH=100% BORDER=0>";

        	                echo "<TR VALIGN=RIGHT>";
                	                echo "<TH COLSPAN=2>PRÉSTAMOS</TH>";
	                        echo "</TR>";

	                        echo "<TR VALIGN=CENTER>";
        	                        echo "<TH COLSPAN=2>El lector No puede solicitar más libros prestados, porque ya está
						en su límite de tres libros por lector, si desea ingresar otro lector haga click
						en <B>Nuevo Lector</b> y vuelva a intentarlo</TH>";
	                        echo "</TR>";

	                        echo "<TR VALIGN=CENTER>";
                                echo "<TH width=50%><INPUT TYPE=SUBMIT NAME='atras' VALUE='Nuevo Lector'></TH>";
 				echo "</TR>";
        	                echo "</TABLE>";
				echo "</FORM>";

                        }  } else { 
					 $nombre = $res->nombre;
	                                 $apepat = $res->apepat;
        	                         $apemat = $res->apemat;
                	                 $depdir = $res->$dir;
                        	         $telanexo = $res->$tel;
                                	 $sexo = $res->sexo;
				
                                echo "<FORM NAME='libro' ACTION='Prestamo.php' METHOD=post>";
                                echo "<TABLE WIDTH=100% BORDER=0>";
				echo "<TR><TD><BR></TD></TR>";	
                                echo "<TR VALIGN=RIGHT>";
                                        echo "<TH COLSPAN=3>El lector tiene actualmente $nlibros Libro(s) prestado(s)</TH>";
                                echo "</TR>";

                                echo "<TR VALIGN=RIGHT>";
                                        echo "<TH COLSPAN=3>PRÉSTAMOS</TH>";
                                echo "</TR>";

	                        echo "<TR VALIGN=CENTER>";
        	                        echo "<TH COLSPAN=3><INPUT TYPE=HIDDEN NAME='nreg' SIZE=8 VALUE='$nreg'></TH>";
	                        echo "</TR>";

        	                echo "<TR VALIGN=CENTER>";
                	                echo "<TH ALIGN=RIGHT WIDTH=30%>Código: </TH>";
                        	        echo "<TH ALIGN=LEFT COLSPAN=2>".strtoupper($numcn)."<INPUT TYPE=HIDDEN NAME='numcn' SIZE=8 
					value='$numcn'></TH>";
	                        echo "</TR>";

	                        echo "<TR VALIGN=LEFT>";
        	                        echo "<TH ALIGN=RIGHT WIDTH=20%>Nombres y Apellidos: </TH>";
                	                echo "<TD COLSPAN=2>$nombre, $apepat $apemat<INPUT TYPE=HIDDEN NAME='nomape' SIZE=8 
					value='$nombre, $apepat $apemat'></TD>";
                        	echo "</TR>";

                                echo "<TR VALIGN=LEFT>";
                                        echo "<TH ALIGN=RIGHT>Dependencia: </TH>";
                                        echo "<TD COLSPAN=2>$depdir<INPUT TYPE=HIDDEN NAME='depdir' SIZE=8 value='$depdir'></TD>";
                                echo "</TR>";

                                echo "<TR VALIGN=LEFT>";
                                        echo "<TH ALIGN=RIGHT>Teléfono/Anexo: </TH>";
                                        echo "<TD COLSPAN=2>$telanexo<INPUT TYPE=HIDDEN NAME='telanexo' SIZE=8 value='$telanexo'></TD>";
                                echo "</TR>";

                                echo "<TR VALIGN=LEFT>";
                                        echo "<TH ALIGN=RIGHT>Sexo: </TH>";
                                        echo "<TD COLSPAN=2>$sexo<INPUT TYPE=HIDDEN NAME='sexo' SIZE=8 value='$sexo'></TD>";
                                echo "</TR>";

				echo "<TR VALIGN=CENTER>";
                	                echo "<TH COLSPAN=3>DATOS DEL LIBRO</TH>";
	                        echo "</TR>";

				echo "<TR VALIGN=TOP>";
                			echo "<TH ALIGN=RIGHT>Número BD:</TH>";
                			echo "<TD ALIGN=CENTER><INPUT TYPE=TEXT NAME='numbd' SIZE=8></TD>";
                			echo "<TD ALIGN=LEFT><INPUT TYPE=SUBMIT NAME='verlib' VALUE='Visualizar'></TD>";
        			echo "</TR>";

                                echo "</TABLE>";
				echo "</FORM>";
				if ($nlibros>0){
				include("funciones.php");
				 prestamos($codlector);
				}
                         } } else {
                                         $nombre = $res->nombre;
                                         $apepat = $res->apepat;
                                         $apemat = $res->apemat;
                                         $depdir = $res->$dir;
                                         $telanexo = $res->$tel;
                                         $sexo= $res->sexo;

                        echo "<FORM NAME='libro' ACTION='Prestamo.php' METHOD=post>";
                        echo "<TABLE WIDTH=100% BORDER=0>";

                        echo "<TR VALIGN=RIGHT>";
                        	echo "<TH COLSPAN=3>!!! Bienvenido Lector al Centro de Información y Documentación de
					Telecomunicaciones !!!</TH>";
                        echo "</TR>";

                        echo "<TR VALIGN=RIGHT>";
                                echo "<TH COLSPAN=3><BR></TH>";
                        echo "</TR>";

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
                                echo "<TD COLSPAN=2>$nombre, $apepat $apemat<INPUT TYPE=HIDDEN NAME='nomape' SIZE=8 value='$nombre, $apepat $apemat'></TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=LEFT>";
                                echo "<TH WIDTH=20% ALIGN=RIGHT>Dirección ó Dependencia: </TH>";
                                echo "<TD COLSPAN=2>$depdir<INPUT TYPE=HIDDEN NAME='depdir' SIZE=8 value='$depdir'></TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=LEFT>";
                                echo "<TH ALIGN=RIGHT>Teléfono ó Anexo: </TH>";
                                echo "<TD COLSPAN=2>$telanexo<INPUT TYPE=HIDDEN NAME='telanexo' SIZE=8 value='$telanexo'></TD>";
                        echo "</TR>";

                        echo "<TR VALIGN=LEFT>";
	                        echo "<TH ALIGN=RIGHT>Sexo: </TH>";
        	                echo "<TD COLSPAN=2>$sexo<INPUT TYPE=HIDDEN NAME='sexo' SIZE=8 value='$sexo'></TD>";
                	echo "</TR>";

			echo "<TR VALIGN=CENTER>";
                                echo "<TH COLSPAN=3><BR></TH>";
  			echo "</TR>";

			echo "<TR VALIGN=CENTER>";
                                echo "<TH COLSPAN=3>DATOS DEL LIBRO</TH>";
  			echo "</TR>";

			echo "<TR VALIGN=CENTER>";
                        	echo "<TH ALIGN=RIGHT>Número BD: </TH>";
                        	echo "<TD VALIGN=LEFT><INPUT TYPE=TEXT NAME='numbd' SIZE=8></TD>";
				echo "<TD ALIGN=LEFT><INPUT TYPE=SUBMIT NAME='verlib' VALUE='Visualizar'></TD>";
                	echo "</TR>";


                        echo "</TABLE>";
                        echo "</FORM>";

		 }

         } else {

                echo "<FORM NAME='libro' ACTION='Prestamo.php'>";
                echo "<TABLE WIDTH=100% BORDER=0>";

                echo "<TR VALIGN=RIGHT>";
                        echo "<TH COLSPAN=3>PRÉSTAMOS</TH>";
                echo "</TR>";


                echo "<TR VALIGN=CENTER>";
                        echo "<TH COLSPAN=3>No existe ningún lector con ese código en la base de datos, por favor haga click
				<a href=\"javascript:history.back()\">Atrás</a> y vuelva a intentarlo</TH>";
                echo "</TR>";

                echo "</TABLE>";
		echo "</FORM>";

         }

} else {

        echo "<FORM NAME='libro' ACTION='Prestamo.php'>";
        echo "<TABLE WIDTH=100% BORDER=0>";

        echo "<TR VALIGN=RIGHT>";
        	echo "<TH COLSPAN=3>PRÉSTAMOS</TH>";
        echo "</TR>";

        echo "<TR VALIGN=CENTER>";
                echo "<TH COLSPAN=3>El código del lector debe tener 5, 6 o 8 caracteres, por favor haga click <a href=\"javascript:history.back()\">Atrás</a> y vuelva a intentarlo</TH>";
        echo "</TR>";


        echo "</TABLE>";
        echo "</FORM>";

}	
//if del char==6

		pie();
		echo "<!--end content -->";
		echo "</div></CENTER></BODY></HTML>";

?>


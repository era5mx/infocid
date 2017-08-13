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

<?php
 
  function prestamos($codlector){

  $cn=pg_connect("","","","","Biblio");
  $sql="select codprest from regprest where codlector='$codlector'";
  $ex=pg_exec($cn,$sql);
  $row=pg_numrows($ex);

     echo "<table border=1 bordercolor=#000066 cellspacing=0 align=center>";
     echo "<tr>";
     echo "<th aling=center>Nº</th><th align=center>Registro</th><th align=center>Título</th><th align=center>Devuelto</th><th align=center>Fecha del Préstamo</th>";
     echo "</tr>";
   
  for($i=0;$i<$row;$i++){
   
  $res= pg_fetch_object($ex,$i);
   $cod=$res->codprest;
 $q="(select d.registro,l.titulo,d.devuelto,d.fechorprest from detprest d, libro l  where 
codprest='$cod'and devuelto='NO'and l.registro=d.registro)UNION ALL(select 
d.registro,v.titulo,d.devuelto, d.fechorprest from 
detprest d, video v  where codprest='$cod' and devuelto='NO'and v.registro=d.registro)";

    $e=pg_exec($cn,$q);
    $r=pg_numrows($e);
      if($r>0){

         for($j=0;$j<$r;$j++){
	  $n=1+$p++;
         $re=pg_fetch_object($e,$j); 
	  $reg=$re->registro;
	  $dev=$re->devuelto;
	  $tit=$re->titulo;
	  $fec=$re->fechorprest;
              echo "<tr>";
	      echo "<td align=center>$n</td><td align=center>$reg</td><td align=center>$tit</td><td align=center>$dev</td><td align=center>$fec</td>";
              echo "</tr>";
	 }
//	echo "</table>";
	}
  
  }
echo "</table>";
  }
?>

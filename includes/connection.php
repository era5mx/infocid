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
 
 //sintax for pg_connect -> int pg_connect ( string host, string port, string options, string tty, string dbname)

 ob_start();
 $coneccion = pg_connect("host=****************** port=5432 dbname=****** user=****** password=***********************")or die("Couldn't Connect ".pg_last_error($coneccion));
 ob_end_clean();
 
?>
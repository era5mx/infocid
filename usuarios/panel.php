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

// ------------------------------------------
require("aut_verifica.inc.php");
$nivel_acceso=10; // Nivel de acceso para esta página.
// se chequea si el usuario tiene un nivel inferior
// al del nivel de acceso definido para esta página.
// Si no es correcto, se mada a la página que lo llamo con
// la variable de $error_login definida con el nº de error segun el array de
// aut_mensaje_error.inc.php
if ($nivel_acceso <= $_SESSION['usuario_nivel']){
header ("Location: $redir?error_login=5");
exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html><head>
<title>Panel de Control</title>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1-->
<? include("../Plantilla.rn");
        logo(); ?>
<p>
<h1>Control de Usuarios</h1>
<br><br>
<a href="aut_gestion_usuarios.php" title="Gestionar Usuarios">
<img src="<? echo "$path"; ?>/images/admin.png" height="30" width="30" border="0" alt="Gestionar Usuarios"></a>
<br>
<a href="aut_gestion_usuarios.php" title="Gestionar Usuarios">Gestionar usuarios</a>
<br><br>
<a href="aut_logout.php" title="Salir">
<img src="<? echo "$path"; ?>/images/salir.gif" height="16" width="16" border="0" alt="Salir"></a>
<br>
<a href="aut_logout.php" title="Salir">Salir</a>
<br>
<? pie(); ?>

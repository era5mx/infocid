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
<html><head>
<title>Instalación Autentificator - Gestión Usuarios PHP+Mysql+sesiones by Cluster</title>
</head>
<body>
<p>Instalación de Autentificator - Gestor de Usuarios by Cluster.<p>
<?
require ("aut_config.inc.php");

if ($sql_db=="" or $sql_tabla==""){
die ("ERROR!!: Revise los datos de conexión.<br>El nombre de la base de datos o el nombre de la tabla no estan definidos.<br>Edite el archivo aut_config.inc.php y verifique los datos.");
}

$Sql="CREATE TABLE $sql_tabla (
  ID smallint(6) unsigned NOT NULL auto_increment,
  usuario tinytext NOT NULL,
  pass tinytext NOT NULL,
  nivel_acceso smallint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (ID),
  UNIQUE KEY ID (ID)
) TYPE=MyISAM PACK_KEYS=1;";

$Sql_usuario="INSERT INTO $sql_tabla VALUES (1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 0);";

$db_conexion= mysql_connect("$sql_host", "$sql_usuario", "$sql_pass") or die(header ("No se pudo conectar con Base de datos"));
mysql_select_db("$sql_db");
mysql_query($Sql) or die ("ERROR!!: Ha ocurrido un error en la instalación:<br>Mysql dice: ".mysql_error()."<br><br>nota: este script no instala la Base de datos, solo la tabla necesaria.");
mysql_query($Sql_usuario) or die ("ERROR!!: Ha ocurrido un error en la instalación:<br>Mysql dice: ".mysql_error());
echo "Instalación satisfactoria<br><br>";
echo "Se ha creado el usuario:<br>";
echo "usuario: Admin<br>";
echo "password: admin<br>";
echo "Nivel Acceso: 0<br><br><br>";
echo "<a href='gestion_usuarios.php'>Click aquí para Gestionar Usuarios</a>"

?>
</body>
</html>

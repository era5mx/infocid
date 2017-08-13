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

//  ----------------------------------------------------------------------------


// Motor autentificación usuarios.

// Cargar datos conexion y otras variables.
require ("aut_config.inc.php");
include_once("../includes/var.inc.php");

// chequear página que lo llama para devolver errores a dicha página.
//$url = explode("?",$_SERVER['HTTP_REFERER']);
//$pag_origen=$url[0];

if (isset($_GET['url'])){
	$pag_origen=$_GET['url'];
}
else {
	$pag_origen=$path."/administracion/xlibro.php";
}
$redir=$path."/regindex.php";

// chequear si se llama directo al script.
//if ($_SERVER['HTTP_REFERER'] == ""){
//die ("Error cod.:1 - Acceso incorrecto!");
//exit;
//}


// Chequeamos si se está autentificandose un usuario por medio del formulario
if (isset($_POST['user']) && isset($_POST['pass'])) {

// Conexión base de datos.
// si no se puede conectar a la BD salimos del scrip con error 0 y
// redireccionamos a la pagina de error.

//$db_conexion= mysql_connect("$sql_host", "$sql_usuario", "$sql_pass") or die(header ("Location:  $redir?url=$pag_origen&error_login=0"));
//mysql_select_db("$sql_db");


// realizamos la consulta a la BD para chequear datos del Usuario.
//$usuario_consulta = mysql_query("SELECT ID,usuario,pass,nivel_acceso FROM $sql_tabla WHERE usuario='".$_POST['user']."'") or die(header ("Location:  $redir?url=$pag_origen&error_login=1"));
$usuario_consulta = pg_query("SELECT ID,usuario,pass,nivel_acceso FROM gestion WHERE usuario='".$_POST['user']."'") or die(header ("Location:  $redir?url=$pag_origen&error_login=1"));

 // miramos el total de resultado de la consulta (si es distinto de 0 es que existe el usuario)
 //if (mysql_num_rows($usuario_consulta) != 0) {
 if (pg_num_rows($usuario_consulta) != 0) {

    // eliminamos barras invertidas y dobles en sencillas
    $login = stripslashes($_POST['user']);
    // encriptamos el password en formato md5 irreversible.
    $password = md5($_POST['pass']);

    // almacenamos datos del Usuario en un array para empezar a chequear.
 	//$usuario_datos = mysql_fetch_array($usuario_consulta);
 	$usuario_datos = pg_fetch_array($usuario_consulta);
  
    // liberamos la memoria usada por la consulta, ya que tenemos estos datos en el Array.
    //mysql_free_result($usuario_consulta);
    pg_free_result($usuario_consulta);
    // cerramos la Base de dtos.
    //mysql_close($db_conexion);
    
    // chequeamos el nombre del usuario otra vez contrastandolo con la BD
    // esta vez sin barras invertidas, etc ...
    // si no es correcto, salimos del script con error 4 y redireccionamos a la
    // página de error.
    if ($login != $usuario_datos['usuario']) {
       	Header ("Location: $redir?url=$pag_origen&error_login=4");
		exit;}

    // si el password no es correcto ..
    // salimos del script con error 3 y redireccinamos hacia la página de error
    if ($password != $usuario_datos['pass']) {
        Header ("Location: $redir?url=$pag_origen&error_login=3");
	    exit;}

    // Paranoia: destruimos las variables login y password usadas
    unset($login);
    unset ($password);

    // En este punto, el usuario ya esta validado.
    // Grabamos los datos del usuario en una sesion.
    
     // le damos un mobre a la sesion.
    session_name($usuarios_sesion);
     // incia sessiones
    session_start();

    // Paranoia: decimos al navegador que no "cachee" esta página.
    session_cache_limiter('nocache,private');
    
    // Asignamos variables de sesión con datos del Usuario para el uso en el
    // resto de páginas autentificadas.

    // definimos usuarios_id como IDentificador del usuario en nuestra BD de usuarios
    $_SESSION['usuario_id']=$usuario_datos['ID'];
    
    // definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    $_SESSION['usuario_nivel']=$usuario_datos['nivel_acceso'];
    
    //definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    $_SESSION['usuario_login']=$usuario_datos['usuario'];

    //definimos usuario_password con el password del usuario de la sesión actual (formato md5 encriptado)
    $_SESSION['usuario_password']=$usuario_datos['pass'];
	
    // Hacemos una llamada a si mismo (scritp) para que queden disponibles
    // las variables de session en el array asociado $HTTP_...
    $pag=$_SERVER['PHP_SELF'];
    Header ("Location: $pag?");
    exit;
    
   } else {
      // si no esta el nombre de usuario en la BD o el password ..
      // se devuelve a pagina q lo llamo con error
      Header ("Location: $redir?url=$pag_origen&error_login=2");
      exit;}
} else {

	// -------- Chequear sesión existe -------
	
	// usamos la sesion de nombre definido.
	session_name($usuarios_sesion);
	// Iniciamos el uso de sesiones
	session_start();
	
	// Chequeamos si estan creadas las variables de sesión de identificación del usuario,
	// El caso mas comun es el de una vez "matado" la sesion se intenta volver hacia atras
	// con el navegador.
	
	if (!isset($_SESSION['usuario_login']) && !isset($_SESSION['usuario_password'])){
		// Borramos la sesion creada por el inicio de session anterior
		session_destroy();
		die(header ("Location:  $redir?url=$pag_origen&error_login=6"));
		//die ("Error cod.: 2 - Acceso incorrecto!");
		//exit;
	}
}
?>

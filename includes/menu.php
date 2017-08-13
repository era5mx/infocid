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
<body onmousemove="closesubnav(event);" VLINK="#0000ff" BGCOLOR="#ffffff" TEXT="#283868" BACKGROUND="<? echo "$path"; ?>/images/bgInictel1.jpg"> 
<center>

<div id="masthead"> 
  <h1 id="siteName">&nbsp;<? echo "$title"; ?>&nbsp;</h1>
  <div id="globalNav"> 
  <img alt="" src="<? echo "$path"; ?>/includes/styles/gblnav_left.gif" height="32" width="4" id="gnl">

<!--		Inicio Login/Logout		-->
<?php 
	if(isset($_SESSION['usuario_login'])){
		$usuario=$_SESSION['usuario_login'];
		echo "<div align=\"right\"><font size=\"-1\"><b>&nbsp;&nbsp;<a href=\"$path/usuarios/aut_logout.php\"><img border=\"0\" alt=\"Cerrar sesion\" src=\"$path/images/out.gif\" height=\"14\" width=\"14\" align=\"bottom\"></a><sub>&nbsp;&nbsp;<a href=\"$path/usuarios/aut_logout.php\">$usuario</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font></sub></div>";
	}
	else{
		$pag_origen="administracion/xlibro.php";
		echo "<div align=\"right\"><font size=\"-1\"><b>&nbsp;&nbsp;<a href=\"$path/regindex.php\"><img border=\"0\" alt=\"Abrir sesion\" src=\"$path/images/in.gif\" height=\"14\" width=\"14\" align=\"bottom\"></a><sub>&nbsp;&nbsp;<a href=\"$path/regindex.php\">$usuario</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font></sub></div>";		
	}
?> 
<!--		Fin Login/Logout		-->

  <img alt="" src="<? echo "$path"; ?>/includes/styles/glbnav_right.gif" height="32" width="4" id="gnr"> 
    <div id="globalLink"> 
      <a href="<? echo "$path"; ?>/index.php" id="gl1" class="glink" onmouseover="ehandler(event,menuitem1);">Inicio</a><a href="#" id="gl2" class="glink" onmouseover="ehandler(event,menuitem2);">Procesos</a><a href="#" id="gl3" class="glink" onmouseover="ehandler(event,menuitem3);">Consulta</a><a href="#" id="gl4" class="glink" onmouseover="ehandler(event,menuitem4);">Prestamo</a><a href="#" id="gl5" class="glink" onmouseover="ehandler(event,menuitem5);">Devoluci&oacute;n</a><a href="#" id="gl6" class="glink" onmouseover="ehandler(event,menuitem6);">Estad&iacute;stica</a><a href="#" id="gl7" class="glink" onmouseover="ehandler(event,menuitem7);">Inventario</a>
	  
    </div>  
    <!--end globalLinks-->
  </div> 
  <!-- end globalNav -->
  
  <div id="subglobal1" class="subglobalNav"> 
  </div>  
  <div id="subglobal2" class="subglobalNav"> 
    <a href="<? echo "$path"; ?>/administracion/xlibro.php?url=administracion/xlibro.php">Libros</a> | 
    <a href="<? echo "$path"; ?>/administracion/xdocumentos.php?url=administracion/xdocumentos.php">Documentos</a> | 
    <a href="<? echo "$path"; ?>/administracion/xvideo.php?url=administracion/xvideo.php">Videos</a> | 
    <a href="<? echo "$path"; ?>/administracion/xalumno.php?url=administracion/xalumno.php">Estudiantes</a> | 
    <a href="<? echo "$path"; ?>/administracion/xinterno.php?url=administracion/xinterno.php">Internos</a> | 
    <a href="<? echo "$path"; ?>/administracion/xexterno.php?url=administracion/xexterno.php">Externos</a> | 
    <a href="<? echo "$path"; ?>/administracion/xlistalibro.php?url=administracion/xlistalibro.php">Lista de Libros</a> 
  </div> 
  <div id="subglobal3" class="subglobalNav"> 
    <a href="<? echo "$path"; ?>/consulta/Nautor1.php">Autor</a> | 
    <a href="<? echo "$path"; ?>/consulta/Ntitulo1.php">Título</a> | 
    <a href="<? echo "$path"; ?>/consulta/Ndescriptor1.php">Tema</a> | 
    <a href="<? echo "$path"; ?>/consulta/NconsConjunta1.php">Busqueda Completa</a> | 
    <a href="<? echo "$path"; ?>/consulta/listaVideos.php">Videos</a> | 
    <a href="<? echo "$path"; ?>/consulta/Buscadoc.php">Documentos</a> | 
    <a href="<? echo "$path"; ?>/consulta/termino1.php">Términos</a> 
  </div> 
  <div id="subglobal4" class="subglobalNav"> 
    <a href="<? echo "$path"; ?>/prestamo/xPrestamo.php?url=prestamo/xPrestamo.php">Préstamos</a> | 
    <a href="<? echo "$path"; ?>/prestamo/histPrest.php?url=prestamo/histPrest.php">Historial de Préstamos</a> 
  </div> 
  <div id="subglobal5" class="subglobalNav"> 
    <a href="<? echo "$path"; ?>/devolucion/xDevolucion.php?url=devolucion/xDevolucion.php">Devolución</a> 
  </div> 
  <div id="subglobal6" class="subglobalNav"> 
    <a href="<? echo "$path"; ?>/estadistica/estadistica1.php?url=estadistica/estadistica1.php">Consultas</a> | 
    <a href="<? echo "$path"; ?>/estadistica/estadprest.php?url=estadistica/estadprest.php">Préstamos</a> | 
    <a href="<? echo "$path"; ?>/estadistica/estLibrosPrest.php?url=estadistica/estLibrosPrest.php">Libros</a>
  </div> 
  <div id="subglobal7" class="subglobalNav"> 
    <a href="<? echo "$path"; ?>/inventario/individual1.php?url=inventario/individual1.php">Libros</a> | 
    <a href="<? echo "$path"; ?>/inventario/conjunta.php?url=inventario/conjunta.php">Lista General</a> | 
    <a href="<? echo "$path"; ?>/inventario/resumenInventario1.php?url=inventario/resumenInventario1.php">Estado del Inventario</a>
  </div> 


</div> 
<!-- end masthead -->

<!--end pagecell1--> 
<br> 
<script type="text/javascript">
    <!--
        var menuitem1 = new menu(7,1,"hidden");
		var menuitem2 = new menu(7,2,"hidden");
		var menuitem3 = new menu(7,3,"hidden");
		var menuitem4 = new menu(7,4,"hidden");
		var menuitem5 = new menu(7,5,"hidden");
		var menuitem6 = new menu(7,6,"hidden");
		var menuitem7 = new menu(7,7,"hidden");

    // -->
</script> 


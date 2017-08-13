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

// No almacenar en el cache del navegador esta página.
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");             		// Expira en fecha pasada
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");		// Siempre página modificada
		header("Cache-Control: no-cache, must-revalidate");           		// HTTP/1.1
		header("Pragma: no-cache");                                   		// HTTP/1.0
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html><head>
<title>&Aacute;rea de Administraci&oacute;n - Gesti&oacute;n de Usuarios</title>
<style type="text/css">
<!--
.botones {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; color: #FFFFFF; background-color: #0099FF; border-color: #000000 ; border-top-width: 1pix; border-right-width: 1pix; border-bottom-width: 1pix; border-left-width: 1pix}
.imputbox {  font-size: 10pt; color: #000099; background-color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; border: 1pix #000000 solid; border-color: #000000 solid; font-weight: normal}
-->
</style>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1-->
<? include("../Plantilla.rn");
        logo(); ?>
<span class="botones"></span><span class="imputbox"></span>
<br><br><br>
<table width="250" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="#0099FF">
  <tr>
    <td>
      <table width=100% border=0 align="center" cellpadding="0" cellspacing="0" bordercolor="#009999" bgcolor="#EEEEEE">
        <form action="panel.php" method="post">
          <tr bgcolor="#4a65a5"> 
            <th colspan="2" height="45"> 
              <div align="center">
					<font face="Arial" color="#FFFF00">Control de Usuarios</font>
				</div>
            </th>
          </tr>
          <tr> 
            <td colspan="2"> 
              <div align="center"> 
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tr valign="middle"> 
                    <td colspan="2" height="30"> 
                      <div align="center">

                         <?
                          // Mostrar error de Autentificación.
                          include ("aut_mensaje_error.inc.php");
                          if (isset($_GET['error_login'])){
                              $error=$_GET['error_login'];
                          echo "<font face='Verdana, Arial, Helvetica, sans-serif' size='1' color='#FF0000'>Error: $error_login_ms[$error]";
                          }
                         ?>
                         
                    </div>
                    </td>
                  </tr>
                  <tr> 
                    <td width="39%"> 
                      <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Usuario 
                        : </font></div>
                    </td>
                    <td width="61%"> 
                      <div align="left"> 
                        <input type="text" name="user" size="15" class="imputbox">
                      </div>
                    </td>
                  </tr>
                  <tr> 
                    <td width="39%"> 
                      <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Password 
                        : </font></div>
                    </td>
                    <td width="61%"> 
                      <div align="left"> 
                        <input type="password" name="pass" size="15" class="imputbox">
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </td>
          </tr>
          <tr valign="middle"> 
            <td colspan="2" height="50"> 
              <div align="center"><font face="Arial" color="black" size="2"> 
                <input type="submit" name="submit"  value="  Entrar  " class="botones">
                </font></div>
            </td>
          </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
<? pie(); ?>

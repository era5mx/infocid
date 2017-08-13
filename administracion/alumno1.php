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
<script>
function sf(){
   document.anew.num.focus();}
</script>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 

<? include("../Plantilla.rn");
        logo(); ?>

<FORM name=anew ACTION="alumno2.php" METHOD="POST">
	<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=2>
		<COL WIDTH=96*>
		<COL WIDTH=160*>
		<THEAD>
			<TR VALIGN=TOP>
				<TD COLSPAN=2 ALIGN=CENTER><FONT FACE="Lucida, sans-serif" SIZE=5 STYLE="font-size: 20pt"><B>
				INGRESO DE ESTUDIANTES</B></FONT> </TD>
			</TR>
		</THEAD>
		<TBODY>
			<TR VALIGN=TOP>
                                <TD COLSPAN=2><BR></TD>
                        </TR>
			<TR VALIGN=TOP>
				<TD WIDTH=38% ALIGN=RIGHT>
					<P><FONT FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>Nº CARNÉ
					</B></FONT></P>
				</TD>
				<TD WIDTH=62%>
					<INPUT TYPE=TEXT NAME="num" SIZE=20> 
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>NOMBRES
					</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="nom" SIZE=20> 
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>APELLIDO PATERNO
					</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="app" SIZE=20> 
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT  FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>APELLIDO MATERNO
					</B></FONT></P>
				</TD>
				<TD>
					<P><INPUT TYPE=TEXT NAME="apm" SIZE=20> 
					</P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT  FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>ESPECIALIDAD
					</B></FONT></P>
				</TD>
				<TD>
					<select name="esp" size=1>
                                           <option>INFORMÁTICA
                                           <option>PRODUCCIÓN DE TV
                                           <option>RADIODIFUSIÓN
                                           <option>TELECOMUNICACIONES
                                           <option>TELEMÁTICA
                                        </select>					
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>DOMICILIO
					</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="dir" SIZE=40> 
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT  FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>TELÉFONO
					</B></FONT></P>
				</TD>
				<TD>
					<INPUT TYPE=TEXT NAME="tel" SIZE=20> 
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT  FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>SEXO
					</B></FONT></P>
				</TD>
				<TD>
					<select name="sex" size=1>
                                           <option value="M">Masculino
                                           <option value="F">Femenino
                                        </select>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT  FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>CENTRO DE ESTUDIOS
						</B></FONT></P>
				</TD>
				<TD>
					<select name="ie" size=1>
                                           <option value="I">Inictel
                                           <option value="E">Esutel
                                        </select>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD ALIGN=RIGHT>
					<P><FONT  FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>CICLO
					</B></FONT></P>
				</TD>
				<TD WIDTH=62%>
					<P><SELECT NAME="cic" SIZE=1>
					<OPTION VALUE="">
                                <?php for ($i=1;$i<11;$i++){
                                        if ($i<10){
                                        $d="0".$i;
                                        }else{ $d=$i; };

                                        echo "<OPTION VALUE='$d'>$d"; };
                                ?>
                                           </select>
                                        </P>
				</TD>
			</TR>
			<TR VALIGN=TOP>
				<TD>
					<P><INPUT TYPE=SUBMIT VALUE="Guardar"></P>
				</TD>
				<TD><BR>
				</TD>
			</TR>
		</TBODY>
	</TABLE>
</FORM>
<? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
<P><BR><BR>
</P>
</BODY>
</HTML>

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
<html><HEAD>
<?php include('../includes/head.php'); ?>
<?php include('../includes/menu.php'); ?>
<div id="pagecell1"> 
<!--pagecell1--> 
<? include("../Plantilla.rn");
        logo(); ?>
<BR>

<FORM ACTION="editarvideo2.php" METHOD="POST">
<?php
//$coneccion = pg_connect("","","","","Biblio");
 include('../includes/connection.php');
 $sql = "select titulo, autor, fecha, mesa, debate, entrevista, curso1, curso2, magazine, documental, duracion, resumen, prestado, obs
 	 from video where registro = upper('$reg')";
 $exec = pg_exec($coneccion,$sql);
 $rows = pg_numrows($exec);

 if ($rows==0){
 	echo '<SCRIPT LANGUAJE="JavaScript">alert("NO EXISTE NINGÚN VIDEO CON ESE NÚMERO DE REGISTRO")</SCRIPT>';
        echo '<SCRIPT LANGUAJE="JavaScript">history.go(-1); return</SCRIPT>';
        exit;
 } else {
 	$res = pg_fetch_object($exec,0);

	$titulo = $res->titulo;
	$autor = $res->autor;
	$fecha = $res->fecha;
	$mesa = $res->mesa;
	$debate = $res->debate;
	$entrevista = $res->entrevista;
	$curso1 = $res->curso1;
	$curso2 = $res->curso2;
	$magazine = $res->magazine;
	$documental = $res->documental;
	$duracion = $res->duracion;
	$resumen = $res->resumen;
	$prestado = $res->prestado;
	$obs  = $res->obs;
 }

?>

	<TABLE WIDTH=100% BORDER=0 CELLPADDING=4 CELLSPACING=2>
		<COL WIDTH=96*>
		<COL WIDTH=160*>
		<THEAD>
			<TR>
				<TD COLSPAN=3 ALIGN=CENTER><FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=5 STYLE="font-size: 20pt"><B>
				INGRESO DE VIDEOS</B></FONT> </TD>
			</TR>
		</THEAD>
		<TBODY>
			<TR>
                                <TD COLSPAN=3><BR></TD>
                        </TR>
			<TR VALIGN=MIDDLE>
				<TD WIDTH=15% ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>REGISTRO</B></FONT>
				</TD>
				<TD>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><INPUT TYPE=text NAME="reg" SIZE=6 VALUE="<?php echo strtoupper($reg); ?>">
				</TD>
				<TD WIDTH=15% ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>RESPONSABLE: <?php echo $PHP_AUTH_USER; ?></B></FONT>
				</TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>TÍTULO</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="tit" SIZE=60 VALUE= "<?php echo $titulo; ?>">
				</TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>AUTOR</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="aut" SIZE=40 VALUE="<?php echo $autor; ?>">
				</TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>FECHA DE EMISIÓN</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="fec" SIZE=12 VALUE="<?php echo $fecha; ?>">
				</TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>MESA REDONDA</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="mesa" SIZE=60 VALUE="<?php echo $mesa; ?>">
				</TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>DEBATE</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="deb" SIZE=60 VALUE="<?php echo $debate; ?>">
				</TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>ENTREVISTA</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="ent" SIZE=60 VALUE="<?php echo $entrevista; ?>">
				</TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>CURSO1</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="cur1" SIZE=60 VALUE="<?php echo $curso1; ?>">
				</TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>CURSO2</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="cur2" SIZE=60 VALUE="<?php echo $curso2; ?>">
				</TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>MAGAZINE</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="mag" SIZE=60 VALUE="<?php echo $magazine; ?>">
                                </TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>DOCUMENTAL</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="doc" SIZE=60 VALUE="<?php echo $documental; ?>">
                                </TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>DURACIÓN</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT SIZE=15 NAME="dur" VALUE="<?php echo $duracion; ?>">
                                </TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>RESÚMEN</B></FONT>
				</TD>
				<TD COLSPAN=2>

<!-- wrap="virtual" name="fields[descripcion]" style="width:300px;" rows=5 -->

					<TEXTAREA WRAP="PHYSICAL" NAME="res" ROWS=10 COLS=60><?php echo $resumen; ?></TEXTAREA>
                                </TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>OBSERVACIONES</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<INPUT TYPE=TEXT NAME="obs" SIZE=60 VALUE="<?php echo $obs; ?>">
                                </TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD ALIGN=RIGHT>
					<FONT COLOR="#000080" FACE="Lucida, sans-serif" SIZE=2 STYLE="font-size: 9pt"><B>PRESTADO</B></FONT>
				</TD>
				<TD COLSPAN=2>
					<SELECT NAME="prest" SIZE=1>
						<OPTION VALUE="NO">NO
						<OPTION VALUE="SI">SI
					</SELECT>
                                </TD>
			</TR>
			<TR VALIGN=MIDDLE>
				<TD>
					<INPUT TYPE=SUBMIT VALUE="Guardar">
				</TD>
				<TD COLSPAN=2><BR>
				</TD>
			</TR>
		</TBODY>
	</TABLE>
</FORM>
  <? pie(); ?>
  <!--end content --> 
</div>
</CENTER>
</BODY>
</HTML>

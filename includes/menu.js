//**
//* @Infocid version 2.0  feb-2005
//* @Copyright (C) 2005 SPHERA5, C.A. <sphera5@gmail.com>
//* *
//* @Obra basada en el Programa Infocid
//* @Copyright (C) 2003 CIDTEL <cidtel@inictel.gob.pe>
//* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
//* *
//* @Powered by Autentificator
//* @PHP-Script  de Gestión de Usuarios basado en sesiones
//* @by Pedro Noves V. (Cluster) <clus@hotpop.com>
//**

var time = 3000;
var numofitems = 7;

//menu constructor
function menu(allitems,thisitem,startstate){ 
  callname= "gl"+thisitem;
  divname="subglobal"+thisitem;  
	this.numberofmenuitems = 7;
	this.caller = document.getElementById(callname);
	this.thediv = document.getElementById(divname);
	this.thediv.style.visibility = startstate;
}
				 
//menu methods
function ehandler(event,theobj){
  for (var i=1; i<= theobj.numberofmenuitems; i++){
	  var shutdiv =eval( "menuitem"+i+".thediv");
    shutdiv.style.visibility="hidden";
	}
	theobj.thediv.style.visibility="visible";
}
				
function closesubnav(event){
  if ((event.clientY <48)||(event.clientY > 107)){
    for (var i=1; i<= numofitems; i++){
      var shutdiv =eval('menuitem'+i+'.thediv');
			shutdiv.style.visibility='hidden';
		}  
	}
}
// -->


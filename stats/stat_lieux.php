<?php
/*
 
  ----------------------------------------------------------------------
GLPI - Gestionnaire libre de parc informatique
 Copyright (C) 2002 by the INDEPNET Development Team.
 Bazile Lebeau, baaz@indepnet.net - Jean-Mathieu Dol�ans, jmd@indepnet.net
 http://indepnet.net/   http://glpi.indepnet.org
 ----------------------------------------------------------------------
 Based on:
IRMA, Information Resource-Management and Administration
Christian Bauer, turin@incubus.de 

 ----------------------------------------------------------------------
 LICENSE

This file is part of GLPI.

    GLPI is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    GLPI is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GLPI; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 ----------------------------------------------------------------------
 Original Author of file: Mustapha Saddalah et Bazile Lebea
 Purpose of file:
 ----------------------------------------------------------------------
*/
 
include ("_relpos.php");
include ($phproot . "/glpi/includes.php");
require ("functions.php");


checkAuthentication("normal");

commonHeader("Stats",$_SERVER["PHP_SELF"]);

echo "<div align='center'><b>".$lang["stats"][19]."</b></div>";
if(empty($_POST["date1"])) $_POST["date1"] = "";
if(empty($_POST["date2"])) $_POST["date2"] = "";

echo "<div align='center'><form method=\"post\" name=\"form\" action=\"stat_lieux.php\">";
echo "Date de debut : <input type=\"texte\" name=\"date1\" value=\"". $_POST["date1"] ."\" />";
echo "<input name='button' type='button' class='button'  onClick=\"window.open('mycalendar.php?form=form&amp;elem=date1','Calendrier','width=200,height=220')\" value='".$lang["buttons"][15]."...'>";
echo "<br />Date de fin : <input type=\"texte\" name=\"date2\" value=\"". $_POST["date2"] ."\" />";
echo "<input name='button' type='button' class='button'  onClick=\"window.open('mycalendar.php?form=form&amp;elem=date2','Calendrier','width=200,height=220')\" value='".$lang["buttons"][15]."...'>";
echo "<br /><input type=\"submit\" class='button' name\"submit\" Value=\"". $lang["buttons"][7] ."\" />";
echo "</form></div>";
echo "<hr noshade>";

//recuperation des differents lieux d'interventions
//Get the distincts intervention location
$nomLieux = getNbIntervLieux();

echo "<div align ='center'>";

if (is_array($nomLieux))
   {
 //affichage du tableau
 echo "<table class='tab_cadre2' cellpadding='5' >";
 echo "<tr><th>".$lang["stats"][21]."</th><th>".$lang["stats"][22]."</th><th>".$lang["stats"][14]."</th><th>".$lang["stats"][15]."</th></tr>";

 //Pour chaque lieu on affiche
 //for each location displays
      foreach($nomLieux as $key)
      {
	echo "<tr class='tab_bg_1'>";
	echo "<td>".getDropdownName("glpi_dropdown_locations",$key["ID"]) ."</td>";
	//le nombre d'intervention
	//the number of intervention
	if(!empty($_POST["date1"]) && !empty($_POST["date2"])) {
	
		echo "<td>".getNbinter(4,'glpi_computers.location',$key["ID"],$_POST["date1"],$_POST["date2"] )."</td>";
	}
	else {
		echo "<td>".getNbinter(1,'glpi_computers.location',$key["ID"])."</td>";
	}
	//le nombre d'intervention resolues
	//the number of resolved intervention
	if(!empty($_POST["date1"]) && !empty($_POST["date2"])) {
		echo "<td>".getNbresol(4,'glpi_computers.location',$key["ID"],$_POST["date1"],$_POST["date2"])."</td>";
	}
	else {
		echo "<td>".getNbresol(1,'glpi_computers.location',$key["ID"])."</td>";
	}
	//Le temps moyen de resolution
	//The average time to resolv
	if(!empty($_POST["date1"]) && !empty($_POST["date2"])) {
		echo "<td>".getResolAvg(4,'glpi_computers.location',$key["ID"],$_POST["date1"],$_POST["date2"])."</td>";
	}
	else {
		echo "<td>".getResolAvg(1,'glpi_computers.location',$key["ID"])."</td>";
	}
	echo "</tr>";
  }
echo "</table>";
}
else {

echo $lang["stats"][23];
}

echo "</div>"; 


commonFooter();
?>

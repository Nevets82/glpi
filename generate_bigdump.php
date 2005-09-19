<?

// BIG DUMP GENERATION FOR THE 0.6 VERSION

include ("_relpos.php");
include ($phproot."/glpi/includes.php");
$db=new DB();

$multiplicator=50;

$max['locations']=50;
$max['kbcategories']=10;

// DROPDOWNS
$max['consumable_type']=10;
$max['cartridge_type']=1;
$max['contact_type']=10;
$max['contract_type']=10;
$max['domain']=20;
$max['enttype']=10;
$max['firmware']=10;
$max['hdd_type']=10;
$max['iface']=10;
$max['model']=10;
$max['network']=10;
$max['os']=10;
$max['ram_type']=10;
$max['rubdocs']=10;
$max['state']=10;
$max['tracking_category']=10;
$max['vlan']=10;
$max['type_computers']=10;
$max['type_printers']=10;
$max['type_monitors']=10;
$max['type_peripherals']=10;
$max['type_networking']=10;
$max['netpoint']=1000;

// USERS

$max['users_sadmin']=1;
$max['users_admin']=10;
$max['users_normal']=10;
$max['users_postonly']=100;
$max['enterprises']=10;
// INVENTORY ITEMS
$max['computers']=1000;
$max['printers']=100;
$max['networking']=$max['locations'];
$max['monitors']=$max['computers'];
$max['type_of_cartridges']=5;
$max['cartridges_by_printer']=2;
$max['cartridges_stock']=2;


// DIRECT CONNECTED PRINTERS
$percent['printer']=10;
// PERCENT ELEMENTIN SPECIAL STATE
$percent['state']=10;

foreach ($max as $key => $val)
	$max[$key]=$multiplicator*$val;

function optimize_tables (){
	
$db = new DB;
$result=$db->list_tables();
	while ($line = $db->fetch_array($result))
   	{
   		if (ereg("glpi_",$line[0])){
			$table = $line[0];
   		$query = "OPTIMIZE TABLE ".$table." ;";
//   		echo $query;
   		$db->query($query);
		}
  	 }
mysql_free_result($result);
}

// DROPDOWNS
for ($i=0;$i<$max['consumable_type'];$i++){
$query="INSERT INTO glpi_dropdown_consumable_type VALUES ('','type de consommable $i')";
$db->query($query);
}
for ($i=0;$i<$max['consumable_type'];$i++){
$query="INSERT INTO glpi_dropdown_cartridge_type VALUES ('','type de cartouche $i')";
$db->query($query);
}
for ($i=0;$i<$max['contact_type'];$i++){
$query="INSERT INTO glpi_dropdown_contact_type VALUES ('','type de contact $i')";
$db->query($query);
}
for ($i=0;$i<$max['contact_type'];$i++){
$query="INSERT INTO glpi_dropdown_contract_type VALUES ('','type de contract $i')";
$db->query($query);
}
for ($i=0;$i<$max['domain'];$i++){
$query="INSERT INTO glpi_dropdown_domain VALUES ('','domain $i')";
$db->query($query);
}
for ($i=0;$i<$max['enttype'];$i++){
$query="INSERT INTO glpi_dropdown_enttype VALUES ('','type d\'entreprise $i')";
$db->query($query);
}
for ($i=0;$i<$max['firmware'];$i++){
$query="INSERT INTO glpi_dropdown_firmware VALUES ('','firmware $i')";
$db->query($query);
}
for ($i=0;$i<$max['hdd_type'];$i++){
$query="INSERT INTO glpi_dropdown_hdd_type VALUES ('','type de disque dur $i')";
$db->query($query);
}
for ($i=0;$i<$max['iface'];$i++){
$query="INSERT INTO glpi_dropdown_iface VALUES ('','type d\'interface $i')";
$db->query($query);
}
for ($i=0;$i<$max['model'];$i++){
$query="INSERT INTO glpi_dropdown_model VALUES ('','Modele $i')";
$db->query($query);
}

for ($i=0;$i<$max['network'];$i++){
$query="INSERT INTO glpi_dropdown_network VALUES ('','network $i')";
$db->query($query);
}
for ($i=0;$i<$max['os'];$i++){
$query="INSERT INTO glpi_dropdown_os VALUES ('','os $i')";
$db->query($query);
}
for ($i=0;$i<$max['ram_type'];$i++){
$query="INSERT INTO glpi_dropdown_ram_type VALUES ('','type de RAM $i')";
$db->query($query);
}
for ($i=0;$i<$max['rubdocs'];$i++){
$query="INSERT INTO glpi_dropdown_rubdocs VALUES ('','rubdocs $i')";
$db->query($query);
}
for ($i=0;$i<$max['state'];$i++){
$query="INSERT INTO glpi_dropdown_state VALUES ('','state $i')";
$db->query($query);
}
for ($i=0;$i<$max['tracking_category'];$i++){
$query="INSERT INTO glpi_dropdown_tracking_category VALUES ('','categorie $i')";
$db->query($query);
}
for ($i=0;$i<$max['vlan'];$i++){
$query="INSERT INTO glpi_dropdown_vlan VALUES ('','VLAN $i')";
$db->query($query);
}
for ($i=0;$i<$max['type_computers'];$i++){
$query="INSERT INTO glpi_type_computers VALUES ('','type ordinateur $i')";
$db->query($query);
}
for ($i=0;$i<$max['type_printers'];$i++){
$query="INSERT INTO glpi_type_printers VALUES ('','type imprimante $i')";
$db->query($query);
}
for ($i=0;$i<$max['type_monitors'];$i++){
$query="INSERT INTO glpi_type_monitors VALUES ('','type ecran $i')";
$db->query($query);
}
for ($i=0;$i<$max['type_networking'];$i++){
$query="INSERT INTO glpi_type_networking VALUES ('','type matos reseau $i')";
$db->query($query);
}
for ($i=0;$i<$max['type_peripherals'];$i++){
$query="INSERT INTO glpi_type_peripherals VALUES ('','type peripheriques $i')";
$db->query($query);
}

optimize_tables ();

for ($i=0;$i<pow($max['kbcategories'],1/3);$i++){
	$query="INSERT INTO glpi_dropdown_kbcategories VALUES ('','0','categorie $i','')";
	$db->query($query);
	$newID=$db->insert_id();
	for ($j=0;$j<mt_rand(0,pow($max['kbcategories'],1/2));$j++){
		$query="INSERT INTO glpi_dropdown_kbcategories VALUES ('','$newID','s-categorie $j','')";
		$db->query($query);
		$newID2=$db->insert_id();
		for ($k=0;$k<mt_rand(0,pow($max['kbcategories'],1/2));$k++){
			$query="INSERT INTO glpi_dropdown_kbcategories VALUES ('','$newID2','ss-categorie $k','')";
			$db->query($query);
		}	
	}
}	
$query = "OPTIMIZE TABLE  glpi_dropdown_kbcategories;";
$db->query($query);

regenerateTreeCompleteName("glpi_dropdown_kbcategories");

$max['kbcategories']=0;
$query="SELECT MAX(ID) FROM glpi_dropdown_kbcategories";
$result=$db->query($query);
$max['kbcategories']=$db->result($result,0,0);

// LOCATIONS

for ($i=0;$i<pow($max['locations'],1/5);$i++){
	$query="INSERT INTO glpi_dropdown_locations VALUES ('','lieu $i','0','')";
	$db->query($query);
	$newID=$db->insert_id();
	for ($j=0;$j<mt_rand(0,pow($max['locations'],1/4));$j++){
		$query="INSERT INTO glpi_dropdown_locations VALUES ('','s-lieu $j','$newID','')";
		$db->query($query);
		$newID2=$db->insert_id();
		for ($k=0;$k<mt_rand(0,pow($max['locations'],1/4));$k++){
			$query="INSERT INTO glpi_dropdown_locations VALUES ('','ss-lieu $k','$newID2','')";
			$db->query($query);
			$newID3=$db->insert_id();
			for ($l=0;$l<mt_rand(0,pow($max['locations'],1/4));$l++){
				$query="INSERT INTO glpi_dropdown_locations VALUES ('','sss-lieu $l','$newID3','')";
				$db->query($query);
				$newID4=$db->insert_id();
				for ($m=0;$m<mt_rand(0,pow($max['locations'],1/4));$m++){
					$query="INSERT INTO glpi_dropdown_locations VALUES ('','ssss-lieu $m','$newID4','')";
					$db->query($query);
				}	
			}	
		}	
	}
}	

$query = "OPTIMIZE TABLE  glpi_dropdown_locations;";
$db->query($query);

regenerateTreeCompleteName("glpi_dropdown_locations");

$max['locations']=0;
$query="SELECT MAX(ID) FROM glpi_dropdown_locations";
$result=$db->query($query);
$max['locations']=$db->result($result,0,0);


// glpi_users
for ($i=0;$i<$max['users_sadmin'];$i++){
	$query="INSERT INTO glpi_users VALUES ('','sadmin$i','',MD5('sadmin$i'),'sadmin$i@tutu.com','tel $i','super-admin','','no','".mt_rand(0,$max['locations'])."','no','french')";
	$db->query($query);
}
for ($i=0;$i<$max['users_admin'];$i++){
	$query="INSERT INTO glpi_users VALUES ('','admin$i','',MD5('admin$i'),'admin$i@tutu.com','tel $i','admin','','no','".mt_rand(0,$max['locations'])."','no','french')";
	$db->query($query);
}
for ($i=0;$i<$max['users_normal'];$i++){
	$query="INSERT INTO glpi_users VALUES ('','normal$i','',MD5('normal$i'),'normal$i@tutu.com','tel $i','normal','','no','".mt_rand(0,$max['locations'])."','no','french')";
	$db->query($query);
}
for ($i=0;$i<$max['users_postonly'];$i++){
	$query="INSERT INTO glpi_users VALUES ('','postonly$i','',MD5('postonly$i'),'postonly$i@tutu.com','tel $i','normal','','no','".mt_rand(0,$max['locations'])."','no','french')";
	$db->query($query);
}

// glpi_enterprises
for ($i=0;$i<$max['enterprises'];$i++){
	$query="INSERT INTO glpi_enterprises VALUES ('','enterprise $i','".mt_rand(0,$max['enttype'])."','address $i','http://ent$i.com/','phone $i','comment $i','N','fax $i','info@ent$i.com')";
	$db->query($query);
}

// Networking
$query="SELECT * from glpi_dropdown_locations order by completename";
$result=$db->query($query);
$i=0;
$net_loc=array();	

while ($data=$db->fetch_array($result)){
	// insert networking
	$techID=mt_rand(0,$max['users_sadmin']+$max['users_admin']);
	$domainID=mt_rand(0,$max['domain']);
	$networkID=mt_rand(0,$max['network']);
	$query="INSERT INTO glpi_networking VALUES ('','networking $i','ram $i','serial $i','serial2 $i','contact $i','num $i','$techID',NOW(),'comment $i','".$data['ID']."','$domainID','$networkID','".mt_rand(0,$max['type_networking'])."','".mt_rand(0,$max['firmware'])."','".mt_rand(0,$max['enterprises'])."','N','0','','MAC networking $i','IP networking $i')";
	$db->query($query);
	$netwID=$db->insert_id();
	$net_loc[$data['ID']]=$netwID;
	
	// ITEMS IN SPECIAL STATES
	if (mt_rand(0,100)<$percent['state']){
		$query="INSERT INTO glpi_state_item VALUES ('','".NETWORKING_TYPE."','$netwID','".mt_rand(0,$max['state'])."','0')";
		$db->query($query);
	}
	
	
	// Link with father 
	if ($data['parentID']>0){
		//insert netpoint
		$query="INSERT INTO glpi_dropdown_netpoint VALUES ('','".$data['ID']."','netpoint networking $i')";
		$db->query($query);
		$netpointID=$db->insert_id();
	
		$iface=mt_rand(0,$max['iface']);

		// Add networking ports 
		$query="INSERT INTO glpi_networking_ports VALUES ('','$netwID','".NETWORKING_TYPE."','".mt_rand(0,100)."','link port to netw ".$net_loc[$data['parentID']]."','IP networking $netwID','MAC networking $netwID','$iface','$netpointID')";
		$db->query($query);
		$port1ID=$db->insert_id();
		$query="INSERT INTO glpi_networking_ports VALUES ('','".$net_loc[$data['parentID']]."','".NETWORKING_TYPE."','".mt_rand(0,100)."','link port to netw $netwID','IP networking ".$net_loc[$data['parentID']]."','MAC networking ".$net_loc[$data['parentID']]."','$iface','$netpointID')";
		$db->query($query);
		$port2ID=$db->insert_id();
	
		$query="INSERT INTO glpi_networking_wire VALUES ('','$port1ID','$port2ID')";
		$db->query($query);	
	}
	
	// Ajout imprimantes reseaux : 1 par loc + connexion � un matos reseau + ajout de cartouches
	//insert netpoint
	$query="INSERT INTO glpi_dropdown_netpoint VALUES ('','".$data['ID']."','netpoint networking $i')";
	$db->query($query);
	$netpointID=$db->insert_id();
	
	$typeID=mt_rand(0,$max['type_printers']);
	$query="INSERT INTO glpi_printers VALUES ('','printer of loc ".$data['ID']."',NOW(),'contact ".$data['ID']."','num ".$data['ID']."','$techID','serial ".$data['ID']."','serial2 ".$data['ID']."','0','0','1','comments $i','".mt_rand(0,64)."','".$data['ID']."','$domainID','$networkID','$typeID','".mt_rand(0,$max['enterprises'])."','N','0','','0')";
	$db->query($query);
	$printID=$db->insert_id();

	// ITEMS IN SPECIAL STATES
	if (mt_rand(0,100)<$percent['state']){
		$query="INSERT INTO glpi_state_item VALUES ('','".PRINTER_TYPE."','$printID','".mt_rand(0,$max['state'])."','0')";
		$db->query($query);
	}
	
		
	$iface=mt_rand(0,$max['iface']);

	// Add networking ports 
	$query="INSERT INTO glpi_networking_ports VALUES ('','$netwID','".NETWORKING_TYPE."','".mt_rand(0,100)."','link port to printer $printID','IP printer $printID','MAC printer $printID','$iface','$netpointID')";
	$db->query($query);
	$port1ID=$db->insert_id();
	$query="INSERT INTO glpi_networking_ports VALUES ('','$printID','".PRINTER_TYPE."','".mt_rand(0,100)."','link port to netw $netwID','IP networking $netwID','MAC networking $netwID','$iface','$netpointID')";
	$db->query($query);
	$port2ID=$db->insert_id();
	$query="INSERT INTO glpi_networking_wire VALUES ('','$port1ID','$port2ID')";
	$db->query($query);	

	// Add Cartouches 
	// OLD
	// NEW	

$i++;
}	
unset($net_loc);


//////////// INVENTORY

// TYPE DE CARTOUCHES
for ($i=0;$i<$max['type_of_cartridges'];$i++){
	$query="INSERT INTO glpi_cartridges_type VALUES ('','cartridge type $i','ref $i','".mt_rand(0,$max['locations'])."','".mt_rand(0,$max['cartridge_type'])."','".mt_rand(0,$max['enterprises'])."','".mt_rand(0,$max['users_sadmin']+$max['users_admin'])."','N','comments $i','".mt_rand(0,10)."')";
	$db->query($query);
	$cartID=$db->insert_id();

	// Ajout cartouche en stock
	for ($j=0;$j<mt_rand(0,$max['cartridges_stock']);$j++){
	$query="INSERT INTO glpi_cartridges VALUES('','$cartID','0',NOW(),NULL,NULL,'0')";
	$db->query($query);
	}
}

// Assoc printer type to cartridge type
for ($i=0;$i<$max['type_printers'];$i++){
	$query="INSERT INTO glpi_cartridges_assoc VALUES ('','".mt_rand(1,$max['type_of_cartridges'])."','$i')";
	$db->query($query);
}





// glpi_computers
for ($i=0;$i<$max['computers'];$i++){
	$loc=mt_rand(0,$max['locations']);
	$techID=mt_rand(0,$max['users_sadmin']+$max['users_admin']);
	$domainID=mt_rand(0,$max['domain']);
	$networkID=mt_rand(0,$max['network']);
	$query="INSERT INTO glpi_computers VALUES ('','computers $i','serial $i','serial2 $i','contact $i','num $i','$techID','',NOW(),'".mt_rand(0,$max['os'])."','".$loc."','$domainID','$networkID','".mt_rand(0,$max['model'])."','".mt_rand(0,$max['type_computers'])."','0','','".mt_rand(0,$max['enterprises'])."','N')";
	$db->query($query);
	$compID=$db->insert_id();

	// ITEMS IN SPECIAL STATES
	if (mt_rand(0,100)<$percent['state']){
		$query="INSERT INTO glpi_state_item VALUES ('','".COMPUTER_TYPE."','$compID','".mt_rand(0,$max['state'])."','0')";
		$db->query($query);
	}
	
		
	//insert netpoint
	$query="INSERT INTO glpi_dropdown_netpoint VALUES ('','$loc','netpoint computer $i')";
	$db->query($query);
	$netpointID=$db->insert_id();

	// Get networking element
	$query="SELECT ID FROM glpi_networking WHERE location='$loc'";
	$result=$db->query($query);
	if ($db->numrows($result)>0){
		$netwID=$db->result($result,0,0);

		$iface=mt_rand(0,$max['iface']);

		// Add networking ports 
		$query="INSERT INTO glpi_networking_ports VALUES ('','$compID','".COMPUTER_TYPE."','".mt_rand(0,100)."','link port to netw $netwID','IP networking $compID','MAC networking $compID','$iface','$netpointID')";
		$db->query($query);
		$port1ID=$db->insert_id();
		$query="INSERT INTO glpi_networking_ports VALUES ('','$netwID','".NETWORKING_TYPE."','".mt_rand(0,100)."','link port to computer $compID','IP networking $netwID','MAC networking $netwID','$iface','$netpointID')";
		$db->query($query);
		$port2ID=$db->insert_id();
	
		$query="INSERT INTO glpi_networking_wire VALUES ('','$port1ID','$port2ID')";
		$db->query($query);	
	}

	// Ajout d'un ecran sur l'ordi
	
	$query="INSERT INTO glpi_monitors VALUES ('','monitor $i',NOW(),'contact $i','num $i','$techID','comment $i','serial $i','serial2 $i','".mt_rand(14,22)."','".mt_rand(0,1)."','".mt_rand(0,1)."','".mt_rand(0,1)."','".mt_rand(0,1)."','$loc','".mt_rand(0,$max['type_monitors'])."','".mt_rand(0,$max['enterprises'])."','0','N','0','')";
	$db->query($query);	
	$monID=$db->insert_id();
	
	// ITEMS IN SPECIAL STATES
	if (mt_rand(0,100)<$percent['state']){
		$query="INSERT INTO glpi_state_item VALUES ('','".MONITOR_TYPE."','$monID','".mt_rand(0,$max['state'])."','0')";
		$db->query($query);
	}
	
	
	$query="INSERT INTO glpi_connect_wire VALUES ('','$monID','$compID','".MONITOR_TYPE."')";
	$db->query($query);	
	
	// Ajout d'une imprimante connection directe pour X% des computers + ajout de cartouches
	if (mt_rand(0,100)<=$percent['printer']){
		// Add printer 
		$typeID=mt_rand(0,$max['type_printers']);
		$query="INSERT INTO glpi_printers VALUES ('','printer of comp $i',NOW(),'contact $i','num $i','$techID','serial $i','serial2 $i','0','0','1','comments $i','".mt_rand(0,64)."','$loc','$domainID','$networkID','$typeID','".mt_rand(0,$max['enterprises'])."','N','0','','0')";
		$db->query($query);
		$printID=$db->insert_id();

		// ITEMS IN SPECIAL STATES
		if (mt_rand(0,100)<$percent['state']){
			$query="INSERT INTO glpi_state_item VALUES ('','".PRINTER_TYPE."','$printID','".mt_rand(0,$max['state'])."','0')";
			$db->query($query);
		}
		
			
		// Add connection
		$query="INSERT INTO glpi_connect_wire VALUES ('','$printID','$compID','".PRINTER_TYPE."')";
		$db->query($query);	
	
		// Add Cartouches 
		// OLD
		// NEW	
	}

}

	// Ajout periph externes globaux et unitaires + connexion aux ordis
	
	// Ajout d'interventions + followups
	
	// Def du mat�riel r�servable : x% du parc
	
	// Ajout element dans la FAQ
	
	// Ajout d'entr�es dans le planning
	
	// Ajout cartouches en stock
	
	// Ajout consommables en stock + utilis�

	// Ajout de documents + link aux elements
	
	// Ajout contacts
	
	// Ajout contrats 

	// Ajout d'infocoms aux elements
	
	// Ajout des periphs internes
	
	// Ajout logiciels + licences associ�s a divers PCs
	
	// Assoc des VLAN par regroupement de lieux

?>

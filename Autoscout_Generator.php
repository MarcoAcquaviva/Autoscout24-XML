<?php
/*
Plugin Name: IMDW Autoscout24 XML
Version: 1.0
Description: Questo plugin ti permette di creare gli XML da poter inviare ad autoscout24. 
Author: Marco Acquaviva
*/

$servername = "localhost";
$username = "";
$password = "";
$db = '';
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
/*echo "Connected successfully";*/
	

	$sql = "SELECT * FROM your_table ";
	$result = $conn->query($sql);
	
	$xml=new DOMDocument('1.0', 'UTF-8');
	$xml->formatOutput=true;
	$stx = $xml->createElement("stx3");
	$stx = $xml->appendChild($stx);
	$stx->setAttribute("xmlns:xsi", "https://www.w3.org/2001/XMLSchema-instance");
	
	$vehicle_data = $xml->createElement("vehicle_data");
	$vehicle_data = $stx->appendChild($vehicle_data);
	
	$vehicles = $xml->createElement("vehicles");
	$vehicles = $vehicle_data->appendChild($vehicles);


	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$vehicle = $xml->createElement("vehicle");
	$vehicle = $vehicles->appendChild($vehicle);
	$vehicle->appendChild($xml->createElement('dealer_id', $row['dealer_id']));
	$vehicle->appendChild($xml->createElement('ownersvehicle_id', $row['id']));
	$vehicle->appendChild($xml->createElement('status', $row['Status']));
	$vehicle->appendChild($xml->createElement('visibility', $row['visibility']));	
	$vehicle->appendChild($xml->createElement('type', $row['type']));
	$vehicle->appendChild($xml->createElement('category', $row['category']));
	$vehicle->appendChild($xml->createElement('body', $row['body']));
	$vehicle->appendChild($xml->createElement('brand', $row['brand']));
	$vehicle->appendChild($xml->createElement('model', $row['model']));
	$versione = $row['version'];
	if (!empty($versione)){
	$version01 = html_entity_decode($row['version']);
	$vehicle->appendChild($xml->createElement('version', $version01));
	};
	$vehicle->appendChild($xml->createElement('body_colorgroup', $row['body_colorgroup']));
	$vehicle->appendChild($xml->createElement('body_painting', $row['body_painting']));
	$vehicle->appendChild($xml->createElement('interior_color', $row['interior_color']));
	$vehicle->appendChild($xml->createElement('doors', $row['doors']));
	$vehicle->appendChild($xml->createElement('gear_type', $row['gear_type']));
	$vehicle->appendChild($xml->createElement('gears', $row['gears']));
	$vehicle->appendChild($xml->createElement('fuel_type', $row['fuel_type']));
	$vehicle->appendChild($xml->createElement('transmission', $row['transmission']));
	$vehicle->appendChild($xml->createElement('capacity', $row['capacity']));
	$vehicle->appendChild($xml->createElement('kilowatt', $row['kilowatt']));
	$vehicle->appendChild($xml->createElement('cylinder', $row['cylinder']));
	$consumption = $xml->createElement("consumption");
	$consumption = $vehicle->appendChild($consumption);
	$liquid = $xml->createElement("liquid");
	$liquid = $consumption->appendChild($liquid);
	$liquid->appendChild($xml->createElement('urban', $row['urban_consum']));
	$liquid->appendChild($xml->createElement('extra_urban', $row['extra_consum']));
	$emission = $xml->createElement("emission");
	$emission = $vehicle->appendChild($emission);
	$emission->appendChild($xml->createElement('class', $row['class_emission']));
	$emission->appendChild($xml->createElement('co2_gas', $row['co_liquid']));
	$vehicle->appendChild($xml->createElement('mileage', $row['mileage']));
	$vehicle->appendChild($xml->createElement('initial_registration', $row['initial_registration']));
	$welcome01 = /$row['welcome'];
	
	$description01 = htmlspecialchars_decode($row['notes']);

	$notes = $vehicle->appendChild($xml->createElement('notes'));
	$notes->appendChild($xml->createCDATASection($welcome01 . "<br>" . $description01));
	$prices = $xml->createElement("prices");
	$prices = $vehicle->appendChild($prices);
	$price = $xml->createElement("price");
	$price = $prices->appendChild($price);
	$price->appendChild($xml->createElement('type', $row['price_type']));
	$price->appendChild($xml->createElement('currency', $row['price_currency']));
	$price->appendChild($xml->createElement('value', $row['price_value']));
	/*nodo equipment*/
		/*test global equip*/
$equip="select id, SUBSTRING_INDEX( `equipment_text` , \",\", 1 ) AS equip1,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 2), \",\" , -1 ) AS equip2,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 3), \",\" , -1 ) AS equip3,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 4), \",\" , -1 ) AS equip4,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 5), \",\" , -1 ) AS equip5,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 6), \",\" , -1 ) AS equip6,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 7), \",\" , -1 ) AS equip7,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 8), \",\" , -1 ) AS equip8,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 9), \",\" , -1 ) AS equip9,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 10), \",\" , -1 ) AS equip10,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 11), \",\" , -1 ) AS equip11,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 12), \",\" , -1 ) AS equip12,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 13), \",\" , -1 ) AS equip13,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 14), \",\" , -1 ) AS equip14,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 15), \",\" , -1 ) AS equip15,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 16), \",\" , -1 ) AS equip16,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 17), \",\" , -1 ) AS equip17,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 18), \",\" , -1 ) AS equip18,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 19), \",\" , -1 ) AS equip19,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 20), \",\" , -1 ) AS equip20,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 21), \",\" , -1 ) AS equip21,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 22), \",\" , -1 ) AS equip22,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 23), \",\" , -1 ) AS equip23,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 24), \",\" , -1 ) AS equip24,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 25), \",\" , -1 ) AS equip25,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 26), \",\" , -1 ) AS equip26,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 27), \",\" , -1 ) AS equip27,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 28), \",\" , -1 ) AS equip28,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 29), \",\" , -1 ) AS equip29,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 30), \",\" , -1 ) AS equip30,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 31), \",\" , -1 ) AS equip31,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 32), \",\" , -1 ) AS equip32,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 33), \",\" , -1 ) AS equip33,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 34), \",\" , -1 ) AS equip34,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 35), \",\" , -1 ) AS equip35,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 36), \",\" , -1 ) AS equip36,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 37), \",\" , -1 ) AS equip37,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 38), \",\" , -1 ) AS equip38,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 39), \",\" , -1 ) AS equip39,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 40), \",\" , -1 ) AS equip40,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 41), \",\" , -1 ) AS equip41,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 42), \",\" , -1 ) AS equip42,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 43), \",\" , -1 ) AS equip43,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 44), \",\" , -1 ) AS equip44,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 45), \",\" , -1 ) AS equip45,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 46), \",\" , -1 ) AS equip46,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 47), \",\" , -1 ) AS equip47,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 48), \",\" , -1 ) AS equip48,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 49), \",\" , -1 ) AS equip49,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 50), \",\" , -1 ) AS equip50,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 51), \",\" , -1 ) AS equip51,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 52), \",\" , -1 ) AS equip52,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 53), \",\" , -1 ) AS equip53,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 54), \",\" , -1 ) AS equip54,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 55), \",\" , -1 ) AS equip55,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 56), \",\" , -1 ) AS equip56,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 57), \",\" , -1 ) AS equip57,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 58), \",\" , -1 ) AS equip58,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 59), \",\" , -1 ) AS equip59,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 60), \",\" , -1 ) AS equip60,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 61), \",\" , -1 ) AS equip61,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 62), \",\" , -1 ) AS equip62,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 63), \",\" , -1 ) AS equip63,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 64), \",\" , -1 ) AS equip64,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 65), \",\" , -1 ) AS equip65,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 66), \",\" , -1 ) AS equip66,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 67), \",\" , -1 ) AS equip67,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 68), \",\" , -1 ) AS equip68,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 69), \",\" , -1 ) AS equip69,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 70), \",\" , -1 ) AS equip70,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 71), \",\" , -1 ) AS equip71,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 72), \",\" , -1 ) AS equip72,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 73), \",\" , -1 ) AS equip73,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 74), \",\" , -1 ) AS equip74,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 75), \",\" , -1 ) AS equip75,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 76), \",\" , -1 ) AS equip76,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 77), \",\" , -1 ) AS equip77,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 78), \",\" , -1 ) AS equip78,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 79), \",\" , -1 ) AS equip79,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 80), \",\" , -1 ) AS equip80,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 81), \",\" , -1 ) AS equip81,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 82), \",\" , -1 ) AS equip82,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 83), \",\" , -1 ) AS equip83,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 84), \",\" , -1 ) AS equip84,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 85), \",\" , -1 ) AS equip85,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 86), \",\" , -1 ) AS equip86,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 87), \",\" , -1 ) AS equip87,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 88), \",\" , -1 ) AS equip88,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 89), \",\" , -1 ) AS equip89,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 90), \",\" , -1 ) AS equip90,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 91), \",\" , -1 ) AS equip91,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 92), \",\" , -1 ) AS equip92,
SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 93), \",\" , -1 ) AS equip93
from scude_autoscout
where id =" . $row['id'] ;
	
	/*fine test global equip*/	

	
	/*test nodo equip*/
$equip1="select id, SUBSTRING_INDEX( `equipment_text` , \",\", 1 ) AS equip1 
from scude_autoscout "; 
$requip1= $conn->query($equip1);
$equip2="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 2), \",\" , -1 ) AS equip2
from scude_autoscout"; 
$requip2= $conn->query($equip2);
$equip3="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 3), \",\" , -1 ) AS equip3
from scude_autoscout"; 
$requip3= $conn->query($equip3);
$equip4="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 4), \",\" , -1 ) AS equip4
from scude_autoscout"; 
$requip4= $conn->query($equip4);
$equip5="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 5), \",\" , -1 ) AS equip5
from scude_autoscout"; 
$requip5= $conn->query($equip5);
$equip6="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 6), \",\" , -1 ) AS equip6
from scude_autoscout"; 
$requip6= $conn->query($equip6);
$equip7="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 7), \",\" , -1 ) AS equip7
from scude_autoscout"; 
$requip7= $conn->query($equip7);
$equip8="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 8), \",\" , -1 ) AS equip8
from scude_autoscout"; 
$requip8= $conn->query($equip8);
$equip9="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 9), \",\" , -1 ) AS equip9
from scude_autoscout"; 
$requip9= $conn->query($equip9);
$equip10="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 10), \",\" , -1 ) AS equip10
from scude_autoscout"; 
$requip10= $conn->query($equip10);
$equip11="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 11), \",\" , -1 ) AS equip11
from scude_autoscout"; 
$requip11= $conn->query($equip11);
$equip12="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 12), \",\" , -1 ) AS equip12
from scude_autoscout"; 
$requip12= $conn->query($equip12);
$equip13="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 13), \",\" , -1 ) AS equip13
from scude_autoscout"; 
$requip13= $conn->query($equip13);
$equip14="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 14), \",\" , -1 ) AS equip14
from scude_autoscout"; 
$requip14= $conn->query($equip14);
$equip15="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 15), \",\" , -1 ) AS equip15
from scude_autoscout"; 
$requip15= $conn->query($equip15);
$equip16="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 16), \",\" , -1 ) AS equip16
from scude_autoscout"; 
$requip16= $conn->query($equip16);
$equip17="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 17), \",\" , -1 ) AS equip17
from scude_autoscout"; 
$requip17= $conn->query($equip17);
$equip18="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 18), \",\" , -1 ) AS equip18
from scude_autoscout"; 
$requip18= $conn->query($equip18);
$equip19="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 19), \",\" , -1 ) AS equip19
from scude_autoscout"; 
$requip19= $conn->query($equip19);
$equip20="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 20), \",\" , -1 ) AS equip20
from scude_autoscout"; 
$requip20= $conn->query($equip20);
$equip21="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 21), \",\" , -1 ) AS equip21
from scude_autoscout"; 
$requip21= $conn->query($equip21);
$equip22="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 22), \",\" , -1 ) AS equip22
from scude_autoscout"; 
$requip22= $conn->query($equip22);
$equip23="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 23), \",\" , -1 ) AS equip23
from scude_autoscout"; 
$requip23= $conn->query($equip23);
$equip24="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 24), \",\" , -1 ) AS equip24
from scude_autoscout"; 
$requip24= $conn->query($equip24);
$equip25="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 25), \",\" , -1 ) AS equip25
from scude_autoscout"; 
$requip25= $conn->query($equip25);
$equip26="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 26), \",\" , -1 ) AS equip26
from scude_autoscout"; 
$requip26= $conn->query($equip26);
$equip27="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 27), \",\" , -1 ) AS equip27
from scude_autoscout"; 
$requip27= $conn->query($equip27);
$equip28="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 28), \",\" , -1 ) AS equip28
from scude_autoscout"; 
$requip28= $conn->query($equip28);
$equip29="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 29), \",\" , -1 ) AS equip29
from scude_autoscout"; 
$requip29= $conn->query($equip29);
$equip30="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 30), \",\" , -1 ) AS equip30
from scude_autoscout"; 
$requip30= $conn->query($equip30);
$equip31="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 31), \",\" , -1 ) AS equip31
from scude_autoscout"; 
$requip31= $conn->query($equip31);
$equip32="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 32), \",\" , -1 ) AS equip32
from scude_autoscout"; 
$requip32= $conn->query($equip32);
$equip33="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 33), \",\" , -1 ) AS equip33
from scude_autoscout"; 
$requip33= $conn->query($equip33);
$equip34="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 34), \",\" , -1 ) AS equip34
from scude_autoscout"; 
$requip34= $conn->query($equip34);
$equip35="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 35), \",\" , -1 ) AS equip35
from scude_autoscout"; 
$requip35= $conn->query($equip35);
$equip36="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 36), \",\" , -1 ) AS equip36
from scude_autoscout"; 
$requip36= $conn->query($equip36);
$equip37="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 37), \",\" , -1 ) AS equip37
from scude_autoscout"; 
$requip37= $conn->query($equip37);
$equip38="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 38), \",\" , -1 ) AS equip38
from scude_autoscout"; 
$requip38= $conn->query($equip38);
$equip39="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 39), \",\" , -1 ) AS equip39
from scude_autoscout"; 
$requip39= $conn->query($equip39);
$equip40="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 40), \",\" , -1 ) AS equip40
from scude_autoscout"; 
$requip40= $conn->query($equip40);
$equip41="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 41), \",\" , -1 ) AS equip41
from scude_autoscout"; 
$requip41= $conn->query($equip41);
$equip42="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 42), \",\" , -1 ) AS equip42
from scude_autoscout"; 
$requip42= $conn->query($equip42);
$equip43="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 43), \",\" , -1 ) AS equip43
from scude_autoscout"; 
$requip43= $conn->query($equip43);
$equip44="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 44), \",\" , -1 ) AS equip44
from scude_autoscout"; 
$requip44= $conn->query($equip44);
$equip45="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 45), \",\" , -1 ) AS equip45
from scude_autoscout"; 
$requip45= $conn->query($equip45);
$equip46="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 46), \",\" , -1 ) AS equip46
from scude_autoscout"; 
$requip46= $conn->query($equip46);
$equip47="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 47), \",\" , -1 ) AS equip47
from scude_autoscout"; 
$requip47= $conn->query($equip47);
$equip48="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 48), \",\" , -1 ) AS equip48
from scude_autoscout"; 
$requip48= $conn->query($equip48);
$equip49="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 49), \",\" , -1 ) AS equip49
from scude_autoscout"; 
$requip49= $conn->query($equip49);
$equip50="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 50), \",\" , -1 ) AS equip50
from scude_autoscout"; 
$requip50= $conn->query($equip50);
$equip51="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 51), \",\" , -1 ) AS equip51
from scude_autoscout"; 
$requip51= $conn->query($equip51);
$equip52="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 52), \",\" , -1 ) AS equip52
from scude_autoscout"; 
$requip52= $conn->query($equip52);
$equip53="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 53), \",\" , -1 ) AS equip53
from scude_autoscout"; 
$requip53= $conn->query($equip53);
$equip54="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 54), \",\" , -1 ) AS equip54
from scude_autoscout"; 
$requip54= $conn->query($equip54);
$equip55="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 55), \",\" , -1 ) AS equip55
from scude_autoscout"; 
$requip55= $conn->query($equip55);
$equip56="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 56), \",\" , -1 ) AS equip56
from scude_autoscout"; 
$requip56= $conn->query($equip56);
$equip57="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 57), \",\" , -1 ) AS equip57
from scude_autoscout"; 
$requip57= $conn->query($equip57);
$equip58="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 58), \",\" , -1 ) AS equip58
from scude_autoscout"; 
$requip58= $conn->query($equip58);
$equip59="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 59), \",\" , -1 ) AS equip59
from scude_autoscout"; 
$requip59= $conn->query($equip59);
$equip60="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 60), \",\" , -1 ) AS equip60
from scude_autoscout"; 
$requip60= $conn->query($equip60);
$equip61="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 61), \",\" , -1 ) AS equip61
from scude_autoscout"; 
$requip61= $conn->query($equip61);
$equip62="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 62), \",\" , -1 ) AS equip62
from scude_autoscout"; 
$requip62= $conn->query($equip62);
$equip63="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 63), \",\" , -1 ) AS equip63
from scude_autoscout"; 
$requip63= $conn->query($equip63);
$equip64="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 64), \",\" , -1 ) AS equip64
from scude_autoscout"; 
$requip64= $conn->query($equip64);
$equip65="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 65), \",\" , -1 ) AS equip65
from scude_autoscout"; 
$requip65= $conn->query($equip65);
$equip66="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 66), \",\" , -1 ) AS equip66
from scude_autoscout"; 
$requip66= $conn->query($equip66);
$equip67="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 67), \",\" , -1 ) AS equip67
from scude_autoscout"; 
$requip67= $conn->query($equip67);
$equip68="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 68), \",\" , -1 ) AS equip68
from scude_autoscout"; 
$requip68= $conn->query($equip68);
$equip69="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 69), \",\" , -1 ) AS equip69
from scude_autoscout"; 
$requip69= $conn->query($equip69);
$equip70="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 70), \",\" , -1 ) AS equip70
from scude_autoscout"; 
$requip70= $conn->query($equip70);
$equip71="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 71), \",\" , -1 ) AS equip71
from scude_autoscout"; 
$requip71= $conn->query($equip71);
$equip72="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 72), \",\" , -1 ) AS equip72
from scude_autoscout"; 
$requip72= $conn->query($equip72);
$equip73="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 73), \",\" , -1 ) AS equip73
from scude_autoscout"; 
$requip73= $conn->query($equip73);
$equip74="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 74), \",\" , -1 ) AS equip74
from scude_autoscout"; 
$requip74= $conn->query($equip74);
$equip75="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 75), \",\" , -1 ) AS equip75
from scude_autoscout"; 
$requip75= $conn->query($equip75);
$equip76="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 76), \",\" , -1 ) AS equip76
from scude_autoscout"; 
$requip76= $conn->query($equip76);
$equip77="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 77), \",\" , -1 ) AS equip77
from scude_autoscout"; 
$requip77= $conn->query($equip77);
$equip78="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 78), \",\" , -1 ) AS equip78
from scude_autoscout"; 
$requip78= $conn->query($equip78);
$equip79="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 79), \",\" , -1 ) AS equip79
from scude_autoscout"; 
$requip79= $conn->query($equip79);
$equip80="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 80), \",\" , -1 ) AS equip80
from scude_autoscout"; 
$requip80= $conn->query($equip80);
$equip81="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 81), \",\" , -1 ) AS equip81
from scude_autoscout"; 
$requip81= $conn->query($equip81);
$equip82="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 82), \",\" , -1 ) AS equip82
from scude_autoscout"; 
$requip82= $conn->query($equip82);
$equip83="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 83), \",\" , -1 ) AS equip83
from scude_autoscout"; 
$requip83= $conn->query($equip83);
$equip84="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 84), \",\" , -1 ) AS equip84
from scude_autoscout"; 
$requip84= $conn->query($equip84);
$equip85="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 85), \",\" , -1 ) AS equip85
from scude_autoscout"; 
$requip85= $conn->query($equip85);
$equip86="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 86), \",\" , -1 ) AS equip86
from scude_autoscout"; 
$requip86= $conn->query($equip86);
$equip87="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 87), \",\" , -1 ) AS equip87
from scude_autoscout"; 
$requip87= $conn->query($equip87);
$equip88="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 88), \",\" , -1 ) AS equip88
from scude_autoscout"; 
$requip88= $conn->query($equip88);
$equip89="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 89), \",\" , -1 ) AS equip89
from scude_autoscout"; 
$requip89= $conn->query($equip89);
$equip90="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 90), \",\" , -1 ) AS equip90
from scude_autoscout"; 
$requip90= $conn->query($equip90);
$equip91="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 91), \",\" , -1 ) AS equip91
from scude_autoscout"; 
$requip91= $conn->query($equip91);
$equip92="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 92), \",\" , -1 ) AS equip92
from scude_autoscout"; 
$requip92= $conn->query($equip92);
$equip93="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `equipment_text` , \",\", 93), \",\" , -1 ) AS equip93
from scude_autoscout"; 
$requip93= $conn->query($equip93);
$equipments = $xml->createElement("equipments");
$equipments = $vehicle->appendChild($equipments);
$requip = $conn->query($equip);
if ($requip->num_rows>0){ //loop query equip
while ($row_equip= $requip->fetch_assoc()){	//loop query equip
if ($requip93->num_rows>0){
while ($row_equip93= $requip93->fetch_assoc()){
if  ($row_equip93["id"] === $row["id"]){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip93["equip93"]));
};
};
};
if ($requip92->num_rows>0){
while ($row_equip92= $requip92->fetch_assoc()){
if (($row_equip["equip93"]<> $row_equip92["equip92"]) and ($row_equip92["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip92["equip92"]));
};
};
};
if ($requip91->num_rows>0){
while ($row_equip91= $requip91->fetch_assoc()){
if (($row_equip["equip92"]<> $row_equip91["equip91"]) and ($row_equip91["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip91["equip91"]));
};
};
};
if ($requip90->num_rows>0){
while ($row_equip90= $requip90->fetch_assoc()){
if (($row_equip["equip91"]<> $row_equip90["equip90"]) and ($row_equip90["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip90["equip90"]));
};
};
};
if ($requip89->num_rows>0){
while ($row_equip89= $requip89->fetch_assoc()){
if (($row_equip["equip90"]<> $row_equip89["equip89"]) and ($row_equip89["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip89["equip89"]));
};
};
};
if ($requip88->num_rows>0){
while ($row_equip88= $requip88->fetch_assoc()){
if (($row_equip["equip89"]<> $row_equip88["equip88"]) and ($row_equip88["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip88["equip88"]));
};
};
};
if ($requip87->num_rows>0){
while ($row_equip87= $requip87->fetch_assoc()){
if (($row_equip["equip88"]<> $row_equip87["equip87"]) and ($row_equip87["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip87["equip87"]));
};
};
};
if ($requip86->num_rows>0){
while ($row_equip86= $requip86->fetch_assoc()){
if (($row_equip["equip87"]<> $row_equip86["equip86"]) and ($row_equip86["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip86["equip86"]));
};
};
};
if ($requip85->num_rows>0){
while ($row_equip85= $requip85->fetch_assoc()){
if (($row_equip["equip86"]<> $row_equip85["equip85"]) and ($row_equip85["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip85["equip85"]));
};
};
};
if ($requip84->num_rows>0){
while ($row_equip84= $requip84->fetch_assoc()){
if (($row_equip["equip85"]<> $row_equip84["equip84"]) and ($row_equip84["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip84["equip84"]));
};
};
};
if ($requip83->num_rows>0){
while ($row_equip83= $requip83->fetch_assoc()){
if (($row_equip["equip84"]<> $row_equip83["equip83"]) and ($row_equip83["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip83["equip83"]));
};
};
};
if ($requip82->num_rows>0){
while ($row_equip82= $requip82->fetch_assoc()){
if (($row_equip["equip83"]<> $row_equip82["equip82"]) and ($row_equip82["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip82["equip82"]));
};
};
};
if ($requip81->num_rows>0){
while ($row_equip81= $requip81->fetch_assoc()){
if (($row_equip["equip82"]<> $row_equip81["equip81"]) and ($row_equip81["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip81["equip81"]));
};
};
};
if ($requip80->num_rows>0){
while ($row_equip80= $requip80->fetch_assoc()){
if (($row_equip["equip81"]<> $row_equip80["equip80"]) and ($row_equip80["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip80["equip80"]));
};
};
};
if ($requip79->num_rows>0){
while ($row_equip79= $requip79->fetch_assoc()){
if (($row_equip["equip80"]<> $row_equip79["equip79"]) and ($row_equip79["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip79["equip79"]));
};
};
};
if ($requip78->num_rows>0){
while ($row_equip78= $requip78->fetch_assoc()){
if (($row_equip["equip79"]<> $row_equip78["equip78"]) and ($row_equip78["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip78["equip78"]));
};
};
};
if ($requip77->num_rows>0){
while ($row_equip77= $requip77->fetch_assoc()){
if (($row_equip["equip78"]<> $row_equip77["equip77"]) and ($row_equip77["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip77["equip77"]));
};
};
};
if ($requip76->num_rows>0){
while ($row_equip76= $requip76->fetch_assoc()){
if (($row_equip["equip77"]<> $row_equip76["equip76"]) and ($row_equip76["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip76["equip76"]));
};
};
};
if ($requip75->num_rows>0){
while ($row_equip75= $requip75->fetch_assoc()){
if (($row_equip["equip76"]<> $row_equip75["equip75"]) and ($row_equip75["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip75["equip75"]));
};
};
};
if ($requip74->num_rows>0){
while ($row_equip74= $requip74->fetch_assoc()){
if (($row_equip["equip75"]<> $row_equip74["equip74"]) and ($row_equip74["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip74["equip74"]));
};
};
};
if ($requip73->num_rows>0){
while ($row_equip73= $requip73->fetch_assoc()){
if (($row_equip["equip74"]<> $row_equip73["equip73"]) and ($row_equip73["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip73["equip73"]));
};
};
};
if ($requip72->num_rows>0){
while ($row_equip72= $requip72->fetch_assoc()){
if (($row_equip["equip73"]<> $row_equip72["equip72"]) and ($row_equip72["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip72["equip72"]));
};
};
};
if ($requip71->num_rows>0){
while ($row_equip71= $requip71->fetch_assoc()){
if (($row_equip["equip72"]<> $row_equip71["equip71"]) and ($row_equip71["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip71["equip71"]));
};
};
};
if ($requip70->num_rows>0){
while ($row_equip70= $requip70->fetch_assoc()){
if (($row_equip["equip71"]<> $row_equip70["equip70"]) and ($row_equip70["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip70["equip70"]));
};
};
};
if ($requip69->num_rows>0){
while ($row_equip69= $requip69->fetch_assoc()){
if (($row_equip["equip70"]<> $row_equip69["equip69"]) and ($row_equip69["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip69["equip69"]));
};
};
};
if ($requip68->num_rows>0){
while ($row_equip68= $requip68->fetch_assoc()){
if (($row_equip["equip69"]<> $row_equip68["equip68"]) and ($row_equip68["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip68["equip68"]));
};
};
};
if ($requip67->num_rows>0){
while ($row_equip67= $requip67->fetch_assoc()){
if (($row_equip["equip68"]<> $row_equip67["equip67"]) and ($row_equip67["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip67["equip67"]));
};
};
};
if ($requip66->num_rows>0){
while ($row_equip66= $requip66->fetch_assoc()){
if (($row_equip["equip67"]<> $row_equip66["equip66"]) and ($row_equip66["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip66["equip66"]));
};
};
};
if ($requip65->num_rows>0){
while ($row_equip65= $requip65->fetch_assoc()){
if (($row_equip["equip66"]<> $row_equip65["equip65"]) and ($row_equip65["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip65["equip65"]));
};
};
};
if ($requip64->num_rows>0){
while ($row_equip64= $requip64->fetch_assoc()){
if (($row_equip["equip65"]<> $row_equip64["equip64"]) and ($row_equip64["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip64["equip64"]));
};
};
};
if ($requip63->num_rows>0){
while ($row_equip63= $requip63->fetch_assoc()){
if (($row_equip["equip64"]<> $row_equip63["equip63"]) and ($row_equip63["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip63["equip63"]));
};
};
};
if ($requip62->num_rows>0){
while ($row_equip62= $requip62->fetch_assoc()){
if (($row_equip["equip63"]<> $row_equip62["equip62"]) and ($row_equip62["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip62["equip62"]));
};
};
};
if ($requip61->num_rows>0){
while ($row_equip61= $requip61->fetch_assoc()){
if (($row_equip["equip62"]<> $row_equip61["equip61"]) and ($row_equip61["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip61["equip61"]));
};
};
};
if ($requip60->num_rows>0){
while ($row_equip60= $requip60->fetch_assoc()){
if (($row_equip["equip61"]<> $row_equip60["equip60"]) and ($row_equip60["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip60["equip60"]));
};
};
};
if ($requip59->num_rows>0){
while ($row_equip59= $requip59->fetch_assoc()){
if (($row_equip["equip60"]<> $row_equip59["equip59"]) and ($row_equip59["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip59["equip59"]));
};
};
};
if ($requip58->num_rows>0){
while ($row_equip58= $requip58->fetch_assoc()){
if (($row_equip["equip59"]<> $row_equip58["equip58"]) and ($row_equip58["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip58["equip58"]));
};
};
};
if ($requip57->num_rows>0){
while ($row_equip57= $requip57->fetch_assoc()){
if (($row_equip["equip58"]<> $row_equip57["equip57"]) and ($row_equip57["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip57["equip57"]));
};
};
};
if ($requip56->num_rows>0){
while ($row_equip56= $requip56->fetch_assoc()){
if (($row_equip["equip57"]<> $row_equip56["equip56"]) and ($row_equip56["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip56["equip56"]));
};
};
};
if ($requip55->num_rows>0){
while ($row_equip55= $requip55->fetch_assoc()){
if (($row_equip["equip56"]<> $row_equip55["equip55"]) and ($row_equip55["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip55["equip55"]));
};
};
};
if ($requip54->num_rows>0){
while ($row_equip54= $requip54->fetch_assoc()){
if (($row_equip["equip55"]<> $row_equip54["equip54"]) and ($row_equip54["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip54["equip54"]));
};
};
};
if ($requip53->num_rows>0){
while ($row_equip53= $requip53->fetch_assoc()){
if (($row_equip["equip54"]<> $row_equip53["equip53"]) and ($row_equip53["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip53["equip53"]));
};
};
};
if ($requip52->num_rows>0){
while ($row_equip52= $requip52->fetch_assoc()){
if (($row_equip["equip53"]<> $row_equip52["equip52"]) and ($row_equip52["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip52["equip52"]));
};
};
};
if ($requip51->num_rows>0){
while ($row_equip51= $requip51->fetch_assoc()){
if (($row_equip["equip52"]<> $row_equip51["equip51"]) and ($row_equip51["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip51["equip51"]));
};
};
};
if ($requip50->num_rows>0){
while ($row_equip50= $requip50->fetch_assoc()){
if (($row_equip["equip51"]<> $row_equip50["equip50"]) and ($row_equip50["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip50["equip50"]));
};
};
};
if ($requip49->num_rows>0){
while ($row_equip49= $requip49->fetch_assoc()){
if (($row_equip["equip50"]<> $row_equip49["equip49"]) and ($row_equip49["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip49["equip49"]));
};
};
};
if ($requip48->num_rows>0){
while ($row_equip48= $requip48->fetch_assoc()){
if (($row_equip["equip49"]<> $row_equip48["equip48"]) and ($row_equip48["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip48["equip48"]));
};
};
};
if ($requip47->num_rows>0){
while ($row_equip47= $requip47->fetch_assoc()){
if (($row_equip["equip48"]<> $row_equip47["equip47"]) and ($row_equip47["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip47["equip47"]));
};
};
};
if ($requip46->num_rows>0){
while ($row_equip46= $requip46->fetch_assoc()){
if (($row_equip["equip47"]<> $row_equip46["equip46"]) and ($row_equip46["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip46["equip46"]));
};
};
};
if ($requip45->num_rows>0){
while ($row_equip45= $requip45->fetch_assoc()){
if (($row_equip["equip46"]<> $row_equip45["equip45"]) and ($row_equip45["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip45["equip45"]));
};
};
};
if ($requip44->num_rows>0){
while ($row_equip44= $requip44->fetch_assoc()){
if (($row_equip["equip45"]<> $row_equip44["equip44"]) and ($row_equip44["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip44["equip44"]));
};
};
};
if ($requip43->num_rows>0){
while ($row_equip43= $requip43->fetch_assoc()){
if (($row_equip["equip44"]<> $row_equip43["equip43"]) and ($row_equip43["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip43["equip43"]));
};
};
};
if ($requip42->num_rows>0){
while ($row_equip42= $requip42->fetch_assoc()){
if (($row_equip["equip43"]<> $row_equip42["equip42"]) and ($row_equip42["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip42["equip42"]));
};
};
};
if ($requip41->num_rows>0){
while ($row_equip41= $requip41->fetch_assoc()){
if (($row_equip["equip42"]<> $row_equip41["equip41"]) and ($row_equip41["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip41["equip41"]));
};
};
};
if ($requip40->num_rows>0){
while ($row_equip40= $requip40->fetch_assoc()){
if (($row_equip["equip41"]<> $row_equip40["equip40"]) and ($row_equip40["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip40["equip40"]));
};
};
};
if ($requip39->num_rows>0){
while ($row_equip39= $requip39->fetch_assoc()){
if (($row_equip["equip40"]<> $row_equip39["equip39"]) and ($row_equip39["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip39["equip39"]));
};
};
};
if ($requip38->num_rows>0){
while ($row_equip38= $requip38->fetch_assoc()){
if (($row_equip["equip39"]<> $row_equip38["equip38"]) and ($row_equip38["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip38["equip38"]));
};
};
};
if ($requip37->num_rows>0){
while ($row_equip37= $requip37->fetch_assoc()){
if (($row_equip["equip38"]<> $row_equip37["equip37"]) and ($row_equip37["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip37["equip37"]));
};
};
};
if ($requip36->num_rows>0){
while ($row_equip36= $requip36->fetch_assoc()){
if (($row_equip["equip37"]<> $row_equip36["equip36"]) and ($row_equip36["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip36["equip36"]));
};
};
};
if ($requip35->num_rows>0){
while ($row_equip35= $requip35->fetch_assoc()){
if (($row_equip["equip36"]<> $row_equip35["equip35"]) and ($row_equip35["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip35["equip35"]));
};
};
};
if ($requip34->num_rows>0){
while ($row_equip34= $requip34->fetch_assoc()){
if (($row_equip["equip35"]<> $row_equip34["equip34"]) and ($row_equip34["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip34["equip34"]));
};
};
};
if ($requip33->num_rows>0){
while ($row_equip33= $requip33->fetch_assoc()){
if (($row_equip["equip34"]<> $row_equip33["equip33"]) and ($row_equip33["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip33["equip33"]));
};
};
};
if ($requip32->num_rows>0){
while ($row_equip32= $requip32->fetch_assoc()){
if (($row_equip["equip33"]<> $row_equip32["equip32"]) and ($row_equip32["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip32["equip32"]));
};
};
};
if ($requip31->num_rows>0){
while ($row_equip31= $requip31->fetch_assoc()){
if (($row_equip["equip32"]<> $row_equip31["equip31"]) and ($row_equip31["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip31["equip31"]));
};
};
};
if ($requip30->num_rows>0){
while ($row_equip30= $requip30->fetch_assoc()){
if (($row_equip["equip31"]<> $row_equip30["equip30"]) and ($row_equip30["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip30["equip30"]));
};
};
};
if ($requip29->num_rows>0){
while ($row_equip29= $requip29->fetch_assoc()){
if (($row_equip["equip30"]<> $row_equip29["equip29"]) and ($row_equip29["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip29["equip29"]));
};
};
};
if ($requip28->num_rows>0){
while ($row_equip28= $requip28->fetch_assoc()){
if (($row_equip["equip29"]<> $row_equip28["equip28"]) and ($row_equip28["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip28["equip28"]));
};
};
};
if ($requip27->num_rows>0){
while ($row_equip27= $requip27->fetch_assoc()){
if (($row_equip["equip28"]<> $row_equip27["equip27"]) and ($row_equip27["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip27["equip27"]));
};
};
};
if ($requip26->num_rows>0){
while ($row_equip26= $requip26->fetch_assoc()){
if (($row_equip["equip27"]<> $row_equip26["equip26"]) and ($row_equip26["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip26["equip26"]));
};
};
};
if ($requip25->num_rows>0){
while ($row_equip25= $requip25->fetch_assoc()){
if (($row_equip["equip26"]<> $row_equip25["equip25"]) and ($row_equip25["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip25["equip25"]));
};
};
};
if ($requip24->num_rows>0){
while ($row_equip24= $requip24->fetch_assoc()){
if (($row_equip["equip25"]<> $row_equip24["equip24"]) and ($row_equip24["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip24["equip24"]));
};
};
};
if ($requip23->num_rows>0){
while ($row_equip23= $requip23->fetch_assoc()){
if (($row_equip["equip24"]<> $row_equip23["equip23"]) and ($row_equip23["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip23["equip23"]));
};
};
};
if ($requip22->num_rows>0){
while ($row_equip22= $requip22->fetch_assoc()){
if (($row_equip["equip23"]<> $row_equip22["equip22"]) and ($row_equip22["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip22["equip22"]));
};
};
};
if ($requip21->num_rows>0){
while ($row_equip21= $requip21->fetch_assoc()){
if (($row_equip["equip22"]<> $row_equip21["equip21"]) and ($row_equip21["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip21["equip21"]));
};
};
};
if ($requip20->num_rows>0){
while ($row_equip20= $requip20->fetch_assoc()){
if (($row_equip["equip21"]<> $row_equip20["equip20"]) and ($row_equip20["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip20["equip20"]));
};
};
};
if ($requip19->num_rows>0){
while ($row_equip19= $requip19->fetch_assoc()){
if (($row_equip["equip20"]<> $row_equip19["equip19"]) and ($row_equip19["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip19["equip19"]));
};
};
};
if ($requip18->num_rows>0){
while ($row_equip18= $requip18->fetch_assoc()){
if (($row_equip["equip19"]<> $row_equip18["equip18"]) and ($row_equip18["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip18["equip18"]));
};
};
};
if ($requip17->num_rows>0){
while ($row_equip17= $requip17->fetch_assoc()){
if (($row_equip["equip18"]<> $row_equip17["equip17"]) and ($row_equip17["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip17["equip17"]));
};
};
};
if ($requip16->num_rows>0){
while ($row_equip16= $requip16->fetch_assoc()){
if (($row_equip["equip17"]<> $row_equip16["equip16"]) and ($row_equip16["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip16["equip16"]));
};
};
};
if ($requip15->num_rows>0){
while ($row_equip15= $requip15->fetch_assoc()){
if (($row_equip["equip16"]<> $row_equip15["equip15"]) and ($row_equip15["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip15["equip15"]));
};
};
};
if ($requip14->num_rows>0){
while ($row_equip14= $requip14->fetch_assoc()){
if (($row_equip["equip15"]<> $row_equip14["equip14"]) and ($row_equip14["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip14["equip14"]));
};
};
};
if ($requip13->num_rows>0){
while ($row_equip13= $requip13->fetch_assoc()){
if (($row_equip["equip14"]<> $row_equip13["equip13"]) and ($row_equip13["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip13["equip13"]));
};
};
};
if ($requip12->num_rows>0){
while ($row_equip12= $requip12->fetch_assoc()){
if (($row_equip["equip13"]<> $row_equip12["equip12"]) and ($row_equip12["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip12["equip12"]));
};
};
};
if ($requip11->num_rows>0){
while ($row_equip11= $requip11->fetch_assoc()){
if (($row_equip["equip12"]<> $row_equip11["equip11"]) and ($row_equip11["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip11["equip11"]));
};
};
};
if ($requip10->num_rows>0){
while ($row_equip10= $requip10->fetch_assoc()){
if (($row_equip["equip11"]<> $row_equip10["equip10"]) and ($row_equip10["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip10["equip10"]));
};
};
};
if ($requip9->num_rows>0){
while ($row_equip9= $requip9->fetch_assoc()){
if (($row_equip["equip10"]<> $row_equip9["equip9"]) and ($row_equip9["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip9["equip9"]));
};
};
};
if ($requip8->num_rows>0){
while ($row_equip8= $requip8->fetch_assoc()){
if (($row_equip["equip9"]<> $row_equip8["equip8"]) and ($row_equip8["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip8["equip8"]));
};
};
};
if ($requip7->num_rows>0){
while ($row_equip7= $requip7->fetch_assoc()){
if (($row_equip["equip8"]<> $row_equip7["equip7"]) and ($row_equip7["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip7["equip7"]));
};
};
};
if ($requip6->num_rows>0){
while ($row_equip6= $requip6->fetch_assoc()){
if (($row_equip["equip7"]<> $row_equip6["equip6"]) and ($row_equip6["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip6["equip6"]));
};
};
};
if ($requip5->num_rows>0){
while ($row_equip5= $requip5->fetch_assoc()){
if (($row_equip["equip6"]<> $row_equip5["equip5"]) and ($row_equip5["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip5["equip5"]));
};
};
};
if ($requip4->num_rows>0){
while ($row_equip4= $requip4->fetch_assoc()){
if (($row_equip["equip5"]<> $row_equip4["equip4"]) and ($row_equip4["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip4["equip4"]));
};
};
};
if ($requip3->num_rows>0){
while ($row_equip3= $requip3->fetch_assoc()){
if (($row_equip["equip4"]<> $row_equip3["equip3"]) and ($row_equip3["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip3["equip3"]));
};
};
};
if ($requip2->num_rows>0){
while ($row_equip2= $requip2->fetch_assoc()){
if (($row_equip["equip3"]<> $row_equip2["equip2"]) and ($row_equip2["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip2["equip2"]));
};
};
};
if ($requip1->num_rows>0){
while ($row_equip1= $requip1->fetch_assoc()){
if (($row_equip["equip2"]<> $row_equip1["equip1"]) and ($row_equip1["id"] === $row["id"])){
$equipment = $xml->createElement("equipment");
$equipment = $equipments->appendChild($equipment);
$equipment->appendChild($xml->createElement("text", $row_equip1["equip1"]));
};
};
};

	/*fine test*/
}
}/*chiusura global equip*/	

	
		/*nodo media*/
	$media = $xml->createElement("media");
	$media = $vehicle->appendChild($media);
	$images = $xml->createElement("images");
	$images = $media->appendChild($images);
	//$image = $xml->createElement("image");//image in html diventa img
	//$image = $images->appendChild($image);
	
	/*global img*/
	$img="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 2), \"||\" , -1 ) AS img2,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 3), \"||\" , -1 ) AS img3,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 4), \"||\" , -1 ) AS img4,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 5), \"||\" , -1 ) AS img5,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 6), \"||\" , -1 ) AS img6,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 7), \"||\" , -1 ) AS img7,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 8), \"||\" , -1 ) AS img8,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 9), \"||\" , -1 ) AS img9,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 10), \"||\" , -1 ) AS img10,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 11), \"||\" , -1 ) AS img11,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 12), \"||\" , -1 ) AS img12,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 13), \"||\" , -1 ) AS img13,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 14), \"||\" , -1 ) AS img14,
SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 15), \"||\" , -1 ) AS img15
from scude_autoscout where id=" . $row["id"]; 
$rimg= $conn->query($img);
	/*fine global img*/
	
	/*immagine principale*/
$string = strpbrk(strpbrk(strpbrk($row['main_img'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m1)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_44/l_".$m1[1] ));
};
/*/immagine principale*/
	
	$img1="select id, SUBSTRING_INDEX( `images_image` , \"||\", 1 ) AS img1 from scude_autoscout where id =" . $row['id']; 
	$rimg1= $conn->query($img1);
	/*test img*/
	/*$str = "select images_image from scude_autoscout where id =" . $row['id'];
	$rimg= $conn->query($str);*/
/*single query*/
$img2="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 2), \"||\" , -1 ) AS img2
from scude_autoscout where id =" . $row['id'];
$rimg2= $conn->query($img2);
$img3="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 3), \"||\" , -1 ) AS img3
from scude_autoscout where id=" . $row["id"]; 
$rimg3= $conn->query($img3);
$img4="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 4), \"||\" , -1 ) AS img4
from scude_autoscout where id=" . $row["id"]; 
$rimg4= $conn->query($img4);
$img5="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 5), \"||\" , -1 ) AS img5
from scude_autoscout where id=" . $row["id"]; 
$rimg5= $conn->query($img5);
$img6="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 6), \"||\" , -1 ) AS img6
from scude_autoscout where id=" . $row["id"]; 
$rimg6= $conn->query($img6);
$img7="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 7), \"||\" , -1 ) AS img7
from scude_autoscout where id=" . $row["id"]; 
$rimg7= $conn->query($img7);
$img8="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 8), \"||\" , -1 ) AS img8
from scude_autoscout where id=" . $row["id"]; 
$rimg8= $conn->query($img8);
$img9="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 9), \"||\" , -1 ) AS img9
from scude_autoscout where id=" . $row["id"]; 
$rimg9= $conn->query($img9);
$img10="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 10), \"||\" , -1 ) AS img10
from scude_autoscout where id=" . $row["id"]; 
$rimg10= $conn->query($img10);
$img11="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 11), \"||\" , -1 ) AS img11
from scude_autoscout where id=" . $row["id"]; 
$rimg11= $conn->query($img11);
$img12="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 12), \"||\" , -1 ) AS img12
from scude_autoscout where id=" . $row["id"]; 
$rimg12= $conn->query($img12);
$img13="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 13), \"||\" , -1 ) AS img13
from scude_autoscout where id=" . $row["id"]; 
$rimg13= $conn->query($img13);
$img14="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 14), \"||\" , -1 ) AS img14
from scude_autoscout where id=" . $row["id"]; 
$rimg14= $conn->query($img14);
$img15="select id, SUBSTRING_INDEX( SUBSTRING_INDEX( `images_image` , \"||\", 15), \"||\" , -1 ) AS img15
from scude_autoscout where id=" . $row["id"]; 
$rimg15= $conn->query($img15);
/*fine single query*/



if ($rimg->num_rows>0){ //loop query equip
while ($row_img= $rimg->fetch_assoc()){	//loop query equip
/*gallery*/

if ($rimg1->num_rows>0){
	while ($row_img1= $rimg1->fetch_assoc()){
	$string = strpbrk(strpbrk(strpbrk($row_img1['img1'], ';'), '"'), '"');
	if (preg_match('/"([^"]+)"/', $string, $m1)) {
	/*echo $m[1] .'<br>';*/
		$image = $xml->createElement("image");//non mette image
	$image = $images->appendChild($image);
	$image->appendChild($xml->createElement('uri', 'http://scuderiasrl.it/images/stories/flexicontent/item_'.$row["id"].'_field_36/l_'.$m1[1]));
	} 
}
}

if ($rimg2->num_rows>0){
while ($row_img2= $rimg2->fetch_assoc()){
if (($row_img["img3"]<> $row_img2["img2"]) and ($row_img2["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img2['img2'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m2)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m2[1] ));
};
};
};
};
if ($rimg3->num_rows>0){
while ($row_img3= $rimg3->fetch_assoc()){
if (($row_img["img4"]<> $row_img3["img3"]) and ($row_img3["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img3['img3'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m3)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m3[1] ));
};
};
};
};
if ($rimg4->num_rows>0){
while ($row_img4= $rimg4->fetch_assoc()){
if (($row_img["img5"]<> $row_img4["img4"]) and ($row_img4["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img4['img4'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m4)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m4[1] ));
};
};
};
};
if ($rimg5->num_rows>0){
while ($row_img5= $rimg5->fetch_assoc()){
if (($row_img["img6"]<> $row_img5["img5"]) and ($row_img5["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img5['img5'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m5)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m5[1] ));
};
};
};
};
if ($rimg6->num_rows>0){
while ($row_img6= $rimg6->fetch_assoc()){
if (($row_img["img7"]<> $row_img6["img6"]) and ($row_img6["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img6['img6'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m6)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m6[1] ));
};
};
};
};
if ($rimg7->num_rows>0){
while ($row_img7= $rimg7->fetch_assoc()){
if (($row_img["img8"]<> $row_img7["img7"]) and ($row_img7["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img7['img7'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m7)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m7[1] ));
};
};
};
};
if ($rimg8->num_rows>0){
while ($row_img8= $rimg8->fetch_assoc()){
if (($row_img["img9"]<> $row_img8["img8"]) and ($row_img8["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img8['img8'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m8)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m8[1] ));
};
};
};
};
if ($rimg9->num_rows>0){
while ($row_img9= $rimg9->fetch_assoc()){
if (($row_img["img10"]<> $row_img9["img9"]) and ($row_img9["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img9['img9'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m9)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m9[1] ));
};
};
};
};
if ($rimg10->num_rows>0){
while ($row_img10= $rimg10->fetch_assoc()){
if (($row_img["img11"]<> $row_img10["img10"]) and ($row_img10["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img10['img10'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m10)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m10[1] ));
};
};
};
};
if ($rimg11->num_rows>0){
while ($row_img11= $rimg11->fetch_assoc()){
if (($row_img["img12"]<> $row_img11["img11"]) and ($row_img11["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img11['img11'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m11)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m11[1] ));
};
};
};
};
if ($rimg12->num_rows>0){
while ($row_img12= $rimg12->fetch_assoc()){
if (($row_img["img13"]<> $row_img12["img12"]) and ($row_img12["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img12['img12'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m12)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m12[1] ));
};
};
};
};
if ($rimg13->num_rows>0){
while ($row_img13= $rimg13->fetch_assoc()){
if (($row_img["img14"]<> $row_img13["img13"]) and ($row_img13["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img13['img13'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m13)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m13[1] ));
};
};
};
};
if ($rimg14->num_rows>0){
while ($row_img14= $rimg14->fetch_assoc()){
if (($row_img["img15"]<> $row_img14["img14"]) and ($row_img14["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img14['img14'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m14)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m14[1] ));
};
};
};
};
/*if ($rimg15->num_rows>0){
while ($row_img15= $rimg15->fetch_assoc()){
if (($row_img["img16"]<> $row_img15["img15"]) and ($row_img15["id"] === $row["id"])){
$string = strpbrk(strpbrk(strpbrk($row_img15['img15'], ';'), '"'),'"');
if (preg_match('/"([^"]+)"/', $string, $m15)) {
$image = $xml->createElement("image");
$image = $images->appendChild($image);
$image->appendChild($xml->createElement("uri", "http://scuderiasrl.it/images/stories/flexicontent/item_".$row["id"]."_field_36/l_".$m15[1] ));
};
};
};
};*/

/*/gallery*/
/*test img*/
	
	
	
}}//chiusura global img loop
	
		}
		}/*fine if*/ 
	else 
	{
    echo "0 results";
	};/*fine else*/
	
	echo $xml->saveXML();
	$xml->save("AS24.xml");

	
	$file ='AS24.xml';
	$remote_file = 'AS24.xml';
	$ftp_server= 'carupload.autoscout24.com';
	$ftp_user_name= '';
	$ftp_user_pass= '';

	$conn_id = ftp_connect($ftp_server);
	
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// upload a file
	if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
	echo "<br> <h1>File loading: $file successfull load\n</h1>";
	} else {
	echo "<br> <h1>There was a problem while uploading $file\n</h1>";
}

// close the connection
ftp_close($conn_id);
?>

<html>
<head>
<title> Autoscout24 </title>
<style>
stx3 {
    display: none;
}
</style>
</head>
<body>
<?php
echo ('
<a style="display:block;" href="http://'.$_SERVER[HTTP_HOST].'/administrator/index.php?option=com_flexicontent&view=items"><button type="button">Home </button></a>');
?>
</body>
</html>
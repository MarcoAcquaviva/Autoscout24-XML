<?php 
/****test*****/		
		// Get a db connection.
$db = JFactory::getDbo();
 

 /***Queries di paragone*/
$datauno = "
	select item_id
    from yourRoot_flexicontent_fields_item_relations, yourRoot_content
    where item_id = yourRoot_content.id
    group by id";
	
$datadue ="
	select id
    from yourRoot_autoscout
    group by id";
	
$db->setQuery((string)$datauno);
$resultuno = $db->loadObjectList();
$db->setQuery((string)$datadue);
$resultdue = $db->loadObjectList();

/*Pulizia tabella*/
$truncate =" truncate yourRoot_autoscout";
	
  $db->setQuery($truncate);
  $db->execute();
	
	/***Inserimento ID ***/
$query = 
	"Insert into yourRoot_autoscout(id)
    select item_id
    from yourRoot_flexicontent_fields_item_relations, yourRoot_content
    where item_id = yourRoot_content.id and yourRoot_content.state = 1
    group by id";
	
  $db->setQuery($query);
  $db->execute();

  /****aggiornamento campo*****/
  foreach ($resultuno as $resultdue){
$type =
	"update yourRoot_autoscout
	 set type = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 18
	 group by id)";
  $db->setQuery($type);
  $db->execute();
  
    /****aggiornamento campo*****/
 
$category =
	"update yourRoot_autoscout
	 set category = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 42
	 group by id)";
  $db->setQuery($category);
  $db->execute();
 
   /****aggiornamento campo*****/
 
$body =
	"update yourRoot_autoscout
	 set body = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 37
	 group by id)";
  $db->setQuery($body);
  $db->execute();
 
     /****aggiornamento campo*****/
 
$brand =
	"update yourRoot_autoscout
	 set brand = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 19
	 group by id)";
  $db->setQuery($brand);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$model =
	"update yourRoot_autoscout
	 set model = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 38
	 group by id)";
  $db->setQuery($model);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$version =
	"update yourRoot_autoscout
	 set version = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 48
	 group by id)";
  $db->setQuery($version);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$body_colorgroup =
	"update yourRoot_autoscout
	 set body_colorgroup = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 20
	 group by id)";
  $db->setQuery($body_colorgroup);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$body_painting =
	"update yourRoot_autoscout
	 set body_painting = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 21
	 group by id)";
  $db->setQuery($body_painting);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$interior_color =
	"update yourRoot_autoscout
	 set interior_color = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 22
	 group by id)";
  $db->setQuery($interior_color);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$doors =
	"update yourRoot_autoscout
	 set doors = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 30
	 group by id)";
  $db->setQuery($doors);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$gear_type =
	"update yourRoot_autoscout
	 set gear_type = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 28
	 group by id)";
  $db->setQuery($gear_type);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$gears =
	"update yourRoot_autoscout
	 set gears = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 29
	 group by id)";
  $db->setQuery($gears);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$fuel_type =
	"update yourRoot_autoscout
	 set fuel_type = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 23
	 group by id)";
  $db->setQuery($fuel_type);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$transmission =
	"update yourRoot_autoscout
	 set transmission = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 51
	 group by id)";
  $db->setQuery($transmission);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$capacity =
	"update yourRoot_autoscout
	 set capacity = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 49
	 group by id)";
  $db->setQuery($capacity);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$kilowatt =
	"update yourRoot_autoscout
	 set kilowatt = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 52
	 group by id)";
  $db->setQuery($kilowatt);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$cylinder =
	"update yourRoot_autoscout
	 set cylinder = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 31
	 group by id)";
  $db->setQuery($cylinder);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$urban_consum =
	"update yourRoot_autoscout
	 set urban_consum = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 34
	 group by id)";
  $db->setQuery($urban_consum);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$extra_consum =
	"update yourRoot_autoscout
	 set extra_consum = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 35
	 group by id)";
  $db->setQuery($extra_consum);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$class_emission =
	"update yourRoot_autoscout
	 set class_emission = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 32
	 group by id)";
  $db->setQuery($class_emission);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$co_liquid =
	"update yourRoot_autoscout
	 set co_liquid = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 33
	 group by id)";
  $db->setQuery($co_liquid);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$mileage =
	"update yourRoot_autoscout
	 set mileage = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 24
	 group by id)";
  $db->setQuery($mileage);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$initial_registration =
	"update yourRoot_autoscout
	 set initial_registration = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 50
	 group by id)";
  $db->setQuery($initial_registration);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$price_value =
	"update yourRoot_autoscout
	 set price_value = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 27
	 group by id)";
  $db->setQuery($price_value);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$equipment_text =
	"update yourRoot_autoscout
	 set equipment_text = (
	 select GROUP_CONCAT( value,  ' ' ) 
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 43
	 GROUP BY item_id
	 )";
  $db->setQuery($equipment_text);
  $db->execute();
 
    /****aggiornamento campo*****/
 
$images_image =
	"update yourRoot_autoscout
	 set images_image = (
	 select value as value
	 from yourRoot_flexicontent_fields_item_relations
	 where item_id = id and field_id = 44
	 group by id)";
  $db->setQuery($images_image);
  $db->execute();
  }
  ?>
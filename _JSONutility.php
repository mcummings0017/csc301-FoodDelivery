<?php

//writeJSON('newjson.json',
//	[['firstname'=>'Paul','lastname'=>'McCartney']]);

//read all the records from a JSON file
function jsonToArray($filename) {
	$json_string=file_get_contents($filename);
	$array=json_decode($json_string, true);
	return $array;
}

//read the record with index i in the JSON file
function readJSON($file,$index=null){
	$json=jsonToArray($file);
	if(!isset($index)) return $json;
	if ($index>sizeof($json)-1 || $index<0) return null;
	return $json[$index];
}

//modify the record with index i in the JSON file
function modifyJSON($file,$index,$info){
	$json=jsonToArray($file);
	if($index>sizeof($json)-1 || $index<0) return false;
	$json[$index]=$info;
	writeAllJSON($file,$json);
	return true;
}

//delete the record with index i from the JSON file
function deleteJSON($file,$index){
	$json=jsonToArray($file);
	if($index>sizeof($json)-1 || $index<0) return false;
	unset($json[$index]);
	$json=array_values($json);
	writeAllJSON($file,$json);
	return true;
}

//json functions written in class
function writeAllJSON($file,$data){
	$h=fopen($file,'w');
	fwrite($h,json_encode($data,JSON_PRETTY_PRINT));
	fclose($h);
}

function writeJSON($file,$data){
	$array=json_decode(file_get_contents($file),true);
	$array[]=$data;
	writeAllJSON($file,$array);	
}

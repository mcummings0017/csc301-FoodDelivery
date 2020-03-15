<?php

session_start();

function signup($database_file,$success_URL){
	if(count($_POST)>0){
	//if the user sends the form:
		// Validate the email
		if(!isset($_POST['email']{0}) 
			|| !isset($_POST['password']{0})
			|| !isset($_POST['accountType']{0})) {
				return 'You must enter e-mail, password and account type';
		}
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			return 'Please enter a valid email address';
		}
		$_POST['email']=strtolower($_POST['email']);
		
		// Validate the password
		$_POST['password']=trim($_POST['password']);
		if(strlen($_POST['password'])<8) {
			return 'Please, enter a password that is at least 8 characters long.';
		}
		
		// Create file if it does not exist
		if(!file_exists($database_file)){
			$h=fopen($database_file,'w');
			fwrite($h,'<?php die() ?>'."\n");
			fclose($h);
		}
		// Check for duplicates
		$h=fopen($database_file,'r');
		while(!feof($h)){
			$line=fgets($h);
			if(strstr($line,$_POST['email'])) {
				return 'The email you entered is already associated with an account.';
			}
		}
		fclose($h);
		// Encrypt password
		$_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		// Store data in db
		$h=fopen($database_file,'a+');
		fwrite($h,$_POST['email'].';'.$_POST['password'].';'.$_POST['accountType'].PHP_EOL);
		fclose($h);
		header('location: '.$success_URL);
	}
}


function signout($destination_URL){
	$_SESSION=[];
	session_destroy();
	header('location:'.$destination_URL);
}

function is_logged($user_key){
	if(isset($_SESSION[$user_key])){
		if(is_numeric($_SESSION[$user_key])) {
			return true;
		} elseif(isset($_SESSION[$user_key]{0})) {
			return true;
		}
	}
	return false;
}
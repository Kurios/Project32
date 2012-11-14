<?php
session_start() or die("Session Failed to Start");

if ($_SERVER['HTTPS'] != "on") {
	$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	header("Location: $url");
	exit;
}
/*
 * This is the API interface for WorkReadyGrad
 * The purpose of this API is to allow for a connection between Teleo Apps and WorkReadyGrad, by allowing Corperations to design thier own system integration options.
 * This is also the public web frontend of the API
 * 
 * The design goal here create an interface between the public and the database.
 * 
 * @TODO integrate login module
 */

//Verify User Account
if( isset($_SESSION['user']))
	$user = $_SESSION['user'];
else // the site is birbidden
	die('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access API.php on this server.</p><hr></body></html>');

//Now that we know that we have a user, we are willing to answer his requests.... Some sample requests
//Lets also initialize our API, connect to the database, ect, ect...
require_once("API/functions.php");
if(isset($_REQUEST['type']))
{
	switch( $_REQUEST['type'] )
	{
		case "request_user" :
			echo request_user($_REQUEST['uuid']);
			break;
		case "get_user_resume" :
			echo get_user_resume($_REQUEST['uuid']);
			break;
		case "get_user_to_name_list" :
			echo get_new_users($_REQUEST['date']);
			break;
	}
}

// http://tbe.taleo.net/products/TBE_API_Guide.pdf
?>
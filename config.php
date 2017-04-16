<?php

// Connecting to the MySQL database
$user = 'garnerm4';
$password = 'pze4cHeY';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_spring17_garnerm4', $user, $password);

//autoload classes
function my_autoloader($class){
	
	include 'classes/' .$class. '.php';
}
spl_autoload_register('my_autoloader');

//not clear on how to implement autoloader, manually include customer class
//include('classes/customer.php');

// Start the session
session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

// if customerID is not set in the session and current URL not login.php redirect to login page
if (!isset($_SESSION["customerID"]) && $current_url != 'login.php') {
    header("Location: login.php");
}

// Else if session key customerID is set get $customer from the database
elseif (isset($_SESSION["customerID"])) {
	
	$customer_id = $_SESSION["customerID"];
	$customer = new Customer($customer_id, $database);
}

// create session variable for cart
if(!isset($_SESSION["cart"])){
	$_SESSION['cart'] = new ShoppingCart();
}




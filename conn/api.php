<?php
// header("Access-Control-Allow-Origin: *");﻿
// header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin");

// $conn = new mysqli("localhost:8081", "root", "", "vuephpcrud");
// below connects on port 3306 by passing vue navigating directly from browser
$conn = new mysqli("localhost:3306", "root", "", "vuephpcrud");
// $conn = new mysqli("localhost:3306", "root", "", "vuephpcrud");

if($conn->connect_error){
	die("Could not connect to database!");
}

$res = array('error' => false);
$action = 'read';
if(isset($_GET['action'])){
	$action = $_GET['action'];
}

if($action == 'read'){
	$result = $conn->query("SELECT * FROM `users`");
	$users = array();

	while($row = $result->fetch_assoc()){
		array_push($users, $row);
	}

	$res['users'] = $users;
}

if($action == 'create'){

	$username = $_POST['username'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$result=$conn->query("INSERT INTO `users` (`username`, `email`, `mobile`) VALUES ('$username', '$email', '$mobile')");
	if($result){
		$res['message'] = "User added successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "Could not insert user";
	}
}

if($action == 'update'){
  $id = $_POST['id'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $result = $conn->query("UPDATE `users` SET `username` = '$username', `email` = '$email', `mobile` = '$mobile' WHERE `id` = '$id'");
	if($result){
		$res['message'] = "User updated successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "Could not update user";
	}
}

if($action == 'delete'){
	$id = $_POST['id'];

	$result = $conn->query("DELETE FROM `users` WHERE `id` = '$id'");

	if($result){
		$res['message'] = "User deleted successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "Could not delete user";
	}
}

$conn->close();

header("Content-type: application/json");
echo json_encode($res);
die();

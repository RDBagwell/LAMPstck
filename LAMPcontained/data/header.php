<?php
require_once('config/init.php');
$message = "";
if (isset($_POST['login'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$user = new Users();
	$user_found = Users::verify_user($username, $password);
	if($user_found){
		$session->login($user_found);
		header("Location: index.php");
	} else {
		$message = "Username or password is incorrect";
	}
} else{
	$username = "";
	$password = "";
}

$user = new Users();
if (isset($_POST['register'])) {
	$passwordCrypt = $user->hash_password(trim($_POST['password']));
	$user->firstName = trim($_POST['firstName']);
	$user->lastName = trim($_POST['lastName']);
	$user->email = trim($_POST['email']);
	$user->username = trim($_POST['username']);
	$user->password = $passwordCrypt;
	$has_user = $user->dose_user_exsist();
	if($_POST['password'] === $_POST['confirm-password']){
		if($has_user){
			$message = "This user already exists.";
		} else {
			$user->save();
			header("Location: index.php");
		}
	} else {
		$message = "The password and confirm password don't match";
	}	
}


if (isset($_POST['add_comment'])) {
	$newComment = new Comments();
	$newComment->uid = $_SESSION['user_id'];
	$newComment->body = $_POST['comment'];
	$newComment->commenter = $_POST['commenter'];
	$newComment->save();
	$session->message("Comment Saved");
	header("Location: index.php");
	
}
require_once('html/header.html');
require_once('html/navigation.html');


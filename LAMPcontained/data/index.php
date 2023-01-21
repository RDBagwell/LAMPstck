<?php
require_once('header.php');
if ($session->is_signed_in()) { 
	require_once('html/index.html');
} else{
	require_once('html/login.html');
}
require_once('footer.php');
<?php 	

session_start();

unset($_SESSION['name']);
unset($_SESSION['id']);

setcookie('remember','');

header('location:index.php');
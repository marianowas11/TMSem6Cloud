<?php declare(strict_types=1); // włączenie typowania zmiennych w PHP >=7
session_start();


include 'dbConn.php';
//error_reporting(E_ALL);
$file = htmlentities ($_POST['fileToShare'], ENT_QUOTES, "UTF-8"); 
$user = htmlentities ($_POST['userToShare'], ENT_QUOTES, "UTF-8"); 



$tokens = explode('/', $file);
$str = trim(end($tokens));
$moveto = "users/".$user."/".$str;
echo $moveto;



copy($file, $moveto);
$str2 = $_SESSION['sessionLink'];
header("Location: http://marianowas11.beep.pl".$str2);
?>
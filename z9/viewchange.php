<?php
session_start();
       $mytext = $_POST['submit'];
       echo $mytext;
$_SESSION ['widok'] = $mytext;
$str2 = $_SESSION['sessionLink'];
header("Location: http://marianowas11.beep.pl".$str2);
    ?>
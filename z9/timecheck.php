<?php
require_once('dbConn.php');
$newDate = date('Y-m-d H:i:s', strtotime(' -1 minutes'));
$ip=$_SERVER['REMOTE_ADDR'];
$dateq = mysqli_query($connection, "SELECT datagodzina, idb from blokady where adres_ip='$ip' order by idb DESC LIMIT 1");
while($row = mysqli_fetch_array($dateq)){
    $dateo=$row[0];
}
print "$dateo";
//$date = strtotime('$dateo');
if($dateo){
if($dateo < $newDate){
    $_SESSION['bledy']=0;
    $_SESSION['blokada']=0;
}else{
    $_SESSION ['error'] = "odczekaj minute tu ";
    mysqli_close($connection); // zamknięcie połączenia z BD
    header("Location: index.php");
    exit();
}}
?>
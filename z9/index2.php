<?php declare(strict_types=1);
session_start();
if (!isset($_SESSION['loggedin']))
{
header('Location: index.php');
exit();
}
if (!isset($_SESSION['widok']))
{
 $_SESSION['widok'] = "ikony";
}
$_SESSION['sessionLink'] = $_SERVER['REQUEST_URI'];
$ip = $_SERVER["REMOTE_ADDR"];
$user = $_SESSION['username'];
$root = $_SERVER['DOCUMENT_ROOT'] . 'z9/users/' . $user . '/';
$path = $_SERVER['DOCUMENT_ROOT'] . 'z9/users/' . $user . '/';
echo ('<b><a href="logout.php" style="position:absolute;right:10px;">Wyloguj</a></b>');
echo "Użytkownik: " . $_SESSION['username'] . ".<br>";

require_once('dbConn.php');
// $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
// $result = mysqli_query($link, "SELECT datagodzina FROM blokady WHERE adres_ip = '$ip' AND ogloszono = 0 ORDER BY idb DESC LIMIT 1;");
// while ($wiersz = mysqli_fetch_array ($result)) {
//  echo '<span style="color:red;">Ostatnie błędne logowanie: ' . $wiersz[0] . '</span><br>';
// }
// mysqli_query($link, "UPDATE blokady SET ogloszono = 1 WHERE adres_ip = '$ip';");
// mysqli_close($link);

function fill_brand($connection)  
 {  
      $output = '';  
      $sql = "SELECT * FROM users where username not like '".$_SESSION['username']."'";  
      $result = mysqli_query($connection, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option>'.$row["username"].'</option>';  
      }  
      return $output;  
 }  
 
function usun_folder($dirPath) {
 if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
  $dirPath .= '/';
 }
 $files = glob($dirPath . '*', GLOB_MARK);
 foreach ($files as $file) {
  if (is_dir($file)) {
   usun_folder($file);
  } else {
   unlink($file);
  }
 }
 rmdir($dirPath);
}

if (isset($_GET['katalog'])) {
  $path = $path . $_GET['katalog'] . "/";
}

if (isset($_GET['usun'])) {
  $sciezka = $path . "/" . $_GET['usun'];
  $sciezka = preg_replace('/([^:])(\/{2,})/', '$1/', $sciezka);
  if (is_dir($sciezka)) usun_folder($sciezka);
  else unlink($sciezka);
  header('Location: ?katalog=');
}
?>

<form method="POST" enctype="multipart/form-data">
 <br>Wybierz plik do wysłania:<br>
 <input type="file" name="fileToUpload" id="fileToUpload">
 <input type="submit" name="submit" name="submit">
</form>

<form method="POST">
 Stwórz nowy folder:<br>
 Nazwa: <input type="text" name="folder" maxlength="16"><br>
 <input type="submit" value="Stwórz">
</form>

 <br>

<?php
if (isset($_POST['folder'])) {
 $sciezka = $path . "/" . $_POST['folder'];
 $sciezka = preg_replace('/([^:])(\/{2,})/', '$1/', $sciezka) . "/";
 mkdir($sciezka, 0777);
}

if (isset($_POST['submit'])) {
  if ($_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
    $sciezka = $path . "/" . basename($_FILES["fileToUpload"]["name"]);
    $sciezka = preg_replace('/([^:])(\/{2,})/', '$1/', $sciezka);
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $sciezka);
  }
}

?>
Zmień wyświetlanie:
          <form  method="post" name="myform" action="viewchange.php">
          <input type="submit" name="submit" value="lista" >
          <input type="submit" name="submit" value="ikony" >
</form>
<?php
echo '<br><br>Drzewo plików:<br>';
if($_SESSION['widok']=='ikony'){
  $files = scandir($path);
foreach ($files as $file){
 if (strcmp($file, '.') == 0) continue;
 
 $zrodlo = realpath($_SERVER['DOCUMENT_ROOT']. "z9/users/" . $user . "/" .
   (isset($_GET['katalog']) ? $_GET['katalog'] . "/" : "") . $file);
 //$rozmiar = ceil(filesize($zrodlo) / 1024);
 //$datagodz = date('Y-m-d H:i:s', filemtime($zrodlo));
  
 $relat1 = substr($zrodlo, strlen($root));
 if (strcmp($file, '..') == 0) { $relat1 = ''; }
 $relat2 = $user . '/' . $relat1;
 $format = end(explode('.', $file));
 $ikona = 'tekst.png';
 if ($format == 'txt' ) { $ikona = 'tekst.png'; }
 if ( $format == 'pdf') { $ikona = 'pdf.png'; }
 if ($format == 'mp3' || $format == 'wav') { $ikona = 'nuta.png'; }
 if (is_dir($zrodlo)) {
  echo '<a href=?katalog=' . $relat1 . '>' . $file . '<img src="strzalka.png" style="max-width: 25px;"></a>';
  if ($relat1 != ''){ 
    // echo '<a href=?usun=' . $relat1 . '><img src="kosz.png" style="max-width: 25px;"></a><br>';

  }
  else echo '<br>';
 } else {
  echo '<a href="' . $relat2 . '" download>' . $file . '<img src="' . $ikona . '" style="max-width: 30px;"></a>';
  // echo '<a href="?usun=' . $relat1 . '"><img src="kosz.png" style="max-width: 25px;"></a><br>';
 }
 echo '<br>';
}

}
if($_SESSION['widok']=='lista'){
  $files = scandir($path);
foreach ($files as $file){
 if (strcmp($file, '.') == 0) continue;
 
 $zrodlo = realpath($_SERVER['DOCUMENT_ROOT']. "z9/users/" . $user . "/" .
   (isset($_GET['katalog']) ? $_GET['katalog'] . "/" : "") . $file);
 //$rozmiar = ceil(filesize($zrodlo) / 1024);
 //$datagodz = date('Y-m-d H:i:s', filemtime($zrodlo));
  
 $relat1 = substr($zrodlo, strlen($root));
 if (strcmp($file, '..') == 0) { $relat1 = ''; }
 $relat2 = $user . '/' . $relat1;
 $format = end(explode('.', $file));
 $ikona = 'tekst.png';
 if ($format == 'txt' ) { $ikona = 'tekst.png'; }
 if ( $format == 'pdf') { $ikona = 'pdf.png'; }
 if ($format == 'mp3' || $format == 'wav') { $ikona = 'nuta.png'; }
 if (is_dir($zrodlo)) {
  echo '<a href=?katalog=' . $relat1 . '>' . $file . '</a>';
  if ($relat1 != ''){ 
    // echo '<a href=?usun=' . $relat1 . '><img src="kosz.png" style="max-width: 25px;"></a><br>';

  }
  else echo '<br>';
 } else {
  echo '<a href="' . $relat2 . '" download>' . $file . '</a>';
  // echo '<a href="?usun=' . $relat1 . '"><img src="kosz.png" style="max-width: 25px;"></a><br>';
 }
 echo '<br>';
}
}

?>
<br><br>
Udostępnianie plików:
<?php 

$dirpath = 'users/'.$_SESSION ['username'];
$url = $_SESSION['sessionLink'];
if(substr_count($url, 'katalog=') == 1)
{
    $dirr = strstr($url, "katalog=");
    $str2 = substr($dirr, 8);
    $dirpath.= "/".$str2; 
}

$filenames = "";
if(is_dir($dirpath))
{
    $files = opendir($dirpath);
    if($files)
    {
        while(($filename = readdir($files))!=false)
        {
            if($filename!="." && $filename!="..")
            {
                $filenames=$filenames."<option>$dirpath".""."/$filename</option>";
            }
        }
    }
}

?>


<form action="share.php" method="post" enctype="multipart/form-data">
Udostępnij:
<select name="fileToShare" id="fileToShare">
<?php echo $filenames;?>
</select>   
Dla: 
<select name="userToShare" id="userToShare">
  
 <?php echo fill_brand($connection); ?>
</select>
<input type="submit"  alt="Submit" style = "width:65px;height:42px;" />
 </form>


<br>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <title>Mariusz Jackowski cloud</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
    session_start();
    $user=$_POST['user']; // login z formularza
    $user = htmlentities ($user, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
    $pass=$_POST['pass']; // hasło z formularza
    $pass = htmlentities ($pass, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $pass
    $pass2=$_POST['pass2']; // hasło z formularza
    $pass2 = htmlentities ($pass2, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $pass2

    include 'dbConn.php'; // obsługa błędu połączenia z BD

    mysqli_query($connection, "SET NAMES 'utf8'"); // ustawienie polskich znaków

    $result = mysqli_query($connection, "SELECT * FROM users WHERE username='$user'"); // wiersza, w którym login=login z formularza
    $rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD
    session_start();
    if(!$rekord){
        if($pass==$pass2){
            $sql="INSERT INTO users (`username`,`password`) VALUES ('$user','$pass')";
            if(mysqli_query($connection, $sql)){
                echo "Poprawnie Dodano";
                mkdir("users/".$user,0777);
                $_SESSION ['loggedin'] = true;
                $_SESSION ['username'] = "".$user;
                header("Location: index2.php");
                exit();
            }else{
                echo "Błąd rejestracji";
                $_SESSION ['error'] = "Błąd rejestracji";
                header("Location: rejestruj.php");
                exit();
            }
        }else{//hasła się nie zgadzają
            echo "Hasła się nie zgadzają.";
            $_SESSION ['error'] = "Hasła się nie zgadzają.";
            header("Location: rejestruj.php");
            exit();
        }
    }else{//istnieje już taki użytkownik
        echo "Użytkownik już istnieje";
        $_SESSION ['error'] = "Użytkownik już istnieje";
        header("Location: rejestruj.php");
        exit();
    }
    mysqli_close($connection);


?>
</BODY>
</HTML>
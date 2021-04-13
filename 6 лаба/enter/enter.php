<?php

function UpdateCookie( $cookie_name, $default_value, $time):bool
{
     //   strtotime($time)
    return    setcookie($cookie_name, $default_value, time() + 7200);
}


$sql_res=mysqli_connect("localhost", "root", "Hooker_15_06_1389");

if ($sql_res == false)
{    
    echo "Error cannot conect mysql".mysqli_connect_error();
    return;
}

mysqli_set_charset($sql_res, "utf8");
$res = mysqli_query($sql_res,'USE verification_data');
if ($res == false)
{    echo "<br>Error1";
    return;
}
$sql_ask = "SELECT * FROM users WHERE email LIKE('{$_POST['email']}');";

$res = mysqli_query($sql_res,$sql_ask);
if ($res == false)
{

    echo "<br>Error2 ";
    return;
}


if ( mysqli_num_rows($res) <= 0 )
{
    $Message = "Проверьте правильность введенного email и пароля!";
    include("enter.html");
    return;

}


$row = mysqli_fetch_array($res);

if ( !password_verify($_POST["Pasw"],$row['password']))
{
    $Message = "Проверьте правильность введенного email и пароля!";
    include("../enter/enter.html");
    return;
}
 
$SP_cookie = false;
if (isset($_POST["SaveMe"]))
    $SP_cookie = true;

$Enter_cookie = true;
$Email_cookie = $_POST["email"];
 

if (  false)
{ 
    // Запомнить меня

}
else
{
    // Тоже запомнить но не на долго


}


include ("../mainpage/main.php");
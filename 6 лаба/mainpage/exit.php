<?php
/*function UpdateCookie( $cookie_name, $default_value, $time):bool
{
        
    return    setcookie($cookie_name, $default_value, strtotime($time), "/");
}
$tmp = false;
UpdateCookie("Enter", $tmp, "+30 days");
UpdateCookie("SavePassword",$tmp , "+30 days");
$tmp = "";
UpdateCookie("UserEmail", $tmp, "+30 days");
*/
$Enter_cookie = false;
$SP_cookie = false;
$Email_cookie = "";
include("main.php");

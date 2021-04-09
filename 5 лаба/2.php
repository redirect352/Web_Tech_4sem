<?php


if (isset($_POST['UserName']) && $_POST['UserName']!= "")
    $header_text = $_POST['UserName'].",cпасибо за ваш отзыв!"; 
else
    $header_text = "Уважаемый посетитель, спасибо за ваш отзыв!";

    $bottom_text = "Ваше мнение очень важно для нас.";

    include('template2.html');
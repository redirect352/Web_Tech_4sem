<?php
    
    
    
    
    
    $warning = "";
    //include("registration.html");

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


    if ( mysqli_num_rows($res) > 0 )
    {
        $warning = "Аккаунт с данным email уже существует!";
        $name = "value =\"".$_POST["Name"]."\"";
        $position = "value =\"".$_POST["Position"]."\"";
        $email = "value =\"".$_POST["email"]."\"";
        include("registration.html");
        return;

    }
    

    if($_POST["Pasw"] != $_POST["Pasw2"])
    {
        $warning = "Введенные пароли не совпадают!";
        $name = "value =\"".$_POST["Name"]."\"";
        $position = "value =\"".$_POST["Position"]."\"";
        $email = "value =\"".$_POST["email"]."\"";
        include("registration.html");
        return;

    }

    
    //
    $date1 = date("Ymd");
    $passwordHash = password_hash($_POST["Pasw"], PASSWORD_DEFAULT);
    $sql_ask = "INSERT INTO `users`(`email`, `password`, `Name`, `Position`, `Registration_Date`) VALUES ('{$_POST["email"]}','{$passwordHash}','{$_POST["Name"]}','{$_POST["Position"]}','{$date1}');";
   
    $res = mysqli_query($sql_res,$sql_ask);
    if ($res == false)
    {
    
        echo "<br>Error3 ";
        return;
    }
    else
    {
        $Message = "Ваш аккаунт зарегистрирован. Войдите в систему.";
        include("../enter/enter.html");
    }



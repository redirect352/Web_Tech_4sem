<?php
    
    function  CheckAuthorized () : bool
    {
        $entered = false;
        if (isset($_COOKIE["Enter"]))
             $entered = $_COOKIE["Enter"];
        if (isset ($_COOKIE["SavePassword"]))
            if ($_COOKIE["SavePassword"] == true)
                $entered = true;
        return $entered;
    }

    function ConnectToVerData ()
    {
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
        return $sql_res;
    }

    function GetEmailData ($email, $sql_res)
    {
        $sql_ask = "SELECT * FROM users WHERE email LIKE('{$email}');";
        $res = mysqli_query($sql_res,$sql_ask);
        if ($res == false)
        {
        
            echo "<br>Error2 ";
            return;
        }
        if (mysqli_num_rows($res) <= 0) {
            return false;
        }
        return  mysqli_fetch_array($res);

    }




    if (isset($Enter_cookie) && isset($SP_cookie) && isset($Email_cookie))
    {
        setcookie("Enter", $Enter_cookie,0, "/");
        setcookie("SavePassword",$SP_cookie , strtotime("+30 days"), "/");
        setcookie("UserEmail", $Email_cookie, strtotime("+30 days"), "/");
    }

    $entered = CheckAuthorized();

    if ($entered == false)
    {
        $h1_text = "Начальная страница сайта";
        $content  = '    <li type= "none">
        <ul><a href="../mainpage/mainPage.php">Главная</a></ul>
        <ul><a href="../enter/enter.html">Войти в систему</a></ul>
        <ul><a href="../reg/registration.html">Зарегистрироваться</a></ul>
    </li>';

    }
    else 
    {
        $h1_text = "Личный кабинет";
        if (isset($_COOKIE["UserEmail"]))
            $User_email = $_COOKIE["UserEmail"];
        else
        {    echo "Cookie error!"; return;}
        $sql_res=ConnectToVerData ();

        
        $row = GetEmailData($User_email, $sql_res);
        if ( $row != false)
        {
            
            $content = "<p> Здравствуйте, ".$row["Name"]."</p>";
            $content = $content. "<p>Должность : ".$row["Position"]."</p>";
            $content = $content."<p>email : ".$row["email"]."</p>";
            $content = $content. "<p>Дата регистрации : ".$row["Registration_Date"]."</p>";
            $content = $content. "<p><a href=\"../mainpage/mainPage.php\">на главную</a></p>";
            
            $content = $content. "<p><a href=\"../mainpage/exit.php\">Выход</a></p>";
            
            
        }    


    }


    include("main.html");
<?php
    
    
    if (isset($Enter_cookie) && isset($SP_cookie) && isset($Email_cookie))
    {
        setcookie("Enter", $Enter_cookie, time() + 7200, "/");
        setcookie("SavePassword",$SP_cookie , strtotime("+30 days"), "/");
        setcookie("UserEmail", $Email_cookie, strtotime("+30 days"), "/");
    }

    $entered = false;
    if (isset($_COOKIE["Enter"]))
        $entered = $_COOKIE["Enter"];
    if (isset ($_COOKIE["SavePassword"]))
        if ($_COOKIE["SavePassword"] == true)
            $entered = true;
            


    if ($entered == false)
    {
        $content  = '    <li type= "none">
        <ul><a href="../enter/enter.html">Войти в систему</a></ul>
        <ul><a href="../reg/registration.html">Зарегистрироваться</a></ul>
    </li>';

    }
    else 
    {
        
        if (isset($_COOKIE["UserEmail"]))
            $User_email = $_COOKIE["UserEmail"];
        else
        {    echo "Cookie error!"; return;}
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
        $sql_ask = "SELECT * FROM users WHERE email LIKE('{$User_email}');";
        
        $res = mysqli_query($sql_res,$sql_ask);
        if ($res == false)
        {
        
            echo "<br>Error2 ";
            return;
        }
    
    
        if ( mysqli_num_rows($res) > 0 )
        {
            
            $row = mysqli_fetch_array($res);

            $content = "<p> Здравствуйте, ".$row["Name"]."</p>";
            $content = $content. "<p>Должность : ".$row["Position"]."</p>";
            $content = $content."<p>email : ".$row["email"]."</p>";
            $content = $content. "<p>Дата регистрации : ".$row["Registration_Date"]."</p>";
            $content = $content. "<p><a href=\"../mainpage/exit.php\">Выход</a></p>";
            
            
        }    


    }


    include("main.html");
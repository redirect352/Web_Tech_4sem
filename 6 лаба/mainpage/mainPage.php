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
    $content = "";
    $h1_text = "Главная";
    $content = $content. "<p><strong>Новости компании</strong></p>";
    $content = $content. "<p><a href=\"#\">Новость 1</a></p>";
    $content = $content. "<p><a href=\"#\">Новость 2</a></p>";
    $content = $content. "<p><a href=\"#\">Новость 3</a></p>";
    $content = $content. "<p><a href=\"#\">Новость 4</a></p>";
    $content = $content. "<p><a href=\"#\">Новость 5</a></p>";
   
   
   
    $enter = CheckAuthorized();
    $nameUsr = "";
    
    if ($enter)
    {
        $User_email = $_COOKIE["UserEmail"];
            
            
        $sql_res=ConnectToVerData();

        $row = GetEmailData($User_email, $sql_res);
        if ($row!=false)
        {
            $nameUsr = ",".$row["Name"].'!';
            
        }

        
        $content = $content. "<p>* Дополнительное содержимое для вошедших пользователей*</p>";
        $content = $content. "<p><a href=\"../mainpage/main.php\">В личный кабинет</a></p>";
        $content = $content. "<p><a href=\"../mainpage/exit.php\">Выход</a></p>";
                
    }
    else
    {
       
        $content = $content. "<p><a href=\"../mainpage/main.php\">На начальную страницу</a></p>";
        

    }

   
    $content  = "<p>Добро пожаловать на наш сайт{$nameUsr}</p>".$content;


    include ("main.html");

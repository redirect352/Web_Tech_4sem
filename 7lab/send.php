<?php




    function OutputTable(){
        $sql_res=mysqli_connect("localhost", "root", "Hooker_15_06_1389");
 
        if ($sql_res == false)
        {    
            echo "Error cannot conect mysql".mysqli_connect_error();
            return;
        }
        mysqli_set_charset($sql_res, "utf8");
        $res = mysqli_query($sql_res,'USE ip_stat');
        $sql_ask = "SELECT * FROM ip_statistics";
        $res = mysqli_query($sql_res,$sql_ask);
        if ( mysqli_num_rows($res) > 0 ){
            $row = mysqli_fetch_array($res);
            $len = 0;
            
            while ($row){
                $Arr[$len]["ip_addr"] = $row["ip_addr"];
                $Arr[$len]["Count"] = $row["Count"];
                $len++; 
    
                
                $row = mysqli_fetch_array($res);    
            }
            
        for ($i=0; $i< $len ; $i++) { 
            $min = $i;
            for ($j=$i; $j < $len; $j++) { 
                if ($Arr[$j]["Count"] >$Arr[$min]["Count"] )
                    $min = $j;
            }
            $buf = $Arr[$min];
            $Arr[$min] = $Arr[$i];
            $Arr[$i] = $buf;
        }
    
        $to      = $_POST['email'];
        $subject = 'Site IP statistics';
        $message = '';
        $headers = 'From: sitestat@mail.ru' . "\r\n" .
            'Reply-To: sitestat@mail.ru' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
       
        $message = "";
        $message = sprintf("%'_32s\n", "","");
    
        
        $tmp = sprintf("|%'_20s | %'_10s |\n", "IP-adress", "Count");
        
        $message = $message.$tmp;
        for ($i=0; $i < $len; $i++) { 

            $tmp =sprintf("|%'_20s | %'_10d|\n", $Arr[$i]['ip_addr'], $Arr[$i]["Count"]);
        
            $message = $message.$tmp;
        }
        
        $message = $message.sprintf("|%'_19s|%'_11s|", "","");
    
        if (mail($to, $subject, $message, $headers))
            echo "<h3>Сообщение отправлено</h3>";
        else    
            echo "<h3>При отправке сообщения возникла ошибка</h3>";
    }
    }
    
    OutputTable();

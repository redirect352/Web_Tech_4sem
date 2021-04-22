<?php




function get_ip()
{
    $ip = false;
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function AddIpInDataBase ($ip){
    $sql_res=mysqli_connect("185.9.147.250", "root12345", "Hooker_15_06_1389");

    if ($sql_res == false)
    {    
        echo "Error cannot conect mysql".mysqli_connect_error();
        return;
    }
    mysqli_set_charset($sql_res, "utf8");
    $res = mysqli_query($sql_res,'USE ip_stat');
    if ($res == false)
    {       
    echo "<br>Error1";
    return;
    }

    $sql_ask = "SELECT * FROM ip_statistics WHERE ip_addr LIKE('{$ip}');";
    $res = mysqli_query($sql_res,$sql_ask);
    
    
    if ( mysqli_num_rows($res) > 0 ){
        $row = mysqli_fetch_array($res);
        $t = $row['Count']+1;
        $sql_ask ="UPDATE `ip_statistics` SET `Count`='{$t}' WHERE `ip_addr` LIKE('{$ip}');";
        $res = mysqli_query($sql_res,$sql_ask); 
        if ($res == false)
        {       
            echo "<br>Error3";
            return;
        }
    }else{
        $sql_ask = "INSERT INTO `ip_statistics`(`ip_addr`, `Count`) VALUES ('{$ip}','1')";
        $res = mysqli_query($sql_res,$sql_ask);
        if ($res == false)
        {       
            echo "<br>Error2";
            return;
        }
    }

}
 
function OutputTable(){
    $sql_res=mysqli_connect("185.9.147.250", "root12345", "Hooker_15_06_1389");

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

    /*for ($i=0; $i < $len; $i++) { 
        echo $Arr[$i]['ip_addr']."  ".$Arr[$i]["Count"]. "<br>" ;
    }
    echo "--------";
    foreach ($Arr as $row ){
        $str = "<tr> ";
        foreach ($row as $vals) {
            $str = $str." <th>{$vals}</th> ";
        }        
        $str = $str." </tr>";
        echo $str;
    }*/
    include("html/index.html");

}
}

if (!isset($_POST['key'])){
    echo "Input key!";
    return;
}
else if ($_POST['key']!="1111"){
    echo "Wrong key";
    return;
}

OutputTable();

<?php


function AddIpInDataBase ($ip){
    $sql_res=mysqli_connect("localhost", "root", "Hooker_15_06_1389");

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

	$ip =  get_ip();
	if ($ip != false){
		AddIpInDataBase ($ip);
	}



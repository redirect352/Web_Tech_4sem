




<?php




$sql_res=mysqli_connect("localhost", "root", "Hooker_15_06_1389");

if ($sql_res == false)
    echo "Error cannot conect mysql".mysqli_connect_error();
else
    echo "Connetcted succesfully...";

mysqli_set_charset($sql_res, "utf8");

$count = $_POST["count"];



$count = intval($count, 10);
if($count !=0)
{
    $res = mysqli_query($sql_res,'USE Books');
    
    $sql_ask = 'SELECT id, author FROM books_info;';
    $string_affected = 0;
    
    sscanf(mysqli_stat($sql_res), "Uptime: %d Threads: %d Questions: %d Slow queries: %d Opens: %d Flush tables: %d Open tables: %d Queries per second avg: %f",$uptime_final, $threads_final,$questions_start, $slow_start,$opens_final,$fflush_final,$tables_final,$average_final);

    $start = microtime(true);
    for ($i=0; $i < $count; $i++) { 
        $res = mysqli_query($sql_res,$sql_ask);
        $string_affected += mysqli_affected_rows($sql_res);
        
    }
    $time = microtime(true) - $start;


    echo "<br>".mysqli_stat($sql_res);
    sscanf(mysqli_stat($sql_res), "Uptime: %d Threads: %d Questions: %d Slow queries: %d Opens: %d Flush tables: %d Open tables: %d Queries per second avg: %f",$uptime_final, $threads_final,$questions_final, $slow_final,$opens_final,$fflush_final,$tables_final,$average_final);

    echo "<br> Версия сервера Sql: ".mysqli_get_server_info($sql_res);
    echo "<br> Количество записей таблицы БД затронутых запросами:{$string_affected}";
    echo "<br> Время выполнения запросов: ".round($time, 4)."ceкунд";
    echo "<br> Количество запросов: ".$questions_final - $questions_start ;
    echo "<br> Запросов в секунду: ".round(($questions_final - $questions_start)/$time, 4);
    

    $res = mysqli_query($sql_res,'SHOW SESSION STATUS;');

    while ($row = $res->fetch_assoc()) {
        $array[$row['Variable_name']] = $row['Value'];
    }
    echo"<br> КБ получено cервером: ".round($array['Bytes_received']/1024, 4)."<br>" ;
    echo" КБ отправлено cервером: ".round($array['Bytes_sent']/1024, 4)."<br>" ;
    
    mysqli_close($sql_res);

}
else
{
    echo "<br>Error. Wrong input!";
}





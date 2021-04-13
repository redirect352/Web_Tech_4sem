<?php

    //----------------------------------------------------------------------------------------------||
    //      //  //          //      //      //  //              //              //                  ||
    //      //      //      //      //      //      //      //      //      //      //              ||
    //      //      //      //      //      //      //      //      //      //      //              ||
    //      //      //      //  //  //      //      //      //      //      //      //              ||
    //      //  //          //  //  //      //  //            //  //        //      //              ||
    //      //              //      //      //              //      //      //      //              ||
    //      //              //      //      //              //      //      //      //              ||
    //      //              //      //      //                //  //    //      //                  ||
    //----------------------------------------------------------------------------------------------||
    $names = ['UserName', 'UserAge', 'UserMark', 'UserTroubles'];
    $Input_data = [[ ('text') =>"Введите имя", ('input') =>"<input type=\"text\" placeholder = 'Имя' >"],
                     [ ('text') =>"Введите возраст", ('input') =>"<input type=\"number\" value = '18' min = '0' max ='150' step = '1' required>"] ,
                     [('text') => 'Как вы оцениваете работу нашего сайта?', ('input') => '<input type = "text" list = "pricelist" required>'],
                     [('text')=> 'C какими проблемами вы столкнулись во время работы с нашим сайтом?', ('input') => ' <textarea></textarea>'],
                     [('text')=> 'Введите ваш email', ('input') => '<input type = "email" requered placeholder = "example@gmail.com"'],
                        [('input') => "<input type=\"submit\">  <input type=\"reset\">" ]
                    ] ;
                     //  $Input_data = [];    
    $DataLists = [
                    [('id') => 'pricelist', ('Opt') => ['Ужасно','Плохо', 'Нормально', 'Хорошо', 'Отлично']
                    
                    ]];

    $i =0;
    $j = 0;
    foreach ($Input_data as $dat)
    {
        if(isset($dat['input']))
        {
            if ($i < count($names))
            $Input_data[$j]['input']=  str_replace(">"," name = '".$names[$i]."'>" ,$dat['input']);
            $i++;    
        }
        $j++;
    }

            
    $header = "Оставьте мнение о нашем сайте.";
    include('template.html');
    
<?php

function CheckBoldText(&$SourceStr) : bool
{
    $pattern = [// Регулярки для жирного текста
                '/<b\\s*>(.*)<\/b\\s*>/iUs',
                '/<strong\\s*>(.*)<\/strong\\s*>/iUs',
                // Регулярки для Курсива 
                '/<i\\s*>(.*)<\/i\\s*>/iUs',
                '/<em\\s*>(.*)<\/em\\s*>/iUs',
                // Регулярки для подчеркнутого текста
                '/<u\\s*>(.*)<\/u\\s*>/iUs',
                '/<ins\\s*>(.*)<\/ins\\s*>/iUs'
            ];
    $replacementStart = [
                         // Замена для жирного текста
                        '<b style = "color: red">','<strong style = "color: red">',
                         // Замена для Курсива
                        '<i style = "color: green">','<em style = "color: green">',
                         // Замена для  подчеркнутого текста
                         '<u style = "color: blue">','<ins style = "color: blue">'
                ];
    
    $replacementEnd = ['</b>','</strong>','</i>','</em>','</u>','</ins>'];
    
    for ($i=0; $i < count($pattern) ; $i++) { 
        if (preg_match_all($pattern[$i],$SourceStr,$matches))
        {
            $count = 0;
            foreach ($matches[1] as $m) {                
                #$SourceStr = preg_replace('/<b>'.$m.'<\/b>/iUs','{!b!'.$count.'!!}', $SourceStr,1);
                $SourceStr = preg_replace($pattern[$i],$replacementStart[$i].$m.$replacementEnd[$i], $SourceStr,1);
            
            }

        }

         
    }

    $stylePattern = [ //Стиль жирного текста
                      '/font-weight\\s*:\\s*bold\\s*;?/iU',
                      //Стиль наклонного текста
                      '/font-style\\s*:\\s*oblique\\s*;?/iU',
                      //Стиль подчеркнутого текста
                      '/text-decoration\\s*:\\s*underline\\s*;?/iU'
                    ];
    $styleReplacement = ['font-weight: bold; color: red;',
                         'font-style: oblique; color: green;',
                         'text-decoration: underline; color: blue;'];
    for ($i=0; $i <count($stylePattern) ; $i++) { 
        $SourceStr = preg_replace($stylePattern[$i],$styleReplacement[$i], $SourceStr);
        
    }
    
    

    
    return true;
}

$FileName = 'html/index.html';

$HtmlPage = fopen ($FileName, 'r');

$NewPage = fopen ('html/NewPage.html', 'w');


if (!$NewPage)
    echo "Error! Cannot create output file";

if ($HtmlPage)
{
    echo " ---------------------------------------------------<br>";
    echo "Start HTML page: <br>";
    echo " ---------------------------------------------------<br>";
    $Str = fread($HtmlPage,filesize($FileName));
    echo $Str; 
    echo "---------------------------------------------------<br> Changed page: <br>"; 
    echo "---------------------------------------------------<br>";
    CheckBoldText($Str);
    echo $Str; 
    fwrite($NewPage, $Str);


    
    echo "<br> ---------------------------------------------------<br>";
    echo "Programm ended succesfully";
}
else {
    echo 'Error!Cannot open source file!';
}





fclose($HtmlPage);
fclose ($NewPage);



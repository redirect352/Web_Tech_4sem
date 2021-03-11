




<?php


function printArray ($arr)
{
    for ($i=0; $i < count($arr); $i++) { 
        for ($j=0; $j < count($arr[$i]); $j++) { 
            for ($k=0; $k < count($arr[$i][$j]) ;$k++) { 
                for ($g=0; $g < count($arr[$i][$j][$k]); $g++) { 
                    for ($l=0; $l < count($arr[$i][$j][$k][$g]); $l++) { 
                        echo $arr[$i][$j][$k][$g][$l],"  ,  ";
                    }              
                    echo "<br>";    
                }           
                echo "<br>";             
            }
            echo "<br>";            
        }
        echo "<br>";
    }

}


$MyArr = [
            [
                [
                    [
                        ["EWew",213,32.2123], 
                        [34,"Testcwe",1.32323]
                    ],
                    [
                        ["Some_Text",123.123,2],
                        ["We are in fifth generation", 21]
                    ]
                ],
                [
                    [
                        ["Hello", 12, 21.80812],
                        [23,31,"Hello,World!"]
                    ], 
                    [
                        ["stringgg",12],
                        [123,13,"32e32"]
                    ]
                ]
            ],

            [
                [
                    [
                        ["23fe",213,31.21,12],
                        ["reload", 21,23.12576]
                    ], 
                    [
                        [63,32.2323,324,23],
                        ["fwewef","ewf","sdssd"]
                    ]
                ]
            ]
         
        ];

echo "Start Array: <br><br>";

printArray($MyArr);

for ($i=0; $i < count($MyArr); $i++) 
    for ($j=0; $j < count($MyArr[$i]); $j++)  
        for ($k=0; $k < count($MyArr[$i][$j]) ;$k++) 
            for ($g=0; $g < count($MyArr[$i][$j][$k]); $g++) 
                for ($l=0; $l < count($MyArr[$i][$j][$k][$g]); $l++) { 
                    
                    if (gettype($MyArr[$i][$j][$k][$g][$l]) == "string") {
                        $MyArr[$i][$j][$k][$g][$l] = strtoupper($MyArr[$i][$j][$k][$g][$l]);
                    }
                    elseif (gettype($MyArr[$i][$j][$k][$g][$l]) == "integer") {
                       
                        array_splice($MyArr[$i][$j][$k][$g],$l, 1);
                        $l--;
                    } 
                    elseif(gettype($MyArr[$i][$j][$k][$g][$l]) == "double")
                    {
                        $MyArr[$i][$j][$k][$g][$l]= round($MyArr[$i][$j][$k][$g][$l],2);
                    }
                
                
                }              
 
                      
            
        
               
echo "<br>-----------------------------------------------------------";

echo " <br>Array after cycle: <br><br>";

printArray($MyArr);

?>
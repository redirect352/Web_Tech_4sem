<?php

function GetFolderInfo($fold_path)
{
  $size = 0;
  
  if (is_dir($fold_path))
  {
    if ($dir_handle = opendir($fold_path))
    {
        while (($file = readdir($dir_handle)) !== false) {
            $tmp = filetype($fold_path.'/'.$file);
            if ($tmp == "file")
            {
                $size = $size + filesize($fold_path.'/'.$file);
            }
            elseif ($tmp == "dir" && $file != "." && $file != ".." ) {
               $size = $size + GetFolderInfo($fold_path.'/'.$file);  
            }


            echo "файл: $file тип $tmp <br>";
        }
        closedir($dir_handle);
    }
    return $size;
  }


}



$Folder_name = "D:/TestFolder";


$data = GetFolderInfo($Folder_name );

echo "<br> Razmer: $data bytes";


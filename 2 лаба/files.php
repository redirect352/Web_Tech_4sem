<?php

function GetFolderInfo($fold_path) : int
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
                echo "файл: $file  <br>";
            }
            elseif ($tmp == "dir" && $file != "." && $file != ".." ) {
               $size = $size + GetFolderInfo($fold_path.'/'.$file);  
            }


            
        }
        closedir($dir_handle);
    }
    return $size;
  }


}



$Folder_name = $_POST["Folderpath"];

if (is_dir($Folder_name))
{
  $data = GetFolderInfo($Folder_name );
  echo "<br> Size: $data bytes ";
}
else {
  echo "\n You Entered incorect folder path. Error!";
}




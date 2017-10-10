Push it
<?php
 
$root = '/var/www/vhosts/aimfirst.info/';
$directory  = 'images';

// create a handler for the directory
    $handler = opendir($directory);

    // open directory and walk through the filenames
    while ($file = readdir($handler)) {
    $newName = 'noname';    
      // if file isn't this directory or its parent, add it to the results
      if ($file != "." && $file != "..") {
        if (is_dir($directory.$file)){
            //do nothing
        }else{
        echo $file ;
           // $newName = substr($file,8);
                $newName = $file;
             
            if (strpos($newName,'.') < 15){
                $first = substr($newName,0,strpos($newName,'.'));
           
                $last = substr($newName,strpos($newName,'.')+1);
                $rename = $first.$last;
             }else{
                $rename = $newName;
             }
                
             rename($directory.'/'.$file,'converted/'.$rename);
        }       
      }
    }

    // tidy up: close the handler
    closedir($handler);

?> 
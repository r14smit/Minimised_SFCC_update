<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//temporary list of brands, should be dynamicaly created by unzip fuction.

$brandList = array('O32'=>array('B32','B32-OPEN32','B32-OPEN32'),
                    'SC'=>array('B32','B32-SC','B32-SC'),
                    'KOI'=>array('KOISAP','KOISAP','KOISAP'),
                    'GSUS'=>array('GSUSSAP','GSUSSAP','GSUSSAP'),
                    'TND'=>array('TNDSAP','TNDSAP','TNDSAP'),
                    'ONTOUR'=>array('ONTOURSAP','ONTOURSAP','ONTOURSAP'),
                    'MAW'=>array('MAWSAP','MAWSAP','MAWSAP'),
                    'SB'=>array('SB','SB','SB'),
                    'MEES'=>array('MEESSAP','MEES','MEESSAP')
                    
                );

function saveFile($name,$file){
    $fp = fopen($name, 'w');
    fwrite($fp, $file );
fclose($fp);
}

function validNumbers($file){
    $ids = Array();
    foreach(file($file) as $line) {
        $id = substr($line,0, strlen($line)-1);
        $ids[trim($id)]=1;
    }
    return $ids;
}

function moveCatalog($file,$move,$brand,$catalog){
    $zip = zip_open($file);
    $returnvalues ='';
    while($zip_entry=zip_read($zip)) {
           $zdir=dirname(zip_entry_name($zip_entry));
           $zname=zip_entry_name($zip_entry);
           echo $zdir."<br>";
           if($catalog == 'MASTER' || strpos($catalog,'NAVIGATION')>1){      
                if(strpos($zdir,$catalog )>1 && strpos($zdir,$brand ) > 1){
                        $returnvalues = $zname;
                }
           }else{
                if(strpos($zdir,$catalog )>1 && strpos($zname,$brand ) > 1){
                        $returnvalues = $zname;
                }
           } 
    }
    zip_close($zip);       
 
    $zipCat = new ZipArchive;
    $res = $zipCat->open($file); 

    if ($res === TRUE) {
        //chmod("unzip\\", 0644); 
        $zipCat->extractTo($move, $returnvalues);
        $zipCat->close();
    }
    return 'moved : '. $brand . ' | ' . $catalog."\n<br>";
}


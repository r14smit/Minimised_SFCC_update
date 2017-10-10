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
                    'MEES'=>array('MEESSAP','MEES','MEESSAP'),
                    'SB'=>array('SB','SB','SB')
                );

function saveFile($name,$file){
    $fp = fopen($name, 'w');
    fwrite($fp, $file );
fclose($fp);
}

function validNumbers($file){
    $ids = array();
    foreach(file($file) as $line) {
        $id = substr($line,0, strlen($line)-1);
        $ids[$id]=1;
    }
    return $ids;
}
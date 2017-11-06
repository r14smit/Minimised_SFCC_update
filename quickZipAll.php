<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'functions.php';

$file = 'zip/monthly-catalogs-20171005080001.zip';
$stock = 'zip/monthly_price-inventory-20171004000002.zip';

foreach ($brandList as $key => $value) {
 
    echo moveCatalog($file,'unzipped/',$value[0],'MASTER');
    $catalog = $value[1].'-NAVIGATION';
    echo moveCatalog($file,'unzipped/',$value[1],$catalog);

    echo moveCatalog($stock,'unzipped/',$value[0],'inventory-lists');
    $pricebook = $value[0].'-eur-list';
    echo moveCatalog($stock,'unzipped/',$pricebook,'pricebooks');
   
}    
?>


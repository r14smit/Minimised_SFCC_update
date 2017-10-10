<?php
include 'functions.php';
echo "included\n<br>";


$brand=$_GET["brand"];
$file = 'xml/'. $brandList[$brand][0] .'-MASTER-CATALOG/catalog.xml';
$emptyMasters = 'csv/' . $brandList[$brand][0] .'-mastersToRemove.csv';
$xml=simplexml_load_file($file);
$elementsToRemove = array();
$mastersToRemove = '';
$idsToKeep = array();
$idsToRemove = array();


$xmlOut = 'updates/Update_catalogs/catalogs/'. $brandList[$brand][0] .'-MASTER-CATALOG/catalog.xml';

$idsToKeep = validNumbers('csv/' . $brandList[$brand][0] . '-inStock.csv');

foreach($xml->product as $key => $item){
    if (isset($item->variations)){
        if ($item->{'available-flag'} == 'false' || $item->{'searchable-flag'} == 'false' ){
            $mastersToRemove .= $item[0]->attributes()['product-id']."\n";
            $elementsToRemove[] = $item;
            foreach($item->variations->variants->variant as $variant){
                $idsToRemove["$variant[0]->attributes()['product-id']"] = 1;
            }
        }
    }else{ 
        $match = $item[0]->attributes()['product-id'];
        if ($idsToKeep["$match"] != 1){
            $elementsToRemove[] = $item;
        }else if ($idsToRemove["$match"]){
            $elementsToRemove[] = $item; 
        }
    }
}

foreach($xml->{'category-assignment'} as $key => $item){
    $match = $item[0]->attributes()['product-id'];
    if ($idsToKeep["$match"] != 1){
        $elementsToRemove[] = $item;
    }else if ($idsToRemove["$match"]){
        $elementsToRemove[] = $item; 
    }
} 

foreach ($elementsToRemove as $code){
    unset($code[0]);
}    
 saveFile($emptyMasters,$mastersToRemove);


$xml->asXml($xmlOut);

echo "finished -> save";
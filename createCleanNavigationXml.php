<?php
include 'functions.php';
echo "included\n<br>";


$brand=$_GET["brand"];
$file = 'xml/'. $brandList[$brand][1] .'-NAVIGATION-CATALOG/catalog.xml';
$mastersToRemove = 'csv/'. $brandList[$brand][0] .'-mastersToRemove.csv';
$xml=simplexml_load_file($file);
$elementsToRemove = array();
$idsToRemove = array();

$xmlOut = 'updates/Update_catalogs/catalogs/'. $brandList[$brand][1] .'-NAVIGATION-CATALOG/catalog.xml';

$idsToRemove = validNumbers($mastersToRemove);

foreach($xml->{'category-assignment'} as $key => $item){
        $match = $item[0]->attributes()['product-id'];
        if (isset($idsToRemove["$match"])){
            $elementsToRemove[] = $item;
                echo $item[0]->attributes()['product-id'] ."\n<br>";
        }
}

foreach ($elementsToRemove as $code){
    unset($code[0]);
}    

echo "finished -> save";
$xml->asXml($xmlOut);


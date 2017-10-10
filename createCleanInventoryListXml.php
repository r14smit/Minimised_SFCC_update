<?php
include 'functions.php';

$brand = $_GET["brand"];
$file = $brandList[$brand][2].'-inventory-000.xml';
$outFile  = 'updates/' . $brandList[$brand][2] .'-inventory.xml';
$inStock = 'csv/' . $brandList[$brand][0] .'-inStock.csv'; 

$xml=simplexml_load_file("xml/".$file);
$elementsToKeep = array();
$idsAvailable = '';

// loop through records to check availability / stock > 0
echo "loop\n<br>";
  foreach($xml->{'inventory-list'}->records->record as $key => $item)
    {       
        if ($item->allocation > 0 )
            {
                $idsAvailable .= $item[0]->attributes()['product-id']."\n";
            }else{
                $elementsToRemove[] = $item;
            }
      
	}
        

    // remove elements from xml with 0 stock
echo "unset\n<br>";       
        foreach ($elementsToRemove as $code) {
            unset($code[0]);
        }
echo "out.xml\n<br>";	
    // create updated inventory.xml    
    $xml->asXml($outFile);
    

echo "save\n<br>";        
    // save file with available products
    saveFile($inStock, $idsAvailable);        
echo "saved";
?>
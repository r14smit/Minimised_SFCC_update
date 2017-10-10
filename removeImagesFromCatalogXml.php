<?php

$xml=simplexml_load_file("xml/SB-imageUpdate.xml");
$elementsToRemove = array();
$idsToRemove = array();


  foreach($xml->product as $key => $item)
  			{       
          $elementsToRemove[] = $item[0]->images;
         }


  foreach ($elementsToRemove as $code) {
          unset($code[0]);
      }    
	  		$xml->asXml('imagesUpdateCatalog.xml');

echo "exported as imagesUpdateCatalog.xml";
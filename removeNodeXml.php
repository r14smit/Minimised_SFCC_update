<?php

$xml=simplexml_load_file("xml/sb-nav.xml");
$elementsToRemove = array();
  foreach($xml->category as $key => $item)
  			{       
          $newUrl = $item['category-id'];
          echo $newUrl.':';

          if (strpos($newUrl, 'new') !== 0 && strpos($newUrl, 'sale') !== 0){
            echo ' << UNSET<br>';
           $elementsToRemove[] = $item;
          }else{
            echo '<br>';
             if($item->{'page-attributes'} == 'false'){
                  echo 'no atttibutes <br>';
             }else{              
                 $item->{'page-attributes'}->{'page-url'} = $newUrl;
             }
          }
	  		}

        foreach ($elementsToRemove as $code) {
            unset($code[0]);
        }
	  		$xml->asXml('katalog.xml');
?>
<?php

$xml=simplexml_load_file("xml/sb-nav-new.xml");

  foreach($xml->category as $key => $item)
  			{       
          $newUrl = $item['category-id'];
          echo $newUrl.':<br>';
             if($item->{'page-attributes'} == 'false'){
                  echo 'no atttibutes <br>';
             }else{              
                 $item->{'page-attributes'}->{'page-url'} = $newUrl;
             }
	  		}

	  		$xml->asXml('catalog.xml');
?>
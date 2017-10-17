<?php


$xml=simplexml_load_file("xml/altTitled_catalog.xml");
$elementsToRemove = array();
$new = array(0=>'Neue',1=>'New',2=>'Nieuwe');

  foreach($xml->category as $key => $item){       
      $newUrl = $item['category-id'];

      if (strpos($newUrl, 'new-') !== 0 && strpos($newUrl, 'sale-') !== 0){
          echo ' << UNSET<br>';
          $elementsToRemove[] = $item;
      }else{
          if ( strpos($newUrl, 'new-') === 0){
              $count=0;
              foreach($item->{'display-name'} as $key  => $value){
                  $item->{'display-name'}[$count] = $new[$count] .' ' .  $value;
                  $count++;
              }   
          }else{
              $count=0;
              foreach($item->{'display-name'} as $key  => $value){
                  $item->{'display-name'}[$count] = 'Sale' .' ' .  $value;
                  $count++;
              }
  	  		    echo '<hr>';
          }
      }
  }
        
  foreach ($elementsToRemove as $code) {
        unset($code[0]);
  }
	$xml->asXml('katalog.xml');
?>
<?php
include 'functions.php';

$xml=simplexml_load_file("devcatalog.xml");

$elementsToRemove[] = array();


foreach($xml as $key => $item){       
    if($key != 'category'){
           $elementsToRemove[] = $item;

    }else if (strpos($item->attributes()['category-id'],'new-') === 0  || strpos($item->attributes()['category-id'],'sale-') === 0 ){  
                     
          $alternative = $item->{'custom-attributes'}->addChild('custom-attribute', $item->{'display-name'}[0]);
            $alternative->addAttribute('attribute-id','AlternativeTitle');
            $alternative-> addAttribute("xml:lang",'de',"http://schema.omg.org/spec/XMI/2.1");

          $alternative = $item->{'custom-attributes'}->addChild('custom-attribute', $item->{'display-name'}[1]);
            $alternative->addAttribute('attribute-id','AlternativeTitle');
            $alternative-> addAttribute("xml:lang",'x-default',"http://schema.omg.org/spec/XMI/2.1");

          $alternative = $item->{'custom-attributes'}->addChild('custom-attribute', $item->{'display-name'}[2]);
            $alternative->addAttribute('attribute-id','AlternativeTitle');
            $alternative-> addAttribute("xml:lang",'nl',"http://schema.omg.org/spec/XMI/2.1");        

        }else{
           $elementsToRemove[] = $item;
        }


		}

foreach ($elementsToRemove as $code){
    unset($code[0]);
    echo 'unset<br>';
  }  

	$xml->asXml('xml/altTitled_catalog.xml');
?>
<?php
include 'functions.php';

$xml=simplexml_load_file("unzipped/monthly-catalogs-20170905080001/catalogs/SB-NAVIGATION-CATALOG/catalog.xml");

$elementsToRemove[] = array();



//print_r($xml);

//unset($code[0]);

foreach($xml as $key => $item){       

    if($key != 'category'){
           $elementsToRemove[] = $item;
         }else{              
$att = 'xml:lang';

          $count = attributePosition($item->{'custom-attributes'}->{'custom-attribute'},'flyoutSize');
          $number = count($item->{'custom-attributes'}->{'custom-attribute'});

          $alternative = $item->{'custom-attributes'}->addChild('custom-attribute', $item->{'display-name'}[0]);
            $alternative->addAttribute('attribute-id','AlternativeTitle');
            $alternative-> addAttribute("xml:lang",'de',"http://schema.omg.org/spec/XMI/2.1");

          $alternative = $item->{'custom-attributes'}->addChild('custom-attribute', $item->{'display-name'}[1]);
            $alternative->addAttribute('attribute-id','AlternativeTitle');
            $alternative-> addAttribute("xml:lang",'x-default',"http://schema.omg.org/spec/XMI/2.1");

          $alternative = $item->{'custom-attributes'}->addChild('custom-attribute', $item->{'display-name'}[2]);
            $alternative->addAttribute('attribute-id','AlternativeTitle');
            $alternative-> addAttribute("xml:lang",'nl',"http://schema.omg.org/spec/XMI/2.1");

        //  $item->{'custom-attributes'}->{'custom-attribute'}[$number][1]['xml:lang']='x-default';


         // $item->{'custom-attributes'}->{'custom-attribute'}[$number][0]= $item->{'display-name'}[0] ;
        //  $item->{'custom-attributes'}->{'custom-attribute'}[$number][1]= $item->{'display-name'}[1] ;

        //  $item->{'custom-attributes'}->{'custom-attribute'}[$number][0]->attributes()['xml:lang']='x-default';

         
         // $item->{'custom-attributes'}->{'custom-attribute'}[$number][1]->attributes()[0]['attribute-id']='AlternativeTitle';
        
          //$item->{'custom-attributes'}->{'custom-attribute'}[$number]['xml:lang'][0]='de';
          //$item->{'custom-attributes'}->{'custom-attribute'}[$number]['xml:lang'][1]='x-default';
          //$item->{'custom-attributes'}->{'custom-attribute'}[$number]['xml:lang'][2]='nl';          

         }

		}

foreach ($elementsToRemove as $code){
    unset($code[0]);
    echo 'unset<br>';
  }  

	$xml->asXml('1sb_catalog.xml');
?>
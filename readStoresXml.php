<?php
function putinplace($string=NULL, $put=NULL, $position=false)
{
    $d1=$d2=$i=false;
    $d=array(strlen($string), strlen($put));
    if($position > $d[0]) $position=$d[0];
    for($i=$d[0]; $i >= $position; $i--) $string[$i+$d[1]]=$string[$i];
    for($i=0; $i<$d[1]; $i++) $string[$position+$i]=$put[$i];
    return $string;
}

$xml=simplexml_load_file("xml/StoreXML.xml");

print_r($xml->store);

//echo '<H1>' . $xml->stores->header->attributes()['pricebook-id'] . '</h1>';


//echo '<H3>' . $xml->pricebook->{'price-tables'}->{'price-table'}->getName() . '</H3>';

  		foreach($xml->store as $item)
  			{
  				if (strlen ($item->{'country-code'})>2)
  					echo  $item->{'country-code'} . "<br>\n";


  				if ($item->latitude){
  					$match = array();
  					if (preg_match_all('/\./', $item->latitude, $match) == TRUE){
  						echo 'dot inside'. count($match) . ':  ';
  					}else{
  						$item->latitude  =	substr_replace($item->latitude , '.', 2, 0);
					}
					$item->latitude  = substr($item->latitude,0,8);

				}

  				if ($item->longitude){
  					echo $item->longitude . " | ";
  					$match = array();
  					if (preg_match_all('/\./', $item->longitude, $match) == TRUE){
  						echo 'dot inside'. count($match) . ": ";
  					}else if(preg_match_all('/\-0/', $item->longitude, $match) == TRUE){
  						$item->longitude  =	substr_replace($item->longitude , '.', 2, 0);
  					}else if(in_array($item->{'country-code'},array('NO','DK','SE','FI'))){
  						$item->longitude  =	substr_replace($item->longitude , '.', 2, 0);
  					}else{
  						$item->longitude  =	substr_replace($item->longitude , '.', 1, 0);
  					}
  						
  					if (strlen($item->longitude)>8)
  							$item->longitude  = substr($item->longitude,0,8);
  				}
  					

 echo $item->longitude . "<br>\n";
  					

  				//if ($item->longitude)
  					//  echo $item->latitude . "<br>\n";
	  		}

	  		$xml->asXml('updated.xml');
  
?>
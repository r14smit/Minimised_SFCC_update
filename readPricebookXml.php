<?php
$xml=simplexml_load_file("xml/prices.xml");

echo '<H1>' . $xml->pricebook->header->attributes()['pricebook-id'] . '</h1>';


echo '<H3>' . $xml->pricebook->{'price-tables'}->{'price-table'}->getName() . '</H3>';

  		foreach($xml->pricebook->{'price-tables'}->{'price-table'} as $item)
  			{
  				echo "ItemId: " . $item->attributes()['product-id'] . " = ". $item->amount."<br>";
	  		}
  
?>
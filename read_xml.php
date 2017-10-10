<?php
$xml=simplexml_load_file("xml/prices.xml");

echo $xml->getName() . "<br>";

foreach($xml->children() as $child)
  {
  echo "Child - " . $child->getName() . ": " . $child . "<br>";
  	foreach($child->children() as $children)
  	{
  		echo "Children - " . $children->getName() . ": " . $children->attributes()['pricebook-id'] . "<br>";
  		foreach($children->children() as $grandchild)
  		{
  		echo "GrandChild - " . $grandchild->getName() . ": " . $grandchild->attributes()['product-id'] . " == ". $grandchild->amount."<br>";
	  	}
  	}
  }
  print_r($xml);
?>
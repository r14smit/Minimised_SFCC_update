<?php
//$xml=simplexml_load_file("xml/prices.xml");

$output = '';

$extend = ['001','002','003','004'];

foreach(file('outlet.txt') as $line) 
  {
    $child = trim(preg_replace('/\s\s+/', '', $line));
    foreach($extend as $sibling){

      $output .= '<record product-id="'.$child . $sibling.'">';
      $output .= "\n <allocation>5</allocation> \n <perpetual>false</perpetual> \n <preorder-backorder-handling>none</preorder-backorder-handling>";
      $output .= "\n <ats>3</ats> \n <on-order>0</on-order> \n <turnover>1</turnover> \n <custom-attributes>";
      $output .= "\n ";
      $output .= '<custom-attribute attribute-id="stockInStore">0</custom-attribute>';
      $output .= "\n </custom-attributes> \n </record> \n";

    }
  }
  echo $output;
  
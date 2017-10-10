<?php
include 'functions.php';
echo "included\n<br>";

$brand=$_GET["brand"];
$file = $brand.'-master-catalog.xml';
$xml=simplexml_load_file("xml/".$file);

echo "catalog loaded!";


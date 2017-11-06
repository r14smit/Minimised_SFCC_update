<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'functions.php';

$file = 'zip/monthly-catalogs-20171005080001.zip';
$stock = 'zip/monthly_price-inventory-20171004000002.zip';

$zip = zip_open($file);
$stockZip = zip_open($stock);
$selections = '';
$options = '';
$navigation ='';
$stockOptions='';
$priceOptions='';

if (!$_POST){
    foreach ($brandList as $key => $value) {
                $selections .= '<option value="'.$key.'">'.$key.'</option>';
           }   
} else {  

     while($zip_entry=zip_read($zip)) {
           $zdir=dirname(zip_entry_name($zip_entry));
           $zname=zip_entry_name($zip_entry);
           if(strpos($zdir,'catalogs/')>1 && strpos($zdir,'MASTER' )>1 && strpos($zdir,$brandList[$_POST['catalog']][0].'-' )>1){
                $options = $zname;
           }elseif(strpos($zdir,'catalogs/')>1 && strpos($zdir,$brandList[$_POST['catalog']][1].'-')>1){
                $navigation = $zname;
           }
       } 
    zip_close($zip);

    while($zip_entry=zip_read($stockZip)) {
        $zdir=dirname(zip_entry_name($zip_entry));
        $zname=zip_entry_name($zip_entry);

        if(strpos($zdir,'pricebooks')>1 && strpos($zname, 'sale')<1 && strpos($zname,$brandList[$_POST['catalog']][0].'-eur' )>1){
             $priceOptions = $zname;
             echo $priceOptions ."-<br>" ;
        }else if(strpos($zdir,'inventory-lists')>1 && strpos($zname,$brandList[$_POST['catalog']][0].'-in' )>1){
             $stockOptions = $zname;
             echo $stockOptions."-<br>" ;
        }
    }



    $zipCat = new ZipArchive;
    $res = $zipCat->open($file); 


    if ($res === TRUE) {
        //chmod("unzip\\", 0644); 
        $zipCat->extractTo('unzipped/',$options);
        $zipCat->extractTo('unzipped/',$navigation);
        $zipCat->close();
    }
    
    $zipIn = new ZipArchive;
    $res = $zipIn->open($stock);
    if ($res === TRUE) {
        //echo 'prices';
        //chmod("unzip\\", 0644); 
        if ($zipIn->extractTo('unzipped/',$stockOptions)){
            echo "zipped in \n";
        }else{
            'not zipped :-(';
        }
        $zipIn->extractTo('unzipped/',$priceOptions);
        
        $zipIn->close();
    }else {
    echo "Could not open file";
    }

}    
?>
<html>
    <head>
        <title>Unzip my file</title>            
    </head>
    <body>
<?php   if (!empty($selections)){?>
            <form action="" method="post">
                <select name="catalog">
                    <?php echo $selections; ?>
                </select><br>
                <input type="submit" value="Selecteer">

            </form>  
<?php   }else{
          
          //exec('wget http://createCleaninventoryListXml.php?brand=' . $_POST['catalog']);

        } 



        ?>
    </body>
</html>


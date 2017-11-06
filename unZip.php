<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$file = 'zip/monthly-catalogs-20171005080001.zip';
$stock = 'zip/monthly_price-inventory-20171004000002.zip';

$zip = zip_open($file);
$stockZip = zip_open($stock);
$options = '';
$stockOptions='';
$priceOptions='';

if (!$_POST){
    while($zip_entry=zip_read($zip)) {
           $zdir=dirname(zip_entry_name($zip_entry));
           $zname=zip_entry_name($zip_entry);
           if(strpos($zdir,'catalogs/')>1 && strpos($zdir,'MASTER')>1){
                $value = substr($zdir, strpos($zdir, 'catalogs/')+9);
                $options .= '<option value="'.$zname.'">'.$value.'</option>';
           }
       } 
    zip_close($zip);
    while($zip_entry=zip_read($stockZip)) {
        $zdir=dirname(zip_entry_name($zip_entry));
        $zname=zip_entry_name($zip_entry);
        if(strpos($zdir,'pricebooks')>1 && strpos($zname, 'sale')<1){
             $value = substr($zname, strpos($zname, 'pricebooks/')+11, strlen($zname));
             $priceOptions .= '<option value="'.$zname.'">'.$value.'</option>';
        }else if(strpos($zdir,'inventory-lists')>1){
             $value = substr($zname, strpos($zname, '/inventory-lists/')+17, strlen($zname));
             $stockOptions .= '<option value="'.$zname.'">'.$value.'</option>';
        }
    }
    
} else {  

    $zipCat = new ZipArchive;
    $res = $zipCat->open($file); 

    if ($res === TRUE) {
        //chmod("unzip\\", 0644); 
        $zipCat->extractTo('unzipped/',$_POST['catalog']);
        $zipCat->close();
    }
    
    $zipIn = new ZipArchive;
    $res = $zipIn->open($stock);
    if ($res === TRUE) {
        echo 'prices';
        //chmod("unzip\\", 0644); 
        $zipIn->extractTo('unzipped/',$_POST['stock']);
        $zipIn->extractTo('unzipped/',$_POST['price']);
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
<?php   if (!empty($options)){?>
            <form action="" method="post">
                <select name="catalog">
                    <?php echo $options; ?>
                </select><br>
                <select name="stock"><br>
                    <?php echo $stockOptions; ?>
                </select>
                 <select name="price"><br>
                    <?php echo $priceOptions; ?>
                </select>
                <input type="submit" value="Selecteer">

            </form>  
<?php   }else{
            echo $_POST['catalog'] .' - UNZIPPED!<br>';
             echo $_POST['stock'] .' - UNZIPPED!<br>';
        } 

//exec('wget http://createCleaninventoryListXml.php);

        ?>
    </body>
</html>


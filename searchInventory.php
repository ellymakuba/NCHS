<?php
require 'data_access_object.php';
$dao=new DAO();
$dao->checkLogin();
$q=$_GET['term'];
$drugs=$dao->getInventoryByName($q);
foreach($drugs as $drug)
{
 $obj[]=array('id' => $drug['id'],'name' => $drug['name'],'stock' => $drug['stock']);
}
print json_encode($obj);
?>

<?php
require 'data_access_object.php';
$dao=new DAO();
$dao->checkLogin();
$q=$_GET['term'];
$tests=$dao->getLabTestByName($q);
foreach($tests as $test)
{
 $obj[]=array('id' => $test['lab_id'],'test' => $test['test'],'cost' => $test['cost']);
}
print json_encode($obj);
?>

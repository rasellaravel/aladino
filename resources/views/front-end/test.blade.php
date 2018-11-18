

<?php
$info = array();
foreach($MenuCategory as $MenuCategory){

   $arr[] = $MenuCategory;
}


$info = $arr;
$obj = (object)$info;
print(json_encode($obj));

?>
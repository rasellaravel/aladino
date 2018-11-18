<?php

foreach ($result as  $value) {
	$arr[]= $value['domain_name'];
}

print_r($arr);
if(in_array('APP_DOMAIN', $arr)){
	echo 'this page display';
}else{
	echo'sorry';
}

echo Request::server ("HTTP_HOST");
?>


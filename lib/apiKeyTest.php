<?php
include './apiKey.class.php';
$api_key_obj = new ApiKey();
$api_key = $api_key_obj->createApiKey();
print 'out put apikey is :';
print $api_key.'</br>';

$timestamp = time();
$once = time().'asf';
$tmpArr = array($api_key,$timestamp,$once);
sort($tmpArr);
$tmpStr = implode( $tmpArr );
$tmpStr = sha1($tmpStr);
$signature_test = $api_key_obj->checkApiKey($api_key,$timestamp,$once,$tmpStr);
var_dump($signature_test);
?>
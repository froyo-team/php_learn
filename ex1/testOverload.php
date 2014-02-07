<?php
include './User.class.php';
$user = new User();
$user->setName('froyo');
$user->setId(1);
$user->setEmail('xianlong300@sina.com');

echo $user->getname();
echo '</br>';
echo $user->getid();
echo '</br>';
echo $user->getemail();
echo '</br>';
?>
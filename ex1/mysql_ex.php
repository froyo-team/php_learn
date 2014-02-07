<html>
<head>
	<meta charset="utf-8">
	<title>数据库相关</title>
</head>
<body>

<?php
try {
	$connect = @mysql_connect('localhost','root','111111');//创建连接

} catch (Exception $e) {
	var_dump($e);
	print ('database connect error');
	die;
}
if($connect!=false){
	$db = mysql_select_db('cdcol');//选择数据库

	//mysql_query('SET NAMES UTF8');//设置连接字符为utf-8
}else{
	print 'database connect error';
	die;
}

$sql = "SELECT * FROM USER WHERE `status` = '1'";

$result = mysql_query($sql);

var_dump(mysql_pconnect());
print '<p>mysql_fetch_array</p>';

while($row = mysql_fetch_array($result)){
	var_dump($row);
	print '</br>';
}
print '<p>mysql_fetch_field</p>';

while($row = mysql_fetch_field($result)){
	var_dump($row);
	print '</br>';
}
print '<p>mysql_fetch_row</p>';
var_dump(mysql_fetch_row($result));
while($row = mysql_fetch_row($result)){
	var_dump($row);
	print '</br>';
}





?>
</body>
</html>



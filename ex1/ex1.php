<?php
$test_array_has_key= array('key1'=>1,"key2"=>2,'key3'=>3,'key4'=>4);
$test_array_no_key = array('key1','key2','key3','key4');
?>

<html>
<head>
	<meta charset="utf-8">
	<title>php相关实验一</title>
</head>
<body>
	<artical>
		<header>数组题</header>
		$test_array_has_key= array('key1'=>1,"key2"=>2,'key3'=>3,'key4'=>4);</br>
		$test_array_no_key = array('key1','key2','key3','key4');</br>
		下面的输出:</br>
		<p>
			foreach ($test_array_has_key as $key => $value) {</br>
				print $key.',';</br>
			}</br>
			答案:
			<?php
				foreach ($test_array_has_key as $key => $value) {
					print $key.',';
				};
			?>
		</p>
		<p>
			foreach ($test_array_no_key as $key => $value) {</br>
				print $key.',';</br>
			}/<br>
			答案:
			<?php
				foreach ($test_array_no_key as $key => $value) {
					print $key.',';
				};
			?>
		</p>
		<p>
			foreach ($test_array_has_key as $value) {</br>
				print $value.',';</br>
			}</br>
			答案:
			<?php
				foreach ($test_array_has_key as $key => $value) {
					print $value.',';
				};
			?>
		</p>
		<p>
			foreach ($test_array_no_key as $value) {</br>
				print $value.',';</br>
			}</br>
			答案:
			<?php
				foreach ($test_array_no_key as $key => $value) {
					print $value.',';
				};
			?>
		</p>

	</artical>

</body>
</html>


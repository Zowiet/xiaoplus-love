<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<title>love</title>
<style>
table{
	margin:0 0 1em 1em;
	width: 10em;
	text-align:left;
	background: ;
	border: 2px solid black;
}

table th{

}
</style>
</head>
	<body>
	<?php
		foreach ($letters as $piece) {
			# code...
			echo "<table><tr><th>情书ID</th><td>",$piece['id'],"</td></tr>\n
				<tr><th>微博ID</th><td>",$piece['to_weibo_id'],"</td></tr>\n
				<tr><th>微博名</th><td>",$piece['to_weibo_name'],"</td></tr>\n
				<tr><th>表白者Uid</th><td>",$piece['from_uid'],"</td></tr>\n
				<tr><th>情书内容</th><td>",$piece['content'],"</td></tr></table>\n";
			
		}
	?>

	</body>
</html>
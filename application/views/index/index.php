<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<title>love</title>
</head>
	<body>
		<form id = "love_letter_form" action = "./index.php/Letter/publish" method ="POST">
			<table>
				<tr>
					<th>对象微博名</th>
					<td><input type = "text" size = "30" name = "to_weibo_name" /></td>
				</tr>
				<tr>
					<th>您的ID</th>
					<td><input type = "text" size = "30" name = "to_weibo_id" value=1 /></td>
				</tr>
				<tr>
					<th>是否匿名通知</th>
					<td><input type = "text" size = "30" name = "publish" /></td>
				</tr>
				<tr>
					<th>情书内容</th>
					<td><textarea rows = "10" cols = "60" name = "content" /></textarea></td>
				</tr>
				<tr>
					<th>
						<input type = "submit" name = "love_letter_submit" />
					</th>
				</tr>
			</table>
		</form>

		<form id = "comment_form" action = "./index.php/Letter/comment_submit" method ="POST">
			<table>
				<tr>
					<th>评论者ID</th>
					<td><input type = "text" size = "30" name = "from_uid" /></td>
				</tr>
				<tr>
					<th>情书ID</th>
					<td><input type = "text" size = "30" name = "loveletter_id" value=1 /></td>
				</tr>
				<tr>
					<th>对象ID</th>
					<td><input type = "text" size = "30" name = "to_uid" /></td>
				</tr>
				<tr>
					<th>评论内容</th>
					<td><textarea rows = "10" cols = "60" name = "comments" /></textarea></td>
				</tr>
				<tr>
					<th>
						<input type = "submit" name = "comment_submit" />
					</th>
				</tr>
			</table>
		</form>

	</body>
</html>
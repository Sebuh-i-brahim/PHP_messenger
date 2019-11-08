
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="login" method="post">
	<input type="text" name="name">
	<input type="text" name="surname">
	<input type="hidden" name="<?=Config::get('session/token_name')?>" value="<?=Token::generate();?>">
	<input type="submit">
</form>
</body>
</html>

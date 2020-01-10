<head>
	<title><?=(isset($_head['title']))? $_head['title'] : 'My Messenger';?></title>
	<meta charset="utf-8">
	<meta name="description" content="Free Social Network">
	<meta name="author" content="Sebuhi Ibrahimov">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<?php if(isset($_head['refresh'])):?>
	<meta http-equiv="refresh" content="<?=e($_head['refresh']);?>">
	<?php endif;?> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if(!empty($_head['links'])):?>
		<?php foreach ($_head['links'] as $link):?>
	<link rel="stylesheet" type="text/css" href="<?=e($link)?>">
		<?php endforeach;?>
	<?php endif;?>
	<?php if(!empty($_head['scripts'])):?>
		<?php foreach($_head['scripts'] as $script):?>
	<script type="text/javascript" src="<?=e($script)?>"></script>
		<?php endforeach;?>
	<?php endif;?>
</head>
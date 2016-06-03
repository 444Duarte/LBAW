<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>{block name="title"}Toolbox Website{/block}</title>
		<base href="{$BASE_URL}">
		{block name="css"}
			<link rel="stylesheet" type="text/css" href="lib/bootstrap-3.3.6-dist/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="css/lavish-bootstrap.css">
			<link rel="stylesheet" type="text/css" href="css/generic_template.css">
		{/block}
	</head>
	<body>
		{block name="content"}{/block}
		{block name="js-code"}{/block}
		{block name="js"}
			<script src="lib/jquery-1.12.1.min.js"></script>
			<script src="lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		{/block}
	</body>
</html>
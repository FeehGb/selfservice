<?php
	require(dirname( __FILE__ ) . '/start.php');

	if($USER_AUTHORIZED == false){
		require_once(ROOTPATH."admin/restrict.php");
	}
echo $USER_AUTHORIZED;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>

<body>
</body>
</html>
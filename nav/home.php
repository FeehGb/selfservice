<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>

<body>

<?php 


$ss_usuarios = $mySQL->queryString("SELECT * FROM ss_usuarios");

if ($mySQL->num_row >= 1) {


    foreach ($ss_usuarios as $field => $data) {

        echo ($data[us_nome]);

    }



}
var_dump($ss_usuarios);
?>

</body>
</html>
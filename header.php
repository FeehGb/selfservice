<?php __addSlash();?>
<!doctype html>
<html>
<head>
<title>TITULO DO SITE</title>
<?php require_once ROOTPATH."addons/html/metatags.php"?>
<?php require_once ROOTPATH."load.js.php";?>

<script>

</script>
</head>
<body>

<div id="page">
<?php 
	######### Valida browser ############
 	$u_agent = $_SERVER['HTTP_USER_AGENT'];
    $ub = '';
	if(preg_match('/MSIE/i',$u_agent))
	{
	  ?>
<!--[if lt IE 9]>
		 <script type="text/javascript">
			$(document).ready(function(){
                $("body").html('<div class="wrap browser"><div id="ie_message" style="display:none;"><h1>Atenção browser nao suportado.!</h1> <strong>Esta versão Internet Explorer Não tem suporte para rodar este site.</strong> Por favor faça o download de um Browser mais recente, <a href="http://www.microsoft.com/windows/internet-explorer/" target="_blank">última versão do IE</a>, ou use um browser mais moderno <a href="http://www.mozilla.com" target="_blank">Firefox</a> ou <a href="http://www.google.com/chrome" target="_blank">Google Chrome</a>.<br /><div class="content-browser">Mude seu browser, veja a internet como realmente deve ser =D</div></div><br /></div>');
                $("#ie_message").hide().fadeTo("slow","1").show("slow");
			});
		</script>
		<![endif]-->
<?php
    } 

?>

<!--Header-->


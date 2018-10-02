<?php

$css    = '<link href="' . $_SESSION["URL_BASE"] . '/style/page-style.css" rel="stylesheet" type="text/css" />';
$script = '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/jquery.js"></script>';
if(isset($_SESSION["USER_AUTHORIZED"])){$script .= '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/jquery.fn.ui.js"></script>';}
$script .= '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/jquery.fn.js"></script>';
switch ($current_page)
{
	case 'home':
	case '':
		
		break;
	case 'sobre':

		break;
	case 'roteiros':
		$css    .= '<link href="' . $_SESSION["URL_BASE"] . '/style/shadowbox.css" rel="stylesheet" type="text/css" />';
		$script .= '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/shadowbox.js"></script>';
		break;
	case 'contato':
	case 'depoimento':
		$script .= '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/jquery.fn.form.js"></script>';
		
		break;
}
echo $css;
echo $script;
?>
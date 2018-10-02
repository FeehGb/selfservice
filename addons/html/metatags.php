<?php 
switch($current_page){
		case 'home':
		case '':
		$meta = '<meta name="description" content="">';
		$meta .= '<meta name="keywords" content="" />';	
		break;
		
		case 'como-funciona':
		$meta = '<meta name="description" content="">';
		$meta .= '<meta name="keywords" content="" />';	
		break;
		
		case 'servicos':
		$meta = '<meta name="description" content="">';
		$meta .= '<meta name="keywords" content="" />';	
		break;
		
		case 'colaboradores':
		$meta = '<meta name="description" content="">';
		$meta .= '<meta name="keywords" content="" />';	
		break;
		
	}
?>

<?php
$meta .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
$meta .= '<meta charset="utf-8">';
$meta .= '<meta name="title" content="" />';
$meta .= '<meta name="url" content="" />';
$meta .= '<meta name="language" content="Portuguese, English" />';
$meta .= '<meta name="Distribution" content="Global" />';
$meta .= '<meta name="author" content="Felipe Augusto Gonçalves Basilio" />';
$meta .= '<meta name="Designer" content="Felipe Augusto Gonçalves Basilio" />';
$meta .= '<meta name="Rating" content="General" />';
$meta .= '<meta name="robots" content="ALL" /> ';
echo $meta;
?>

<link href="<?php echo $_SESSION["URL_BASE"];?>/style/img/favicon.png" rel="SHORTCUT icon" type="image/x-icon" />

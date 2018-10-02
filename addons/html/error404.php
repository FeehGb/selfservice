<?php 
  /*
   * Inicia a sessão caso nao exista
   */
  if ( !isset( $_SESSION ) )
  {
	  session_start();
  }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Error 404 - Pagina não encontrada...!</title>
<link href="<?php echo $_SESSION["URL_BASE"];?>/style/img/favicon.png" rel="SHORTCUT icon" type="image/x-icon" />
<link href="<?php echo $_SESSION["URL_BASE"] ?>/style/error404.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="page" class="error404">
<header>
<nav>
      <div id="menu">
        <ul id="nav">
		<li class="blue"><a class="box-t" desc="Voltar ao inicio"			href="<?php echo $_SESSION["URL_BASE"];?>/home">Home</a></li>
        <li class="green"><a class="box-t" desc="Um pouco sobre nós" 			href="<?php echo $_SESSION["URL_BASE"];?>/sobre">Sobre</a></li>
        <li class="red"><a class="box-t" desc="Conheça nossos roteiros" 		href="<?php echo $_SESSION["URL_BASE"];?>/roteiros">Roteiros</a></li>
        <li class="black"><a class="box-t" desc="Entre em contato conosco" 	href="<?php echo $_SESSION["URL_BASE"];?>/contato">Contato</a></li>
        </ul>
      </div>
    </nav></header>
 <section>
	<article id="error404"></article>
</section>
</div>

</body>
</html>
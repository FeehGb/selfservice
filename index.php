
<?php
	
	require(dirname( __FILE__ ) . '/start.php');
	/*
	 * Criação da Url padrão para poder trabalhar com url amigaveis
	 */
	define( 'SERVER_NAME', $_SERVER[ 'SERVER_NAME' ] );
	define( '_URI', $_SERVER[ 'REQUEST_URI' ] );
	define( 'SERVER_VALUE', SERVER_NAME != "localhost" ? 1 : 2 );
	define( 'path', ROOTPATH . "nav" );
	
	$_SESSION["URL_BASE"] 	= SERVER_NAME == "localhost"? "http://" . SERVER_NAME . "/selfservice":"http://" . SERVER_NAME;
	$_URI          			= explode( "/", _URI );
	$current_page  			= strtolower( $_URI[ SERVER_VALUE ] );
	
	
	$released_page = array(
		'home',
		'como-funciona',
		'projetos',
		'colaboradores',
		'contato',
		'login',
		'painel'
		

	);
	
	
	
	$NOT_FOUND = $_SESSION["NOT_FOUND"];
	ob_start();
	if ( ( $current_page == "" ) || ( isset( $current_page ) && ( in_array( $current_page, $released_page ) ) ) )
	{
		unset($_SESSION["NOT_FOUND"]);
		#incluindo o header
		require_once( ROOTPATH . "header.php" );
		
		#gera pagina dinamicamente
		switch ( $current_page )
		{
			case "":
				require_once( path . "/home.php" );
				break;
			default:
				require_once( path . '/' . $current_page . '.php' );
				break;
		}
		#incluindo o footer
		require_once( ROOTPATH . 'footer.php' );
		
	}
	else
	{
		require_once(ROOTPATH."addons/html/error404.php");
		
	}
	ob_end_flush(); 
	?>
	




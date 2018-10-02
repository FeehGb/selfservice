<?php

/*
 * Inicia a sessão caso nao exista
 */

if ( !isset( $_SESSION ) ) {
	session_start();
}

define( 'ROOTPATH', dirname( __FILE__ ) . '/' );
define( 'PHPSCRPATH', ROOTPATH . 'addons/' );
/*
 * Inclue as funções e a coneção com o banco de dados
 */
require_once( ROOTPATH . "Connections/db.class.php" );
require_once( PHPSCRPATH . "addons.fn.php" );

if ( isset( $_SESSION[ "USER_AUTHORIZED" ] ) ) {
	$USER_AUTHORIZED = true;

}

?>
<?php

/**
 * db.class.php
 *
 * Classe para manipulação do Banco de dados
 * Interface para GD
 *
 * @author     Felipe Augusto Gonçavelves Basilio 
 * @version    1.0 
 *
 * TODO:
 */
/* Set a timezone de São Paulo*/
date_default_timezone_set('America/Sao_Paulo');

/*
 * Classe de conexao com o banco de dados extende o PDO
 */

class DB__connect extends PDO
{
    private $instancia;
    /*
     * Funcao para conexao usando o PDO
     * @return Object instancia objeto
     */
    public function PDOconnection($db_host, $db_user, $db_pass, $db_name)
    {
        define('DB_HOST', $db_host);
        define('DB_USER', $db_user);
        define('DB_PASS', $db_pass);
        define('DB_NAME', $db_name);

        var_dump(isset($this->instancia));
        if (!isset($this->instancia)) {
            try {
                $this->instancia = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ));
                $this->instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                exit('Não foi possível conectar: ' . $e->getMessage());
            }
        }

        return $this->instancia;
    }

}

/**
 * Class para executar as query do banco de dados
 */
class DB__query extends DB__connect
{
    public $conn,
        $num_row,
        $success = false,
        $lastInsertId,
        $get_all_fields;

    private $table;

    /**
     * Construtor
     * @param $string dados de conexao
     * @return void
     */
    public function __construct($db_host, $db_user, $db_pass, $db_name)
    {
        $this->conn = parent::PDOconnection($db_host, $db_user, $db_pass, $db_name);

    }

    /**
     * SELECT
     * @param array 	$table Tabela selecionada
     * @param array 	$field Campos seleciionado
     * @param string 	$clause Complemento da query
     * @return string 	data com:
     * [field], [fav] - "field as values", [table],[clause],[rowCount]
     * @exemplo __SELECT(nomeDaTabela,CamposSelecionados/Clausula*, Clausula)
     * **Clausula - Se $Field = null e $Clause = null - Selecionado todos os campos da tabela
	 				Se $Field = null a variavel $field se torna a variavel $clause e seleciona todos campos da tabela...
     */



    public function queryString($_query)
    {

        //var_dump($_query);
        $output = [];
        $query = $this->conn->prepare($_query);
        if ($query->execute()) {

            $fields = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($fields as $key => $field) {
                foreach ($field as $data => $value) {

                    $output[$key][$data] = $value;

                    //var_dump($key, $data, $value);
                }
            }
        }
        $this->num_row = $query->rowCount();
        return $output;
    }








    public function __SELECT($table, $field = null, $clause = null)
    {
        $output = null;

        if (is_array($field)) {
            $field = implode(', ', $field);
        } else {
            if ($field == null && $clause == null) {
                $field = "*";
                $clause = "";
            } else if ($clause === null) {
                $clause = $field;
                $field = "*";
            }
        }

        try {
            $query = $this->conn->prepare("SELECT " . $field . " FROM " . $table . " " . $clause);
            if ($query->execute()) {

                for ($k = 0; $fetch = $query->fetch(PDO::FETCH_BOTH); $k++) {
                    for ($i = 0; $i < $query->columnCount(); $i++) {
                        $meta = $query->getColumnMeta($i);
                        $output[$k][$meta[name]] = $fetch[$meta[name]];
                    }
                }


                $this->num_row = $query->rowCount();// Numeros de conjunto de DADOS
                $this->success = $this->num_row >= 1 ? true : false;

            }



        } catch (Exception $e) {
            $this->success = false;
            echo "Erro ao tentar Fazer SELECT em $table: " . $e->getMessage();
        }

        $this->table = $meta[table];
        $this->output = $output;



        return array(
            "data" => array(
                "output" => $this->output,
                "field" => array_keys($this->output[0]),
                "table" => $table,
                "clause" => $clause,
                "query" => $query->queryString
            ),
            "rowCount" => $this->num_row
        );
    }


    /**
     * Catch_
     * Funcao de auxilio a funcao __SELECT
     * @param string 	$field campo selecionado
     * @param int	 	$index usado para loop defaut 0
     * @return Variavel GLOBALS sendo o nome do propio campo
     */
    public function catch_($field, $index = "0")
    {
        if (is_array($field)) {
            foreach ($field as $Fields) {
                $GLOBALS["$Fields"] = $this->output[$index][$Fields];
            }
        } else {
            $GLOBALS["$field"] = $this->output[$index][$field];
        }

    }


    /**
     * Catch_
     * Funcao de auxilio a funcao __SELECT
     * @param funct func_get_args << >> Pegar todos os parametros passados
     * @param mixed [,$_args... , $index] onde o ultimo sempre sera o int para o loop
     * @return variavel GLOBALS sendo o nome do propio campo
     */
    public function fetch_( /*mixed [,$_args... , $index]*/ )
    {
        $_args = func_get_args();
        $index = array_pop($_args);
        $array_push = array();

        if (!is_int($index)) {
            array_push($_args, $index);
            $index = "0";
        }
        if (is_array($_args)) {
            foreach ($_args as $field) {

                $GLOBALS["$field"] = $this->output[$index][$field];
                $array_push = array_merge_recursive($array_push, array(
                    $field => $this->output[$index][$field]
                ));

            }
        }
        return array(
            "fields" => $_args,
            "table" => $this->table,
            $this->table => $array_push
        );
    }



    /**
     * __INSERT
     * Funcao para tratamento de dados quer serao inseridos
     * @param string 	$table tabela selecionado
     * @param array 	$field campos que quer inserir
     * @param array 	$value_field valor para o campo selecionado
     * @return function query__execute que ira executar a query
     */
    public function __INSERT($table, $field, $value_field)
    {
        if ((is_array($field)) and (is_array($value_field))) {

            $field = $this->prepare_str($field);
            $value_field = $this->prepare_str($value_field);


            if (count($field) == count($value_field)) {
                $__INSERT = "INSERT INTO `" . $table . "` (" . implode(', ', $field) . ") VALUES ('" . implode('\', \'', $value_field) . "')";
            } else {
                trigger_error("Um Erro foi encontrado em sua query, o numero campos nao correspondem aos numeros de valores para o mesmo!.");
                return;
            }

        } else {

            $field = trim($field);
            $value_field = str_replace(",", "','", trim($value_field));
            $__INSERT = "INSERT INTO " . $table . " (" . $field . ") VALUES ('" . $value_field . "') ";

        }
        var_dump($__INSERT);

        return $this->query__execute($__INSERT);
    }

    /**
     * __INSERT__
     * Funcao para tratamento de dados quer serao inseridos
     * @param string 	$table tabela selecionado
     * @param array 	$field campos que quer inserir
     * @param array 	$value_field valor para o campo selecionado
     * @return function query__execute que ira executar a query
     */
    public function __INSERT__($table, $field, $value_field, $source_table, $clause = null)
    {
        if ((is_array($field))) {

            $field = $this->prepare_str($field);

            if (count($field) == count($value_field)) {
                $__INSERT__ = "INSERT INTO {$table} (" . implode(', ', $field) . ") SELECT " . implode('\', \'', $value_field) . " FROM " . $source_table . " " . $clause;
            } else {
                trigger_error("Um Erro foi encontrado em sua query, o numero campos nao correspondem aos numeros de valores para o mesmo!.");
                return;
            }

        } else {
            $__INSERT__ = "INSERT INTO {$table} (" . trim($field) . ") SELECT " . trim($value_field) . " FROM " . $source_table . " " . $clause;
        }

        return $this->query__execute($__INSERT__);
    }

    /**
     * __UPDATE
     * Funcao para tratamento de dados quer serao atualizados
     * @param string 	$table tabela selecionado
     * @param array 	$field campos que quer atualizar
     * @param array 	$new_value_field  novo valor para o campo selecionado
     * @param string 	$clause complemento da query
     * @return function query__execute que ira executar a query
     */
    public function __UPDATE($table, $field, $new_value_field, $clause = null)
    {
        if ((is_array($field)) and (is_array($new_value_field))) {

            $new_value_field = $this->prepare_str($new_value_field);


            $countF = count($field);
            for ($i = "0"; $i < $countF; $i++) {
                $set_values[$i] = trim($field[$i]) . " = '" . $new_value_field[$i] . "'  ";
            }

            if (count($field) == count($new_value_field)) {
                $__UPDATE = "UPDATE {$table} SET " . implode(', ', $set_values) . " " . $clause;
            } else {
                trigger_error("Um Erro foi encontrado em sua query, o numero campos nao correspondem aos numeros de valores para o mesmo!.");
                return;
            }

        } else {
            $field = trim($field);
            $value_field = str_replace(",", "','", trim($new_value_field));

            $__UPDATE = "UPDATE {$table} SET " . trim($field) . " = '" . $new_value_field . "' " . $clause;
        }

        return $this->query__execute($__UPDATE);

    }


    /**
     * __DELETE
     * Funcao para tratamento de dados quer serao atualizados
     * @param string $table tabela selecionado
     * @param string $where condicao para deletar a tabela
     * @return function query__execute que ira executar a query
     */
    public function __DELETE($table, $where)
    {
        $__DELETE = "DELETE FROM {$table} WHERE {$where}";
        return $this->query__execute($__DELETE);
    }

    /**
     * query__execute
     * Funcao para tratamento de dados quer serao atualizados
     * @param string $query query a ser executada
     * @param string $msg mensagem de retorno se ouver sucesso
     * @return string 	queryString com o sql executado
     */
    private function query__execute($query, $__FUNCTION__ = "")
    {
        try {
            $query = $this->conn->prepare_str($query);
            if ($query && $query->execute()) {
                $this->success = true;
                $this->lastInsertId = $this->conn->lastInsertId();
            }

        } catch (Exception $e) {
            $this->success = false;
            echo "<div class='error'> <i>Error Found</i> : " . $e->getMessage() . "</div>";
        }

        return array(
            "Success" => $this->success,
            "queryString" => $query->queryString,
            "rowCount" => $query->rowCount,
            "columnCount" => $query->columnCount,
            "error" => $query->errorCode(),
            "errorInfo" => $query->errorInfo(),

        );
    }

    private function trim_array(&$value)
    {
        return trim($value);
    }
    private function addslashes_array(&$value)
    {
        return addslashes($value);
    }

    private function prepare_str($str)
    {
        $str = array_map("$this->trim_array", $str);
        $str = array_map("$this->addslashes_array", $str);
        $str = preg_replace('/\s(?=\s)/', '', $str);
        $str = preg_replace('/[\n\r\t]/', ' ', $str);
        $str = preg_replace('/"/', "'", $str);

        return $str;

    }
}


define(SERVER_NAME, $_SERVER['SERVER_NAME']);

$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";

if (SERVER_NAME == "selfservice") {
    $db_host = "selfservice";
    $db_user = "root";
    $db_pass = "";
    $db_name = "selfservice_bd";
}

$mySQL = new DB__query($db_host, $db_user, $db_pass, $db_name);
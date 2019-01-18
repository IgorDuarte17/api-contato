<?php

namespace Controllers\controllers;

use PDO;

/**
* API Contato
*
* Classe de conexão com Banco de Dados
*
* @author Igor Santos <igors.d@hotmail.com>
*
* @package controllers
* @version 1.0
*/

class Database
{
    /**
    * @var \PDO
    */
    public $pdo;

    /**
    * Função para conectar no banco de dados
    *
    * @return $pdo conexao com banco de dados
    */
    public function Connect()
    {   
        require 'config/db.php';
        try
        {        
            $pdo = new PDO($dbDSN, $dbUser, $dbPass);
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
        return $pdo;
    }

    /**
    * Função que fecha conexão com banco de dados
    *
    * @param string $pdo - Conexão com banco de dados
    *
    */ 
    public function Disconnect($pdo)
    {
        $pdo = null;
    }

    /**
    * Função para executar consulta no banco de dados
    *
    * @param string $query - Query a ser executada
    *
    * @return array $list - Dados da consulta
    */
    public function ExecuteQuerySelect($query)
    {
        try
        {
            $conn = $this->Connect();

            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
        finally
        {
            $this->Disconnect($conn);
        }
    }
}

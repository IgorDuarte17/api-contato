<?php

namespace Controllers\controllers;

use PDO;

/**
* API Contato
*
* Classe de Contato
*
* @author Igor Santos <igors.d@hotmail.com>
*
* @package controllers
* @version 1.0
*/

class Contato
{
    /**
    * Função que busca contatos cadastrados no banco de dados
    *
    * @return array - Contatos
    */
    function get()
    {
        $sqlQuery = " SELECT c.nome AS Nome, c.email AS Email FROM contato c ";

        try
        {
            $database = new Database();
            return $database->ExecuteQuerySelect($sqlQuery);
        }
        catch (PDOException $e)
        {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }

    /**
    * Função para cadastrar contatos no banco de dados
    *
    */
    function post($request)
    {
        $database = new Database();
        $conn = $database->Connect();
     
        $contato = $request->getParsedBody();

        $sqlQuery = "INSERT INTO contato (nome, email) VALUES(:nome, :email)";
    
        try
        {
            $stmt = $conn->prepare($sqlQuery);
    
            $stmt->bindParam("nome", $contato['nome']);
            $stmt->bindParam("email", $contato['email']);
            
            $stmt->execute();
        }
        catch (PDOException $e)
        {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
        finally
        {
            $database->Disconnect($conn);
        }
    }
}
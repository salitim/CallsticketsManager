<?php


class dbConnect
{

    /**
     *Retourne une connexion à la BDD
    *@return PDO
    **/
    function getPdo()
    {

        return $pdo = new PDO('mysql:host=localhost;dbname=eval;charset=utf8', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

}
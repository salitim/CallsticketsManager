<?php

require_once('Manager.php');

class DataControl extends dbConnect
{   
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->getPdo();
    }

    /**
     * Le total des sms
     * @return int
     */
    public function totalSms($nature)
    {
        $query = $this->pdo->prepare('SELECT COUNT(*) FROM ticketsappels WHERE nature <= :nature');
        $query->execute(['nature' => $nature]);
        return  $query->fetchColumn();
    }


    /**
     * durée des appels réels
     * @return string
     */
    public function dureeAppelReel()
    {

        $query = $this->pdo->query("SELECT sum(volumereel) FROM ticketsappels WHERE jour >= 2012-02-15");
        $volumesReel = $query->fetchColumn();

        return $volumesReel;
    }


    /**
     * TOp 10 des facture réeles
     * @return array
     */
    public function top10FactureReel()
    {
        $query = $this->pdo->query("SELECT volumefacture 
        FROM ticketsappels 
        WHERE heure 
        NOT BETWEEN '08:00:00' AND '18:00:00'
        ORDER BY volumefacture DESC
        LIMIT 10
    ");

        return $query->fetchAll();
    }
}

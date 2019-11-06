<?php

/**
 *Retourne une connexion à la BDD
 *@return PDO
 **/
function getPdo()
{

    return new PDO('mysql:host=localhost;dbname=eval;charset=utf8', 'root', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

/**
 * Le total des sms
 * @return int
 */

function totalSms($nature)
{
    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM ticketsappels WHERE nature <= :nature');
    $query->execute(['nature' => $nature]);
    return count($query->fetchAll());
}

var_dump(totalSms('envoi de sms depuis le mobile'). ' sms');

/**
 * durée des appels réel
 * @return string
 */
function dureeAppelReel()
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT volumereel FROM ticketsappels WHERE jour >= 2012-02-15");
    $volumesReel = $query->fetchAll();
    $minutes = 0;
    foreach ($volumesReel as $VolumeReel) {
        list($hour, $minute) = implode(':', $VolumeReel);
        $minutes += $hour * 60;
        $minutes += $minute;
    }
    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;
    return sprintf('%02d:%02d', $hours, $minutes);
}

var_dump(dureeAppelReel() . ' heures');

/**
 * TOp 10 des facture réels
 * @return array
 */
function top10FactureReel()
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT volumefacture 
        FROM ticketsappels 
        WHERE heure 
        NOT BETWEEN '08:00:00' AND '18:00:00'
        ORDER BY volumefacture DESC
        LIMIT 10
    ");

    return $query->fetchAll();
}

var_dump(top10FactureReel());

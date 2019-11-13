<?php

require_once('DataControl.php');

$dataControl = new DataControl;

var_dump($dataControl->totalSms('envoi de sms depuis le mobile'));
var_dump($dataControl->dureeAppelReel());
var_dump($dataControl->top10FactureReel());
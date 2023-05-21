<?php
if(isset($_POST['accetta'])) {
  $ip = $_SERVER['REMOTE_ADDR'];

  // Ottieni la localizzazione dell'utente utilizzando l'API di IPStack
  $accessKey = 'cffc0a85c1ee71b95291fd45ec4fdd61'; // Sostituisci con la tua chiave di accesso IPStack
  $apiUrl = "http://api.ipstack.com/$ip?access_key=$accessKey";
  $locationData = file_get_contents($apiUrl);
  $locationData = json_decode($locationData);

  // Estrai le informazioni di localizzazione dall'API di IPStack
  $location = $locationData->country_name . ', ' . $locationData->region_name . ', ' . $locationData->city;
  $countryCode = $locationData->country_code;

  $device = $_SERVER['HTTP_USER_AGENT'];

  $logData = "IP: " . $ip . " - Location: " . $location . " - Country Code: " . $countryCode . " - Device: " . $device . "\n";

  // Scrivi i dati nel file di log
  file_put_contents("log.txt", $logData, FILE_APPEND | LOCK_EX);
}
?>

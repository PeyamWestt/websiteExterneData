<?php

// API ophalen
$apiUrl = "https://car-specs.p.rapidapi.com/v2/cars/makes";

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-RapidAPI-Key: b49cdcee78mshd9ec3af53191d2cp1de20ajsncf5666e79ea7",
    "X-RapidAPI-Host: car-specs.p.rapidapi.com"
]);

$response = curl_exec($ch);
curl_close($ch);



$data = json_decode($response, true);
echo '<pre>';
print_r($data);
echo '</pre>';
exit;

// Verbinding met database
$pdo = new PDO(
    "mysql:host=localhost;dbname=autos;charset=utf8",
    "root",
    ""
);

$sql = "INSERT INTO auto (id, automerk)
        VALUES (:id, :automerk)";

$stmt = $pdo->prepare($sql);

// Gegevens uit API opslaan
foreach ($data as $auto) {
    $stmt->execute([
        ':id' => $auto['id'],
        ':automerk' => $auto['automerk']
    ]);
}

echo "Gegevens succesvol opgeslagen.";

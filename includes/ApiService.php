<?php
// Definieer de ApiService-klasse voor API-communicatie
class ApiService
{
    // Stel de basis-URL van de API in
    private $baseUrl = "https://car-data.p.rapidapi.com";

    // Stel de URL in voor het opzoeken van modellen
    public $OpzoekUrlModels = "https://car-data.p.rapidapi.com/cars?make=";

    // Stel de API-sleutel in voor authenticatie met RapidAPI
    private $api_key = "b49cdcee78mshd9ec3af53191d2cp1de20ajsncf5666e79ea7";

    // Functie om inhoud van de API op te halen
    public function getContentFromApi($endpoint = "")
    {
        // Initialiseer een cURL-sessie
        $ch = curl_init();

        // Stel cURL-opties in voor de API-aanroep
        curl_setopt_array($ch, [
            // Stel de URL in naar het cars/makes-eindpunt
            CURLOPT_URL => $this->baseUrl . "/cars/makes",
            // Zorg ervoor dat het antwoord wordt teruggegeven in plaats van direct afgedrukt
            CURLOPT_RETURNTRANSFER => true,
            // Voeg de benodigde headers toe voor API-authenticatie
            CURLOPT_HTTPHEADER => [
                // Voeg de RapidAPI-sleutel toe aan de header
                "X-RapidAPI-Key: " . $this->api_key,
                // Voeg de RapidAPI-host toe aan de header
                "X-RapidAPI-Host: car-data.p.rapidapi.com"
            ]
        ]);

        // Voer de cURL-aanroep uit en sla het antwoord op
        $response = curl_exec($ch);

        // Sluit de cURL-sessie
        curl_close($ch);

        // Decodeer het JSON-antwoord naar een array en retourneer het (of een lege array als het mislukt)
        return json_decode($response, true) ?? [];
    }

    // Functie om auto's op merknaam op te halen
    public function getCarsByMake(string $make): array
    {
        // Bouw de URL samen met het merknaam-parameter
        $url = $this->baseUrl . "/cars?make=" . urlencode($make);

        // Initialiseer een nieuwe cURL-sessie
        $ch = curl_init();

        // Stel cURL-opties in voor de API-aanroep
        curl_setopt_array($ch, [
            // Stel de URL in naar het cars-eindpunt met de meegegeven merknaam
            CURLOPT_URL => $url,
            // Zorg ervoor dat het antwoord wordt teruggegeven
            CURLOPT_RETURNTRANSFER => true,
            // Voeg de benodigde headers toe
            CURLOPT_HTTPHEADER => [
                // Voeg de RapidAPI-sleutel toe
                "X-RapidAPI-Key: " . $this->api_key,
                // Voeg de RapidAPI-host toe
                "X-RapidAPI-Host: car-data.p.rapidapi.com"
            ]
        ]);

        // Voer de cURL-aanroep uit
        $response = curl_exec($ch);
        // Sluit de cURL-sessie
        curl_close($ch);

        // Decodeer het JSON-antwoord naar een array en retourneer het
        return json_decode($response, true) ?? [];
    }

    // Functie voor het zoeken naar auto's met een zoekopdracht
    public function search(string $query){
        // Maak een array met de zoekopdracht (opmerking: wordt niet gebruikt)
        array(
            "query" => $query
        );


        // Bouw de zoek-URL samen
        $url = $this->baseUrl . "" . $this->api_key . "&search" . $query;

        // Lees de inhoud van de URL op
        $json = file_get_contents($url);

        // Decodeer de JSON-inhoud naar een array (opmerking: dit is incompleet)
        $data=jsondecode($json, true);
    }
}

<?php

class ApiService
{
    private $baseUrl = "https://car-data.p.rapidapi.com";

    public $OpzoekUrlModels = "https://car-data.p.rapidapi.com/cars?make=";

    private $api_key = "b49cdcee78mshd9ec3af53191d2cp1de20ajsncf5666e79ea7";

    public function getContentFromApi($endpoint = "")
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $this->baseUrl . "/cars/makes",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Key: " . $this->api_key,
                "X-RapidAPI-Host: car-data.p.rapidapi.com"
            ]
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true) ?? [];
    }


    public function getCarsByMake(string $make): array
    {
        $url = $this->baseUrl . "/cars?make=" . urlencode($make);

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Key: " . $this->api_key,
                "X-RapidAPI-Host: car-data.p.rapidapi.com"
            ]
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true) ?? [];
    }

    public function search(string $query){
        array(
            "query" => $query
        );


        $url = $this->baseUrl . "" . $this->api_key . "&search" . $query;

        $json = file_get_contents($url);

        $data=jsondecode($json, true);
    }
}


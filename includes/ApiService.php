<?php

class ApiService
{
    private $baseUrl = "https://car-specs.p.rapidapi.com/v2/cars/makes";

    private $api_key = "b49cdcee78mshd9ec3af53191d2cp1de20ajsncf5666e79ea7";

    public function getContentFromApi($endpoint)
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => "https://car-specs.p.rapidapi.com/v2/cars/makes",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Key: b49cdcee78mshd9ec3af53191d2cp1de20ajsncf5666e79ea7",
                "X-RapidAPI-Host: car-specs.p.rapidapi.com"
            ]
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        return $data;
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


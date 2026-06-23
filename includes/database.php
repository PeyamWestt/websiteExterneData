<?php
// Definieer de Database-klasse voor verbindingsbeheer
class Database
{
    // Declareer een privé PDO-eigenschap voor de databaseverbinding
    private PDO $conn;

    // Constructor die de databasenaam ontvangt
    public function __construct(string $dbname)
    {
        // Stel de hostname in
        $host = "localhost";
        // Stel de database-gebruikersnaam in
        $username = "root";
        // Stel het database-wachtwoord in (leeg voor localhost)
        $password = "";

        // Try-blok om exceptions af te vangen
        try {
            // Maak een nieuwe PDO-verbinding
            $this->conn = new PDO(
                // Voeg de MySQL-verbindingsstring samen
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                // Voeg de gebruikersnaam in
                $username,
                // Voeg het wachtwoord in
                $password
            );

            // Stel de foutmodus in op Exception-werping
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Catch-blok voor PDO-uitzonderingen
        } catch (PDOException $e) {
            // Stop het script en toon een foutmelding
            die("Verbinding mislukt: " . $e->getMessage());
        }
    }

    // Functie om de databaseverbinding op te halen
    public function getConnection(): PDO
    {
        // Retourneer de privé PDO-verbinding
        return $this->conn;
    }
}
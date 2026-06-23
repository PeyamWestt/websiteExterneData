<?php
// Definieer de AutoRepository-klasse voor database-operaties
class AutoRepository
{
    // Declareer een privé PDO-eigenschap voor de database-verbinding
    private PDO $db;

    // Constructor die de database-verbinding ontvangt
    public function __construct(PDO $db)
    {
        // Slaag de database-verbinding op in de privé eigenschap
        $this->db = $db;
    }

    // Functie om een auto op ID op te halen
    public function getAutoById(int $id): array
    {
        // Schrijf een SQL-query om een auto op ID te selecteren
        $sql = "SELECT * FROM auto WHERE auto_id = :id";

        // Bereid de SQL-statement voor
        $stmt = $this->db->prepare($sql);
        // Voer de statement uit met het gegeven ID
        $stmt->execute(['id' => $id]);

        // Haal het resultaat op als een associatieve array en retourneer het
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Functie om alle auto's in transit op te halen
    public function getAutosInTransit(): array
    {
        // Schrijf een SQL-query om auto's in transit op te halen
        $sql = "
    SELECT
        merk.merk_naam,
        model.model_naam,
        type.type_naam,
        jaar.jaar_naam,
        auto.*
    FROM auto
    INNER JOIN model ON auto.model_id = model.model_id
    INNER JOIN merk ON model.merk_id = merk.merk_id
    INNER JOIN type ON auto.type_id = type.type_id
    INNER JOIN jaar ON auto.jaar_id = jaar.jaar_id
    WHERE auto.aankomst_moment IS NULL
    ORDER BY auto.bestel_moment";

        // Bereid de SQL-statement voor
        $stmt = $this->db->prepare($sql);
        // Voer de statement uit
        $stmt->execute();

        // Haal alle resultaten op als associatieve arrays en retourneer ze
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Functie om alle auto's in de showroom op te halen
    public function getAutosInShowroom(): array
    {
        // Schrijf een SQL-query om auto's in showroom op te halen
        $sql = "
    SELECT
        merk.merk_naam,
        model.model_naam,
        type.type_naam,
        jaar.jaar_naam,
        auto.*
    FROM auto
    INNER JOIN model ON auto.model_id = model.model_id
    INNER JOIN merk ON model.merk_id = merk.merk_id
    INNER JOIN type ON auto.type_id = type.type_id
    INNER JOIN jaar ON auto.jaar_id = jaar.jaar_id
    WHERE auto.aankomst_moment IS NOT NULL
    ORDER BY auto.aankomst_moment";

        // Bereid de SQL-statement voor
        $stmt = $this->db->prepare($sql);
        // Voer de statement uit
        $stmt->execute();

        // Haal alle resultaten op en retourneer ze
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Functie om de aankomst van een auto in te registreren
    public function registreerAankomst(int $id): void
    {
        // Schrijf een SQL-query om het aankomst_moment bij te werken naar nu
        $sql = "UPDATE auto
            SET aankomst_moment = NOW()
            WHERE auto_id = :id";

        // Bereid de SQL-statement voor
        $stmt = $this->db->prepare($sql);
        // Voer de statement uit met het gegeven ID
        $stmt->execute([
            'id' => $id
        ]);
    }

    // Functie om een auto te verwijderen
    public function deleteAuto(int $id): void
    {
        // Schrijf een SQL-query om een auto te verwijderen
        $sql = "DELETE FROM auto WHERE auto_id = :id";

        // Bereid de SQL-statement voor
        $stmt = $this->db->prepare($sql);

        // Voer de statement uit met het gegeven ID
        $stmt->execute([
            'id' => $id
        ]);
    }

    // Functie om een auto te bestellen
    public function orderAuto(string $merk_naam, string $model_naam, string $type_naam, string $jaar_naam, string $opmerking): void
    {
        // Schrijf een SQL-query om een database-procedure aan te roepen voor het bestellen
        $sql = "CALL bestel_auto (:merk, :model_id, :type_id, :jaar_id, :opmerking, @bestel_id)";

        // Bereid de SQL-statement voor
        $stmt = $this->db->prepare($sql);
        // Voer de statement uit met de meegegeven parameters
        $stmt->execute([
            // Voer de merknaam in
            'merk'=> $merk_naam,
            // Voer de modelnaam in
            'model_id' => $model_naam,
            // Voer het auto-type in
            'type_id' => $type_naam,
            // Voer het bouwjaar in
            'jaar_id' => $jaar_naam,
            // Voer de bestopemerking in
            'opmerking' => $opmerking
        ]);
    }
}
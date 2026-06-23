<?php
class AutoRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAutoById(int $id): array
    {
        $sql = "SELECT * FROM auto WHERE auto_id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAutosInTransit(): array
    {
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

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAutosInShowroom(): array
    {
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

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function registreerAankomst(int $id): void
    {
        $sql = "UPDATE auto
            SET aankomst_moment = NOW()
            WHERE auto_id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
    }
    public function deleteAuto(int $id): void
    {
        $sql = "DELETE FROM auto WHERE auto_id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);
    }
    public function orderAuto(string $merk_naam, string $model_naam, string $type_naam, string $jaar_naam, string $opmerking): void
    {
        $sql = "CALL bestel_auto (:merk, :model_id, :type_id, :jaar_id, :opmerking, @bestel_id)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'merk'=> $merk_naam,
            'model_id' => $model_naam,
            'type_id' => $type_naam,
            'jaar_id' => $jaar_naam,
            'opmerking' => $opmerking
        ]);
    }
}
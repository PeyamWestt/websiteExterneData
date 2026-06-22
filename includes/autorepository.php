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

    public function updateAuto(array $auto): void
    {
        $sql = "UPDATE auto
                SET auto_opmerking = :opmerking,
                    aankomst_moment = :aankomst,
                    bestel_moment = :bestel
                WHERE auto_id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $auto['auto_id'],
            'opmerking' => $auto['auto_opmerking'],
            'aankomst' => $auto['aankomst_moment'],
            'bestel' => $auto['bestel_moment']
        ]);
    }

    public function getAllAutos(): array
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
    ORDER BY auto.aankomst_moment, auto.bestel_moment";

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
}
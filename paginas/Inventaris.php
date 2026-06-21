<!doctype html>
<html lang="nl">
<head>
    <title>Invertory</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet">
    <link
        rel="stylesheet"
        href="opmaak.css">
</head>
<body>
<?php
include "../includes/database.php";
    StartConnection("auto_api");

$selectQuery = "
SELECT merk.merk_naam,model.model_naam,type.type_naam, jaar.jaar_naam
 ,auto.*
FROM auto
INNER JOIN model ON auto.model_id = model.model_id
INNER JOIN merk ON model.merk_id = merk.merk_id
INNER JOIN type ON auto.type_id = type.type_id
INNER JOIN jaar on auto.jaar_id = jaar.jaar_id
ORDER BY auto.aankomst_moment, auto.bestel_moment;";

$resultSelect = ExecuteSelectQuery($selectQuery);

foreach ($resultSelect as $row) {
    echo "<div class='card mb-3'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . htmlspecialchars($row['merk_naam']) . " " . htmlspecialchars($row['model_naam']) . "</h5>";
    echo "<p class='card-text'>Type: " . htmlspecialchars($row['type_naam']) . "</p>";
    echo "<p class='card-text'>Jaar: " . htmlspecialchars($row['jaar_naam']) . "</p>";
    echo "<p class='card-text'>Aankomst moment: " . htmlspecialchars($row['aankomst_moment']) . "</p>";
    echo "<p class='card-text'>Bestel moment: " . htmlspecialchars($row['bestel_moment']) . "</p>";
    echo "<p class='card-text'>Bestelopmerking: " . htmlspecialchars($row['auto_opmerking']) . "</p>";
    echo "</div>";
    echo "</div>";
}
?>
</body>
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous">
</script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous">
</script>
</html>
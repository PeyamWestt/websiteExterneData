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
require_once "../includes/database.php";
require_once "../includes/autorepository.php";

$database = new Database("auto_api");

$repository = new AutoRepository($database->getConnection());

if (isset($_POST['aankomst'])) {

    $repository->registreerAankomst((int)$_POST['auto_id']);

}

$autos = $repository->getAllAutos();



foreach ($autos as $row) {
    echo "<div class='card mb-3'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . htmlspecialchars($row['merk_naam']) . " " . htmlspecialchars($row['model_naam']) . "</h5>";
    echo "<p class='card-text'>Type: " . htmlspecialchars($row['type_naam']) . "</p>";
    echo "<p class='card-text'>Jaar: " . htmlspecialchars($row['jaar_naam']) . "</p>";
    echo "<p class='card-text'>Aankomst moment: " . htmlspecialchars($row['aankomst_moment']) . "</p>";
    echo "<p class='card-text'>Bestel moment: " . htmlspecialchars($row['bestel_moment']) . "</p>";
    echo "<p class='card-text'>Bestelopmerking: " . htmlspecialchars($row['auto_opmerking']) . "</p>";
    echo "<form method='post'>";

    echo "<input type='hidden' name='auto_id' value='".$row['auto_id']."'>";

    echo "<button type='submit'
              name='aankomst'
              class='btn btn-success'>
        Auto aangekomen
      </button>";

    echo "</form>";
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
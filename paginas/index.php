<?php
// Inclusief de ApiService-klasse
require_once '../includes/ApiService.php';
// Inclusief de Database-klasse
require_once '../includes/database.php';
// Inclusief de AutoRepository-klasse
require_once '../includes/autorepository.php';

// Maak een nieuw ApiService-object aan
$api = new ApiService();

// Controleer of er een GET-parameter 'make' is meegegeven
if (isset($_GET['make'])) {
    // Slaag de merknaam op
    $make = $_GET['make'];

    // Haal auto's op via de API met het gegeven merk
    $response = $api->getContentFromApi(
            'cars?make=' . urlencode($make)
    );
} else {
    // Haal standaard alle merken op via de API
    $response = $api->getContentFromApi('');
}
?>

<!doctype html>
<html lang="nl">
<head>
    <title>Home</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../paginas/index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="bestellingen.php">Bestellingen</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="showroom.php">Showroom</a>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <div class="row">
        <!-- Controleer of geen 'make' parameter is gegeven -->
        <?php if (!isset($_GET['make'])): ?>
            <!-- Loop door alle beschikbare merken -->
            <?php foreach ($response as $auto): ?>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">

                        <div class="card-body">

                            <h5 class="card-title">
                                <?= htmlspecialchars($auto) ?>
                            </h5>

                            <a href="modellen.php?make=<?= urlencode($auto) ?>" class="btn btn-primary">
                                Bekijk auto's
                            </a>

                        </div>

                    </div>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>
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
</body>
</html>
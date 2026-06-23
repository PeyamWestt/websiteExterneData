<?php

require_once '../includes/ApiService.php';
require_once '../includes/database.php';
require_once '../includes/autorepository.php';

$api = new ApiService();

$make = $_GET['make'] ?? '';

$cars = $api->getCarsByMake($make);

$repository = new AutoRepository((new Database("auto_api"))->getConnection());

if(isset($_POST['bestel'])) {
    $repository->orderAuto($_POST['merk'], $_POST['model'], $_POST['year'], $_POST['type'], $_POST['opmerking']);
}


?>

<!doctype html>
<html lang="nl">
<head>
    <title><?= htmlspecialchars($make) ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet">
</head>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../paginas/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bestellingen.php">Inventory</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<body>

<div class="container mt-4">

    <h1>Auto's van <?= htmlspecialchars($make) ?></h1>

    <a href="index.php" class="btn btn-secondary mb-3">
        Terug naar merken
    </a>

    <div class="row">

        <?php foreach ($cars as $index => $car): ?>

            <div class="col-md-4 mb-4">

                <div class="card h-100">

                    <div class="card-body">

                        <h5 class="card-title">
                            <?= htmlspecialchars($car['model'] ?? 'Onbekend model') ?>
                        </h5>

                        <p class="card-text">
                            Bouwjaar: <?= htmlspecialchars($car['year'] ?? 'Onbekend') ?><br>
                            Type auto: <?= htmlspecialchars($car['type'] ?? 'Onbekend') ?><br>
                        </p>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_<?= $index ?>">
                            Bestel deze auto
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal_<?= $index ?>" tabindex="-1" aria-labelledby="modalLabel_<?= $index ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalLabel_<?= $index ?>">Bestel auto - <?= htmlspecialchars($car['model']) ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST">
                                            <div class="mb-3">
                                                <label class="form-label">Merk</label>
                                                <input type="text" class="form-control" name="merk" value="<?= htmlspecialchars($car['make'] ?? '') ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Model</label>
                                                <input type="text" class="form-control" name="model" value="<?= htmlspecialchars($car['model'] ?? '') ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Bouwjaar</label>
                                                <input type="text" class="form-control" name="year" value="<?= htmlspecialchars($car['year'] ?? '') ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Type</label>
                                                <input type="text" class="form-control" name="type" value="<?= htmlspecialchars($car['type'] ?? '') ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Bestel opmerking</label>
                                                <input type="text" class="form-control" name="opmerking" placeholder="Voeg een opmerking toe (optioneel)">
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="bestel">Bestel deze auto</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>

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
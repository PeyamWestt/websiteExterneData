<?php

require_once '../includes/ApiService.php';

$api = new ApiService();

$make = $_GET['make'] ?? '';

$cars = $api->getCarsByMake($make);

//echo '<pre>';
//echo "Merk: " . $make . "\n\n";
//print_r($cars);
//echo '</pre>';
//exit;

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
<body>

<div class="container mt-4">

    <h1>Auto's van <?= htmlspecialchars($make) ?></h1>

    <a href="index.php" class="btn btn-secondary mb-3">
        Terug naar merken
    </a>

    <div class="row">

        <?php foreach ($cars as $car): ?>

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

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>
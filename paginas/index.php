<?php

require_once '../includes/ApiService.php';
require_once '../includes/database.php';
require_once '../includes/autorepository.php';

$database = new Database();

$api = new ApiService();

$response = $api->getContentFromApi('');

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
</head>
<body>

<div class="container mt-4">
    <div class="row">

        <?php foreach ($response as $auto): ?>

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">

                        <h5 class="card-title">
                            <?= htmlspecialchars($auto['name']) ?>
                        </h5>

                        <?php if (isset($auto['id'])): ?>
                            <p class="card-text">
                                ID: <?= htmlspecialchars($auto['id']) ?>
                            </p>
                        <?php endif; ?>

                        <a href="#" class="btn btn-primary">
                            Bekijk
                        </a>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

</body>
</html>
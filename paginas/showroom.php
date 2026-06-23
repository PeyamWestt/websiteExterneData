<!doctype html>
<html lang="nl">
<head>
    <title>Showroom</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet">
    <link
            rel="stylesheet"
            href="opmaak.css">
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
                    <a class="nav-link active" aria-current="page" href="bestellingen.php">Inventory</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<body>
<div class="container mt-4">
    <?php
    require_once "../includes/database.php";
    require_once "../includes/autorepository.php";

    $database = new Database("auto_api");

    $repository = new AutoRepository($database->getConnection());


    if (isset($_POST['delete'])) {

        $repository->deleteAuto((int)$_POST['auto_id']);

    }

    $autos = $repository->getAutosInShowroom();
    ?>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
        <tr>
            <th>Merk</th>
            <th>Model</th>
            <th>Type</th>
            <th>Jaar</th>
            <th>Aankomst Moment</th>
            <th>Bestel Moment</th>
            <th>Opmerking</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($autos as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['merk_naam']) ?></td>
                <td><?= htmlspecialchars($row['model_naam']) ?></td>
                <td><?= htmlspecialchars($row['type_naam']) ?></td>
                <td><?= htmlspecialchars($row['jaar_naam']) ?></td>
                <td><?= htmlspecialchars($row['aankomst_moment']) ?></td>
                <td><?= htmlspecialchars($row['bestel_moment']) ?></td>
                <td><?= htmlspecialchars($row['auto_opmerking']) ?></td>
                <td>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="auto_id" value="<?= $row['auto_id'] ?>">
                        <button type="submit" name="aankomst" class="btn btn-success btn-sm">
                            Aangekomen
                        </button>
                    </form>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="auto_id" value="<?= $row['auto_id'] ?>">
                        <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze auto wilt verwijderen?')">
                            Verwijderen
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
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
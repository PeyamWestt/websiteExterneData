<?php


require_once "../includes/database.php";
require_once "../includes/autorepository.php";

$database = new Database("auto_api");
$repository = new AutoRepository($database->getConnection());

$auto = $repository->getAutoById($_GET['id']);

?>

<form action="update.php" method="post">

    <input type="hidden"
           name="auto_id"
           value="<?= $auto['auto_id'] ?>">

    <label>Opmerking</label>

    <textarea
        name="auto_opmerking"
        class="form-control"><?= htmlspecialchars($auto['auto_opmerking']) ?></textarea>

    <br>

    <button class="btn btn-success">
        Opslaan
    </button>

</form>
<?php


require_once "../includes/database.php";
require_once "../includes/autorepository.php";

$database = new Database("auto_api");

$repository = new AutoRepository($database->getConnection());

$repository->updateAuto([
    'auto_id' => $_POST['auto_id'],
    'auto_opmerking' => $_POST['auto_opmerking'],
    'aankomst_moment' => null,
    'bestel_moment' => $_POST['bestel_moment'] ?? null
]);

header("Location: inventory.php");
exit;
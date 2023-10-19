<?php
// Read the plant catalog
$catalog = simplexml_load_file("catalog.xml");

// Get the plant ID from the URL parameter
$id = $_GET['id'];

// Find the plant with the specified ID
$plant = $catalog->xpath("//plant[@id='$id']")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $plant->name ?> Details</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1><?= $plant->name ?> Details</h1>

    <div class='plant'>
        <h2><?= $plant->name ?></h2>
        <p>Type: <?= $plant->type ?></p>
        <p>Light: <?= $plant->light ?></p>
        <p>Age: <?= $plant->age ?></p>
        <p>Watering: <?= $plant->watering ?></p>
    </div>
    <a href="index.php">Back to Catalog</a>
</body>
</html>


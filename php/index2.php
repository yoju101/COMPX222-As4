<?php
// Report all errors
ini_set("error_reporting",E_ALL);
?> 

<?php
// Read the notes.xml data file if it exists
if (file_exists("catalog.xml")) 
    $catalog=simplexml_load_file('catalog.xml');
else 
    exit('Failed to open catalog.xml.');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Catalog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Plant Catalog</h1>
    <form action="" method="post">
        <label for="sort">Sort by:</label>
        <select name="sort" id="sort">
            <option value="name">Name</option>
            <option value="age">Age</option>
        </select>
        <input type="submit" value="sort">
    </form>

    <form action="" method="post">
    <input type="submit" name="showAll" value="Show All">
    </form>

    <form action="" method="post">
        <label for="search">Search by title:</label>
        <input type="text" name="search" id="search" required>
        <input type="submit" value="Search">
        <?php
        // // Read the plant catalog
        // $catalog = simplexml_load_file("catalog.xml");
        echo "<ul>";
        
        echo "<ul>";
        // Print out all the titles in the catalog
        // echo "Titles in the catalogue:\n";
        // echo "<ul>";
        // $results=$catalog->xpath("//name");
        // foreach ($results as $result){
        //    // echo "  $result\n\r";
        //    echo "<li>$result</li>";
        // }
        // echo "</ul>";

            // Check if the "Show All" button was clicked
            if(isset($_POST['showAll'])) {
                // Reload the page to display all plants
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            }

        // Search functionality
        if(isset($_POST['search'])) {   
            $searchTerm = $_POST['search'];

            // Iterate through each plant and display matching results
            //echo "Read in a catalog with ".$catalog->count()." Plants.\n";
            foreach ($catalog->plant as $plant) {
                if (stripos($plant->name, $searchTerm) !== false) {
                    echo "<div class='plant'>";
                    echo "<h2><a href='display.php?id={$plant['id']}'>{$plant->name}</a></h2>";
                    echo "<p>Type: {$plant->type}</p>";
                    echo "<p>Light: {$plant->light}</p>";
                    echo "<p>Age: {$plant->age}</p>";
                    echo "<p>Watering: {$plant->watering}</p>";
                    echo "<img src='{$plant->image}' alt='{$plant->name}'>";
                    echo "</div>";
                }
            }
        } else {
            // If no search term is provided, display all plants
            foreach ($catalog->plant as $plant) {
                echo "<div class='plant'>";
                echo "<h2><a href='display.php?id={$plant['id']}'>{$plant->name}</a></h2>";
                echo "<p>Type: {$plant->type}</p>";
                echo "<p>Light: {$plant->light}</p>";
                echo "<p>Age: {$plant->age}</p>";
                echo "<p>Watering: {$plant->watering}</p>";
                // echo "</div>";
                // echo "<div class='new-plant'>";
                
                echo "<img src='{$plant->image}' alt='{$plant->name}'>";
                echo "</div>";
            }
        } ?>
    </form>
</body>
</html>


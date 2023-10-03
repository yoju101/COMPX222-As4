<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Catalog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Plant Catalog</h1>

    <form action="" method="post">
        <label for="sort">Sort by:</label>
        <select name="sort" id="sort">
            <option value="name">Name</option>
            <option value="age">Age</option>
        </select>
        <input type="submit" value="Sort">
    </form>

    <form action="" method="post">
        <label for="search">Search by title:</label>
        <input type="text" name="search" id="search" required>
        <input type="submit" value="Search">
    </form>

    <?php
        // Load and parse the XML file
        $xml = simplexml_load_file('catalog.xml');

        // Function to sort plants by name
        function sortByName($a, $b) {
            return strcmp($a->name, $b->name);
        }

        // Function to sort plants by age
        function sortByAge($a, $b) {
            return intval($a->age) - intval($b->age);
        }

        // Determine the sorting method
        if(isset($_POST['sort'])) {
            $sortMethod = $_POST['sort'];

            switch($sortMethod) {
                case 'name':
                    usort($xml->plant, 'sortByName');
                    break;
                case 'age':
                    usort($xml->plant, 'sortByAge');
                    break;
                default:
                    break;
            }
        }

        // Search functionality
        if(isset($_POST['search'])) {
            $searchTerm = $_POST['search'];

            // Iterate through each plant and display matching results
            foreach ($xml->plant as $plant) {
                if (stripos($plant->name, $searchTerm) !== false) {
                    echo "<div class='plant'>";
                    echo "<h2>{$plant->name}</h2>";
                    echo "<p>Type: {$plant->type}</p>";
                    echo "<p>Light: {$plant->light}</p>";
                    echo "<p>Age: {$plant->age}</p>";
                    echo "<p>Watering: {$plant->watering}</p>";
                    echo "</div>";
                }
            }
        } else {
            // If no search term is provided, display all plants
            foreach ($xml->plant as $plant) {
                echo "<div class='plant'>";
                echo "<h2>{$plant->name}</h2>";
                echo "<p>Type: {$plant->type}</p>";
                echo "<p>Light: {$plant->light}</p>";
                echo "<p>Age: {$plant->age}</p>";
                echo "<p>Watering: {$plant->watering}</p>";
                echo "</div>";
            }
        }
    ?>

</body>
</html>

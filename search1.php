<!DOCTYPE html>
<html>
<head>
    <title>Recipe Search</title>
    <link rel="stylesheet" type="text/css" href="./CSS/search1.css">
</head>
<body>
    
<?php

include('connection/db.php');

// Check if recipe search is performed
if(isset($_GET['recipe_name']) && !empty($_GET['recipe_name'])) {
    // Sanitize input
    $recipe_name = mysqli_real_escape_string($conn, $_GET['recipe_name']);
    
    // Fetch recipes containing the searched recipe name
    $sql_recipes = "SELECT r.recipe_name, r.ingredientlist, r.method, r.recipe_image FROM recipes r
                    WHERE r.recipe_name LIKE '%$recipe_name%'";
    $result_recipes = mysqli_query($conn, $sql_recipes);
    
    // Check if any recipes found
    if(mysqli_num_rows($result_recipes) > 0) {
        echo "<h1>Recipy For '$recipe_name':</h1>";
        while($row = mysqli_fetch_assoc($result_recipes)) {
            echo "<div class='recipe-container'>";
            echo "<h2>".$row['recipe_name']."</h2>";
            // Convert absolute file path to URL
            $image_url = str_replace('\\', '/', $row['recipe_image']); // Replace backslashes with forward slashes
            $image_url = str_replace('C:/xampp/htdocs', '', $image_url); // Remove the absolute path prefix
            echo "<img src='".$image_url."' alt='".$row['recipe_name']."' class='recipe-image'>";
            echo "<h3 class='ingredients'>Ingredients:</h3>";
            echo "<ul>";
            $ingredients = explode(", ", $row['ingredientlist']);
            foreach($ingredients as $ingredient) {
                echo "<li>".$ingredient."</li>";
            }
            echo "</ul>";
            echo "<h3 class='procedure'>Procedure:</h3>";
            echo "<ul>";
            $methods = explode("/ ", $row['method']);
            foreach($methods as $method) {
                echo "<p>".$method."</p>";
            }
            echo "</ul>";
    
        }
    } else {
        echo "<h1>No recipes found matching '$recipe_name'</h1>";
    }
}
?>
</body>
</html>

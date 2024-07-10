
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>in</title>
    <link rel="stylesheet" href="./CSS/search.css">
</head>
<body>
<?php
include('connection/db.php');

// Check if ingredient search is performed
if(isset($_GET['ingredient']) && !empty($_GET['ingredient'])) {
    // Sanitize input
    $ingredient = mysqli_real_escape_string($conn, $_GET['ingredient']);
    
    // Fetch recipes containing the searched ingredient
    $sql_recipes = "SELECT r.recipe_id, r.recipe_name, r.ingredientlist, r.method, r.recipe_image FROM recipes r
                    JOIN recipe_ingredients ri ON r.recipe_id = ri.recipe_id
                    JOIN ingredients i ON ri.ingredient_id = i.ingredient_id
                    WHERE i.ingredient_name = '$ingredient'";
    $result_recipes = mysqli_query($conn, $sql_recipes);
    
    // Check if any recipes found
    if(mysqli_num_rows($result_recipes) > 0) {
        echo "<h1>Recipes With  '$ingredient':</h1>";
        while($row = mysqli_fetch_assoc($result_recipes)) {
            echo "<div class='row'>"; // Start of row
            echo "<div class='col-md-3'>"; // Start of column
            echo "<div class='food-image'>";
            echo "<image src=\"images/food.jpg\">";
            echo "</div>";
            echo "<div class='recipe'>";
            echo "<h2>".$row['recipe_name']."</h2>";
            // Convert absolute file path to URL
            $image_url = str_replace('\\', '/', $row['recipe_image']); // Replace backslashes with forward slashes
            $image_url = str_replace('C:/xampp/htdocs', '', $image_url); // Remove the absolute path prefix
            echo "<img src='".$image_url."' alt='".$row['recipe_name']."' class='recipe-image'>";
            echo "<a href='search1.php?recipe_name=".urlencode($row['recipe_name'])."' class='view-more'>View More</a>";
            echo "</div>"; // End of recipe
            echo "</div>"; // End of column
            echo "</div>"; // End of row
        }
    } else {
        echo "<h1>No recipes found containing $ingredient</h1>";
    }
}
?>

</body>
</html>

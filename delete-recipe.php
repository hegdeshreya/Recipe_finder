<?php
include('connection/db.php');

if (isset($_GET['recipe'])) {
    $recipeID = $_GET['recipe'];

    // Prepare and execute the delete query
    $stmt_delete = $conn->prepare("DELETE FROM `tbl_recipe` WHERE `tbl_recipe_id` = ?");
    $stmt_delete->bind_param('i', $recipeID);

    if ($stmt_delete->execute()) {
        // Delete successful, now fetch the recipe image filename
        $stmt_select = $conn->prepare("SELECT `recipe_image` FROM `tbl_recipe` WHERE `tbl_recipe_id` = ?");
        $stmt_select->bind_param('i', $recipeID);
        $stmt_select->execute();
        $stmt_select->store_result();

        if ($stmt_select->num_rows > 0) {
            $stmt_select->bind_result($recipeImage);
            $stmt_select->fetch();

            // Delete the associated image file if it exists
            $imagePath = "../uploads/" . $recipeImage;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Redirect to the page where you want to display the updated recipe list
        echo "<script>
            alert('Deleted Successfully'); 
            window.location.href = 'http://localhost/DISHcover/viewrecipe.php#food';
         
            </script>";
        exit();
    } else {
        // Error handling for delete query
        echo "Error deleting recipe: " . $stmt_delete->error;
    }

    // Close prepared statements
    $stmt_delete->close();
    $stmt_select->close();
} else {
    echo "Recipe ID not provided.";
}

// Close database connection
$conn->close();
?>

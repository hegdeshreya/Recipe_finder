<?php 
include('connection/db.php'); 
 include('modal.php');
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/viewrecipe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

   
</head>
<body>

<section id="food">
        <div class="card card-food-list">
            <h1 class="text-center"><strong>Food Lists</strong></h1>
            <div class="mt-4">
                <div class="row">
                    <div class="col-md-2 mr-auto">
                        <button type="button" class="btn btn-add-food btn-secondary" data-toggle="modal" data-target="#addRecipeModal">Add Recipe</button>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control p-4" type="text" id="searchInput" placeholder="Search...">
                    </div>
                </div>
            </div>

            
            <table id="foodListTable" class="table table-responsive mt-4" style="text-align:center;">
                <thead>
                    <tr>
                    <th scope="col" style="width: 5%;">Food ID</th>
                    <th scope="col" style="width: 10%;">Recipe Image</th>
                    <th scope="col" style="width: 10%;">Recipe Name</th>
                    <th scope="col" style="width: 10%;">Category</th>
                    <th scope="col" style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                include('connection/db.php');
                
    $stmt = $conn->prepare("
        SELECT * 
        FROM 
            `tbl_recipe`
        LEFT JOIN
            `tbl_category` ON
            `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` 
    ");
    $stmt->execute();

    // Get the result set from the executed statement
    $result = $stmt->get_result();

    // Fetch all rows as an associative array
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // Loop through the rows
    foreach ($rows as $row) {
        $recipeID = $row['tbl_recipe_id'];
        $categoryID = $row['tbl_category_id'];
        $categoryName = $row['category_name'];
        $recipeImage = $row['recipe_image'];
        $recipeName = $row['recipe_name'];
        $recipeIngredients = $row['recipe_ingredients'];
        $recipeProcedure = $row['recipe_procedure'];
        // Process the data as needed
    
?>

                        <tr>
                            <th id="recipeID-<?= $recipeID ?>"><?php echo $recipeID ?></th>
                            <td id="recipeImage-<?= $recipeID ?>"><img src="http://localhost/DISHcover/uploads/<?php echo $recipeImage ?>" class="img-fluid" style="height: 50px; width: 90px" alt="Recipe Image"></td>
                            <td id="recipeName-<?= $recipeID ?>"><?php echo $recipeName ?></td>
                            <td id="categoryName-<?= $recipeID ?>"><?php echo $categoryName ?></td>
                            <td id="recipeIngredients-<?= $recipeID ?>" hidden><?php echo $recipeIngredients ?></td>
                            <td id="recipeProcedure-<?= $recipeID ?>" hidden><?php echo $recipeProcedure ?></td>
                           
                            <td>
                                 
                                <button type="button" onclick="view_recipe('<?php echo $recipeID ?>')" title="View"><i class="fa-solid fa-list p-1"></i></button> 
                                <!-- <button type="button" onclick="update_recipe('<?php echo $recipeID ?>')" title="Edit"><i class="fa-solid fa-pencil p-1"></i></button> -->
                               
                                <button type="button" onclick="delete_recipe('<?php echo $recipeID ?>')" title="Delete"><i class="fa-solid fa-trash p-1"></i></button>
                                 
                                 
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>

    </section>
    
    
  
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    

    <script>
        // switching section
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
    // Define view_recipe function
    function view_recipe(id) {
    $("#viewRecipeModal").modal("show");

    let viewRecipeName = $("#recipeName-" + id).text();
    let viewCategoryName = $("#categoryName-" + id).text();
    let viewRecipeImage = $("#recipeImage-" + id).find('img').attr('src');
    let viewRecipeIngredients = $("#recipeIngredients-" + id).text();
    let viewRecipeProcedure = $("#recipeProcedure-" + id).text();

    // Update the modal content with the fetched data
    $("#viewRecipeName").text(viewRecipeName);
    $("#viewCategoryName").text(viewCategoryName);
    $("#viewRecipeImage").attr('src', viewRecipeImage);
    $("#viewRecipeIngredients").text(viewRecipeIngredients);
    $("#viewRecipeProcedure").text(viewRecipeProcedure);
}
function delete_recipe(id) {

if (confirm("Do you confirm to delete this recipe?")) {
    window.location = "delete-recipe.php?recipe=" + id
}
}
// function delete_recipe(recipeID, uploadedBy) {
//     if (confirm("Do you confirm to delete this recipe?")) {
//         // Send an AJAX request to the PHP endpoint with recipeID and uploadedBy
//         $.ajax({
//             url: "delete-recipe.php",
//             type: "POST",
//             data: { recipeID: recipeID, uploadedBy: uploadedBy },
//             success: function(response) {
//                 // Handle success response
//                 console.log(response);
//                 // Optionally, update the UI or perform any other actions
//             },
//             error: function(xhr, status, error) {
//                 // Handle error
//                 console.error(error);
//             }
//         });
//     }
// }

// search
function performSearch() {
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("searchInput");
filter = input.value.toLowerCase();
table = document.getElementById("foodListTable");
tr = table.getElementsByTagName("tr");

for (i = 0; i < tr.length; i++) {
    var nameColumn = tr[i].getElementsByTagName("td")[1]; // Column for Recipe Name
    var categoryColumn = tr[i].getElementsByTagName("td")[2]; // Column for Category

    if (nameColumn || categoryColumn) {
        var nameText = nameColumn.textContent || nameColumn.innerText;
        var categoryText = categoryColumn.textContent || categoryColumn.innerText;

        if (nameText.toLowerCase().indexOf(filter) > -1 || categoryText.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
}

// Attach an event listener to the search input field
document.getElementById("searchInput").addEventListener("keyup", performSearch);



</script>
</body>
</html>

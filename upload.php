<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="./CSS/upload.css">
</head>
<body>

<div class="modal fade mt-5" id="addRecipeModal" tabindex="-1" aria-labelledby="addRecipe" aria-hidden="true">
<!-- <img src="images/bg4.jpg" class="d-block w-100" alt="..."> -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecipe"><strong>Add Recipe</strong></h5>
                <!-- Close button -->
            </div>
            <div class="modal-body">
                <form id="recipeID" action="endpoint/add-recipe.php" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="table" name="table" value="tbl_recipe" hidden>
                    
                    <div class="mb-3">
                        <label for="recipeImage" class="form-label">Recipe Image</label>
                        <div class="input-wrapper">
                            <input type="file" class="form-control" id="recipeImage" name="recipe_image">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="recipeName" class="form-label">Recipe Name</label>
                        <div class="input-wrapper">
                        <input type="text" class="form-control" id="recipeName" name="recipe_name">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="recipeCategory" class="form-label">Category</label>
                        <!-- PHP code for category selection -->
                        <select class="form-control" name="tbl_category_id" id="recipeCategory">
                            <option value="">- Select -</option>
                            <!-- PHP loop for options -->
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="recipeIngredients" class="form-label">Ingredients</label>
                        <div class="input-wrapper">
                        <textarea class="form-control" name="recipe_ingredients" id="recipeIngredients" rows="5"></textarea>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="recipeProcedure" class="form-label">Procedure</label>
                        <div class="input-wrapper">
                        <textarea class="form-control" name="recipe_procedure" id="recipeProcedure" rows="5"></textarea>
                    </div>
                 </div>
                    <div class="modal-footer">
                         <a href="viewrecipe.php"><button type="button" class="btn btn-secondary" data-dismiss="modal">View Recipe</button></a>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

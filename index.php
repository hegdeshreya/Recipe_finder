
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DISHcover</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Style Sheet -->
    <link rel="stylesheet" href="./CSS/styles.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Love+Light&family=Satisfy&display=swap" rel="stylesheet">
</head>

<script>
    function toggleSearch() {
        var searchByIngredient = document.getElementById("searchByIngredient");
        var searchByDish = document.getElementById("searchByDish");

        if (searchByIngredient.style.display === "none") {
            searchByIngredient.style.display = "block";
            searchByDish.style.display = "none";
        } else {
            searchByIngredient.style.display = "none";
            searchByDish.style.display = "block";
        }
    }
</script>

<body>
<section id="navbar">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#hero">DISHcover</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav"> <!-- Aligns items to the right -->
                <ul class="navbar-nav">
                <li class="nav-item">
                    <?php
                session_start();

if (isset($_SESSION['user_name'])) {
   $userName = $_SESSION['user_name'];
   echo '<li class="nav-item d-flex align-items-center">';
                        echo '<p class="nav-link nav-link123 text-center mb-0" style="font-weight: bold; color: #fff; font-size: 25px !important; margin-left: auto; margin-right: 450px;">Hi, ' . $userName . '</p>';
                        echo '</li>';

 } 
 ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#about">About</a>
                    </li>
                    <li class="nav-item"> <!-- Upload link -->
                        <a class="nav-link" href="#upload">Upload</a>
                    </li>
                    <?php
                    
                       
                    if (isset($_SESSION['user_name'])) {
                        $userName = $_SESSION['user_name'];
//                         echo '<li class="nav-item d-flex align-items-center">';
// echo '<p class="nav-link nav-link123 text-center mb-0" style="font-weight: bold; color: #fff; font-size: 18px !important; margin-left: auto; margin-right: auto;">Hi, ' . $userName . '</p>';
// echo '</li>';

                        

                        echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
                    } else {
                        // If user is not logged in, display login link
                        echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                    }
                    ?>
                   
        
                </ul>
                
            </div>
        </div>
    </nav>
</section>


    <!-- SEARCH SECTION -->
    <section id="searchSection">
        <img src="./images/foodss.jpg" alt="food">
        <div class="tagAndSearch">
            <p class="tagline">Savor the Flavor Journey</p>
            <div class="container">
                <button type="button" class="btn btn-lg searchButton" onclick="toggleSearch()">Search for Recipe</button>
                <div id="searchByIngredient" style="display: none;">
                    <!-- Ingredient search form -->
                    <form action="search.php" method="GET">
                        <label for="ingredient">Search by Ingredient:</label>
                        <input type="text" id="ingredient" name="ingredient">
                        <button type="submit">Search for Recipe</button>
                    </form>
                </div>
                <div id="searchByDish" style="display: none;">
                    <!-- Dish search form -->
                    <form action="search1.php" method="GET">
                        <label for="recipe_name">Search by Dish Name:</label>
                        <input type="text" id="recipe_name" name="recipe_name">
                        <button type="submit">Search for Recipe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    

    <!-- TESTIMONIAL SECTION -->
    <div id="testimonial" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./images/Sanjeev Kapoor.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./images/Vikas Khanna.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./images/Panjak Bhadouria.png" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- Upload Section -->
    <section id="upload">
        <img src="./images/Upload image.png" alt="pizza">
        <div class="uploadDiv">
            <p>Do you have a new recipe that you would like to share with the world?</p>
            <?php


// Check if the user is logged in
if (isset($_SESSION['user_name'])) {
    // If logged in, display the link with an onclick event handler
    echo '<a href="viewrecipe.php" class="btn btn-lg searchButton" onclick="redirectToRecipePage()">Upload and View Recipe</a>';
} else {
    // If not logged in, display the link without the onclick event handler
    echo '<a href="#" class="btn btn-lg searchButton" onclick="showSignInMessage()">Upload and View Recipe</a>';
}
?>
<script>
function redirectToRecipePage() {
    // Check if the user is logged in
    if (!<?php echo isset($_SESSION['user_name']) ? 'true' : 'false'; ?>) {
        // If not logged in, prevent the default behavior (navigation)
        event.preventDefault();
        // Display an alert message
        alert("You must be signed in to upload and view recipes.");
    }
}

function showSignInMessage() {
    // Display a popup message asking the user to sign in
    alert("You must be signed in to upload and view recipes. Please sign in to continue.");
}
</script>



        </div>
    </section>

    <!-- About Section-->
    <section id="about">
        <div class="container px-4 py-5" id="hanging-icons">
            <h2 class="pb-2 border-bottom">About DISHcover</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="col d-flex align-items-start">
                    <img src="./images/searchhh.png" alt="">
                    <div class="text">
                        <h3 class="fs-2">Advanced Search Options</h3>
                        <p>DISHcover allows users to search recipes using the name of the dish, or the ingredients
                            available. </p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <img src="./images/bulb.png" alt="">
                    <div>
                        <h3 class="fs-2">Personalised Suggestions</h3>
                        <p>Recipes that are close to the ingredients list are also recommended under suggestions
                            section.</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <img src="./images/rating.png" alt="">
                    <div>
                       
                <h3 class="fs-2">Upload and View Recipes</h3>
                <p>Users are provided with the option to upload their own recipes and view recipes uploaded by others.</p>
                </div>
            </div>
        </div>
    </section>

    <!--Footer-->
    <section id="footer">
        <div class="container">
            <footer class="py-3">
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                    <li class="nav-item"><a href="#searchSection" class="nav-link px-2">Search</a></li>
                    <li class="nav-item"><a href="#testimonial" class="nav-link px-2">Testimonial</a></li>
                    <li class="nav-item"><a href="#upload" class="nav-link px-2">Upload</a></li>
                    <li class="nav-item"><a href="#about" class="nav-link px-2">About</a></li>
                </ul>
                <p class="text-center ">@2024, DISHcover</p>
            </footer>
        </div>
    </section>

    <!--Bootstrap cdn-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- JS file link -->
    <script src="index.js"></script>
</body>



</html>
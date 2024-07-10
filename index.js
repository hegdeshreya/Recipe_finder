window.onload = function () { 
    let slides = document.getElementsByClassName('carousel-item'); 

    function addActive(slide) { 
        if (slide) { // Check if slide is defined
            slide.classList.add('active'); 
        }
    } 

    function removeActive(slide) { 
        if (slide) { // Check if slide is defined
            slide.classList.remove('active'); 
        }
    } 

    if (slides.length > 0) {
        addActive(slides[0]); 
        setInterval(function () { 
            for (let i = 0; i < slides.length; i++) { 
                if (i + 1 == slides.length) { 
                    addActive(slides[0]); 
                    setTimeout(removeActive, 350, slides[i]); 
                    break; 
                } 
                if (slides[i].classList.contains('active')) { 
                    setTimeout(removeActive, 350, slides[i]); 
                    addActive(slides[i + 1]); 
                    break; 
                } 
            } 
        }, 5500); 
    }
};
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

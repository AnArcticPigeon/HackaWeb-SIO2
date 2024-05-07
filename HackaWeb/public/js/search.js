// search bar
document.getElementById("searchInput").addEventListener("input", function(event) {
    let searchInputValue = document.getElementById("searchInput").value;

    // recupere toute les card presente dans la page
    let mesCards = document.getElementsByClassName("cardClass");

    for (let i = 0; i < mesCards.length; i++) {
    
        //recupere tout le text present dans une card
        let cardText = mesCards[i].textContent.toLowerCase();

        // test si le string chercher par l'utilisateur est prrésent dans le text present dans une card
        if (!cardText.includes(searchInputValue.toLowerCase())) {
            // si le string n'est pas present on cache la card
            mesCards[i].style.display = "none";
        } else {
            // si le string est present on affiche la card
            mesCards[i].style.display = "block";
        }
    }
})
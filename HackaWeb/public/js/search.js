        // search bar
        document.getElementById("searchInput").addEventListener("input", function(event) {
            let searchInputValue = document.getElementById("searchInput").value;

            let mesCards = document.getElementsByClassName("cardClass");

            for (let i = 0; i < mesCards.length; i++) {
            let cardText = mesCards[i].textContent.toLowerCase();

            if (!cardText.includes(searchInputValue.toLowerCase())) {

                mesCards[i].style.display = "none";
            } else {

                mesCards[i].style.display = "block";
            }
        }

        })
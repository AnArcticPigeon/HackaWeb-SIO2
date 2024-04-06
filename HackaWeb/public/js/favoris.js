/* lesLiens contient la liste des éléments <a> correspond au lien avec le
pouce, le nombre de like et le j'aime */
var lesLiens = document.getElementsByClassName('favori');
/* Les liens est une collection qu'il faut convertir en tableau pour utiliser
le forEach
/* on parcourt les éléments que l'on vient de récupérer et pour chacun d'entre
eux on écoute l'événement click et on appelle la fonction majLike lorsque
l'événement se produit */
Array.from(lesLiens).forEach((unLien) =>
unLien.addEventListener("click", majFavori)
)

function majFavori(event) {
    console.log("favLinkClicked");
    /* On annule l'action par défaut correspondant à l'événement. Normalement
    quand on clique sur un lien, cela entraîne directement une nouvelle requête
    http. Or dans notre cas, on ne veut pas que la requête s'exécute pour afficher
    une page contenant le json*/
    event.preventDefault()
    //On instancie un objet XMLHttpRequest
    let xhr = new XMLHttpRequest();
    /* on récupère l'élément a */
    let baliseA=this;
    /* On récupère l'URL du lien qui se trouve dans l'attribut href*/
    let url = baliseA.getAttribute("href");
    //On initialise notre requête avec open()
    fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
        .then (function(data){
            console.log(data);
            
            let isFavorite = data.isFavorite;
            console.log(isFavorite)

           if (isFavorite) {
     
                let svgFav = baliseA.querySelector('.js-svg-not-favori');
                let pathFav = svgFav.querySelector('.js-path-not-favori');

                svgFav.setAttribute("class", "bi bi-star-fill js-svg-favori");
                pathFav.setAttribute("class", "js-path-favori")
                pathFav.setAttribute("d", "M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z");
            } 
            else {
                let svgNotFav = baliseA.querySelector('.js-svg-favori');
                let pathNotFav = svgNotFav.querySelector('.js-path-favori');

                svgNotFav.setAttribute("class", "bi bi-star js-svg-not-favori");
                pathNotFav.setAttribute("class", "js-path-not-favori")
                pathNotFav.setAttribute("d", "M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z");
            }
            
            }
            )
            
            .catch (function(error){
                console.log(error)
                })
        
            }
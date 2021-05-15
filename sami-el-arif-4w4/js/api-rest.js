(function(){
    let bouton = document.getElementById('bout_nouvelles');
    let nouvelles = document.querySelector('.nouvelles section');
    let annonce = document.getElementById('annonce');
    window.addEventListener('load', function(){ 
    //bouton.addEventListener('mousedown', function(){ 
        monAjax(monObjJS.siteURL + '/wp-json/wp/v2/posts?categories=33&order=desc&per_page=3', nouvelles) // On l'appel une premiere fois pour la requete des nouvelles
        monAjax(monObjJS.siteURL + '/wp-json/wp/v2/posts?categories=35&order=desc&per_page=1', annonce) // On l'appel une deuxieme fois pour la requete des annonces
    });
    //window.addEventListener('load', monAjax);

    // Méthode GET pour afficher les Nouvelles et Annonces
    function monAjax(requete, elmDom){
        
        let maRequete = new XMLHttpRequest(); /// appelle la classe XMLHttpRequest. On instantie la classe
        console.log(maRequete)
        maRequete.open('GET', requete ); /// On définit la requête HTTP qui va être transmises à l'API REST de WordPress
        maRequete.open('GET', requete );
        /// Une fois que la requête est transmise, on utilise la function
        maRequete.onload = function () { 
            console.log(maRequete)
            if (maRequete.status >= 200 && maRequete.status < 400) { /// Si le statue se retrouve entre 200 et 400, la requête fonctionne et on a un résultat utilisable stockée dans response.Text
                let data = JSON.parse(maRequete.responseText);
                chaineResultat = '';
                for (const elm of data) {
                    chaineResultat += '<h2>' + elm.title.rendered + '</h2>';
                    chaineResultat += elm.content.rendered;
                }
                elmDom.innerHTML = chaineResultat; // On ecrit l'annonce en chaine de caractere
            } 
            else {
                console.log('La connexion est faite mais il y a une erreur')
            }
        } 
        maRequete.onerror = function () {
            console.log("erreur de connexion");
        }
        maRequete.send()
    }
/*--------------------------------------------------------------------------------------
   Contrôle du formulaire d'édition d'articles de catégorie "Nouvelles" 
--------------------------------------------------------------------------------------*/
let bout_ajout = document.getElementById('bout-rapide');
bout_ajout.addEventListener('mousedown', function () { /// On ajoute un écouteur, et on écoute 'mousedown' (clique de souris)
    console.log('rapide fonctionne');
    let monArticle = {
        "title" : document.querySelector('.admin-rapide [name="title"]').value,
        "content" : document.querySelector('.admin-rapide [name="content"]').value,
        "status" : "publish",
        "categories" : [35]
    }
    console.log(monArticle);
    let creerArticle = new XMLHttpRequest();
    /// Méthdode Post
    creerArticle.open("POST", monObjJS.siteURL + '/wp-json/wp/v2/posts');
    creerArticle.setRequestHeader("X-WP-Nonce", monObjJS.nonce);
    creerArticle.setRequestHeader("Content-Type", "application/json;charset=UTF-8") /// On indique à l'API que se qu'on transfère (le contenu) est du JSON
    creerArticle.send(JSON.stringify(monArticle)); /// Article (auparavant converti en JSON) sera converti en chaîne de caractères par stringify
    creerArticle.onreadystatechange = function(){
        if (creerArticle.readyState == 4){
            if (creerArticle.status == 201) {
                document.querySelector('.admin-rapide [name="title"]').value = ''
                document.querySelector('.admin-rapide [name="content"]').value = ''
            }
            else{
                alert ('erreur vous devez ressayer - status = ' + creerArticle.status)
            }
        }
    }
}); 


}())
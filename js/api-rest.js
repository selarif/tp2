(function(){
    let bouton = document.getElementById('bout_nouvelles');
    let nouvelles = document.querySelector('.nouvelles section');
    //bouton.addEventListener('mousedown', monAjax);
    window.addEventListener('load', monAjax);

    function monAjax(){
        
        let maRequete = new XMLHttpRequest(); /// appelle la classe XMLHttpRequest. On instantie la classe
        console.log(maRequete)
        maRequete.open('GET', 'http://localhost/4w4-1/wp-json/wp/v2/posts?categories=33&per_page=3'); /// On définit la requête HTTP qui va être transmises à l'API REST de WordPress
        /// Une fois que la requête est transmise, on utilise la function
        maRequete.onload = function () { 
            console.log(maRequete)
            if (maRequete.status >= 200 && maRequete.status < 400) { /// Si le statue se retrouve entre 200 et 400, la requête fonctionne et on a un résultat utilisable stockée dans response.Text
                let data = JSON.parse(maRequete.responseText);
                let chaineResultat = '';
                for (const elm of data) {
                    chaineResultat += '<h2>' + elm.title.rendered + '</h2>';
                    chaineResultat += elm.content.rendered;
                }
                nouvelles.innerHTML = chaineResultat;
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
}())
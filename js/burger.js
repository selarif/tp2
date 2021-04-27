(function(){
    /// on met un # en face du burger seulement quand c'est .querySelector et non .getElementbyId
    let bar1 = document.querySelector('#burger div:nth-of-type(1)')
    let bar2 = document.querySelector('#burger div:nth-of-type(2)')
    let bar3 = document.querySelector('#burger div:nth-of-type(3)')
    let burger = document.getElementById('burger')
    //console.log(burger.id)
    burger.addEventListener('mousedown', function(){
        console.log(burger.id)
        if (bar1.classList.contains('ouvrirX1') == false){ /// si il n'y a pas déjà l'animation d'ouverture...
            bar1.classList.remove('fermeX1')  /// Ajoute l'animation d'ouverture
            bar1.classList.add('ouvrirX1')  /// Enlève l'animation de fermeture
            bar2.classList.remove('fermeX2')   
            bar2.classList.add('ouvrirX2') 
            bar3.classList.remove('fermeX3')   
            bar3.classList.add('ouvrirX3')  
        }
        else{ /// si l'animation d'ouverture est déjà là...
            bar1.classList.remove('ouvrirX1') /// Ajoute l'animation de fermeture
            bar1.classList.add('fermeX1')  /// Enlève l'animation d'ouverture
            bar2.classList.remove('ouvrirX2') 
            bar2.classList.add('fermeX2') 
            bar3.classList.remove('ouvrirX3') 
            bar3.classList.add('fermeX3') 
        }  
    })
})()    
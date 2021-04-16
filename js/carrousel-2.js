(function(){
    let carrousel = document.querySelectorAll('.carrousel-2'); /// le querySelectorAll cree une collection de carrousels qui s'appellent Carrousel
    let ctrlCarrousel = document.querySelectorAll('.ctrl-carrousel'); /// le querySelectorAll cree une collection de boutons de carrousels
    let noCtrlCarrousel = 0;
    for (const elmCarrou of carrousel)
    { /// Permet de parcourir la collection de Carrousel. elmCarrou est UN carrousel parmis la collection. Et passera a travers toute la collection individuellement
        /// noCtrlCarrousel sert a connaitre son numero.
        let bout  = ctrlCarrousel[noCtrlCarrousel].querySelectorAll('input');
        noCtrlCarrousel = noCtrlCarrousel + 1; /// On l'incremente
        console.log(bout.length)
        
        console.log(elmCarrou.tagName)
        let noBouton = 0;
        bout[0].checked = true;
        for (const bt of bout){
            bt.value = noBouton++;
            console.log(bt.value)
            bt.addEventListener('mousedown', function(){
                elmCarrou.style.transform = "translateX(" + (-this.value*100) + "vw)"
                console.log(elmCarrou.style.transform)
            })
        }
    }
}())
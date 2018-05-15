console.log('functions.js');


//Saisie de nombre entier ou a virgule obligatoire //
function saisieNombre() {
    var saisie;
    do {
        saisie = window.prompt ("Saisissez un nombre s'il vous plait");
        
        if(saisie != null ) // Sinon nombre est transformé en NaN par parseFloat, et on reste coincé dans la boucle
            saisie = parseFloat(saisie);
    }
    while ( (isNaN(saisie)) && (saisie != null) );
    
    return saisie;
}

// Renvoie un nombre aléatoire
function nombreAleatoire(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function updateCard() {

    let carte = document.querySelector('.pile');

    carte.addEventListener( 'click', function() {

        let ancienneCarte = document.querySelector('.is-flipped');

        //Animation de la carte
        carte.classList.remove('pile');
        carte.classList.add('emplacement');
        carte.classList.add('is-flipped');

        //Mise à jour du nombre de tirages
        let tirages = document.querySelector('.tirage-t');

        let idCarte = carte.getAttribute("data");

        $.ajax({
            url: '/tirageCarte',
            type: 'POST',
            data: {idCarte: idCarte },
            success: function(response) {
                let responseArray = response.split(",");
                newCarte(responseArray);
                tirages.innerHTML = responseArray[2] + " cartes déjà piochées, saisissez la prochaine !";
            }
        });

        //Suppression de la carte sous l'emplacement si elle existe
        setTimeout(function() {
            if (ancienneCarte) {
                ancienneCarte.remove();
            }

            updateCard();
        }, 1000);

    }, { once: true });

}

//Ajout d'une nouvelle carte sur le paquet
function newCarte (responseArray) {
    let paquet = document.querySelector('.cartes');
    let elemDiv = document.createElement('div');
    elemDiv.innerHTML = "<div class=\"carte-flip carte_fond pile\" data=\"" + responseArray[0] + "\">\n" +
        "                <div class=\"card__face card__face--front\">\n" +
        "                    <div class=\"card2\">Tirer une carte\n" +
        "                    </div>\n" +
        "                </div>\n" +
        "                <div class=\"card__face card__face--back\">\n" +
        "                    <div class=\"card2\">" + responseArray[1] + "\n" +
        "                    </div>\n" +
        "                </div>\n" +
        "            </div>";
    paquet.appendChild(elemDiv);
}


//Execution
window.addEventListener('load', function () {
    updateCard();
})

let carte = document.querySelector('.pile');

carte.addEventListener( 'click', function() {
    carte.classList.remove('pile');
    carte.classList.add('emplacement');
    carte.classList.add('is-flipped');

    let tirages = document.querySelector('.tirage-t');

    let idCarte = carte.getAttribute("data");

    $.ajax({
        url: '/tirageCarte',
        type: 'POST',
        data: {idCarte: idCarte },
        success: function(response) {
            tirages.innerHTML = response + " cartes déjà piochées, saisissez la prochaine !";
        }
    });
});


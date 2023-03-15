let carte = document.querySelector('.pile');

carte.addEventListener( 'click', function() {
    carte.classList.remove('pile');
    carte.classList.add('emplacement');
    carte.classList.add('is-flipped');

    let tirages = document.querySelector('.tirage-t');

    $.ajax({
        url: '/tirageCarte',
        type: 'POST',
        success: function(response) {
            tirages.innerHTML = response + " cartes déjà piochées, saisissez la prochaine !";
        }
    });
});


var carte = document.querySelector('.carte-flip');

carte.addEventListener( 'click', function() {
    carte.classList.toggle('is-flipped');
});

var box = document.querySelector('.pile');

box.addEventListener( 'click', function() {
    box.classList.remove('pile');
    box.classList.add('emplacement');
    box.classList.add('is-flipped');
});

const birne = document.getElementById('birne');
document.getElementById("button").addEventListener("click", function() {
    if (birne.style.backgroundColor === 'yellow') {
        birne.style.backgroundColor = 'lightgray';
    }
    else {
        birne.style.backgroundColor = 'yellow';
    }
});




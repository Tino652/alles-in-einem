const body = document.getElementById('body');
const arrow = document.getElementById('arrow'); 

const arrowX = window.innerWidth / 2;
const arrowY = window.innerHeight / 2;

body.addEventListener('mousemove', function (event) {
    const mouseX = event.clientX;
    const mouseY = event.clientY;

    const deltaX = mouseX - arrowX;
    const deltaY = mouseY - arrowY;

    let angle = Math.atan2(deltaY, deltaX) * 180 / Math.PI;

    angle += 90; 

    arrow.style.transform = `rotate(${angle}deg)`;

    console.log("Winkel:", angle);
});


function centerArrow() {
    const arrowWidth = arrow.offsetWidth;
    const arrowHeight = arrow.offsetHeight;
    arrow.style.left = arrowX - arrowWidth / 2 + 'px';
    arrow.style.top = arrowY - arrowHeight / 2 + 'px';
    arrow.style.position = 'absolute'; 
}

centerArrow();
window.addEventListener('resize', centerArrow);
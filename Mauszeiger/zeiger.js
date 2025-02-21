   
    const body = document.getElementById('body');
    const arrow = document.getElementById('arrow'); 

    const arrowX = window.innerWidth / 2;
    const arrowY = window.innerHeight / 2;

body.addEventListener('mousemove', function (event) {
    console.log(event.clientX)
});



console.log('x', arrowX, 'y', arrowY);


    function myFunction (event){
        const arrow = document.getElementById('arrow');
        document.getElementById("arrow").style.transform = "rotate(" + 180 + "deg)";
    console.log(event);
    }
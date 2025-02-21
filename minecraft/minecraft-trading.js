const chest = document.getElementById("chest");
const chest2 = document.getElementById("chest2");
var emeraldsDiv = document.getElementById("emeralds");
var emeralds = parseInt(emeraldsDiv.textContent); 

document.getElementById("mc-button").addEventListener("click", function() {

    if (emeralds > 0)
    {
        if (chest2.style.display === "none") {
        chest.style.display = "block";
        chest2.style.display = "none";
        } else {
        chest.style.display = "none";
        chest2.style.display = "block";
        }
        emeralds --;
        emeraldsDiv.textContent = emeralds;
    } else {
        alert("Nicht genuegend Emeralds!")
    }
});

  document.getElementById("mc-button2").addEventListener("click", function() 
{
 


    const epearl = document.getElementById("epearl");
    const epearl2 = document.getElementById("epearl2");

    if (emeralds > 0)
        {
  
    if (epearl2.style.display === "none") {
      epearl.style.display = "block";
      epearl2.style.display = "none";
    } else {
      epearl.style.display = "none";
      epearl2.style.display = "block";
    }
    emeralds --;
    emeraldsDiv.textContent = emeralds;
}else
{
alert("Nicht genuegend Emeralds!")
}
  });

  
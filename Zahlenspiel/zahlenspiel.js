const getRandomInteger = (min, max) => {
  
    return Math.floor(Math.random() * (101 - 1)) + 1
}
const randomInteger2 = getRandomInteger(1, 101)

console.log(randomInteger2)

function myFunction ()
{


    if (Eingabefeld.value == randomInteger2) 
        {
        hinweis.textContent = "Richtig";
    } 
    else if (Eingabefeld.value < randomInteger2) 
        {
        hinweis.textContent = "Zu niedrig";
    } 
    else 
    {
        hinweis.textContent = "Zu hoch";
    }
console.log(Eingabefeld.value)
}



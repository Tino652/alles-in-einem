document.getElementById("work2").addEventListener("click", function() {
    if (document.getElementById("work").value !== "")
    {
    const li = document.createElement("li");
    li.innerHTML = document.getElementById("work").value;
   document.getElementById("ul").appendChild(li);
   document.getElementById("work").value = "";
    }
});


/*
function myFunction() {
  document.getElementById("demo").innerHTML += "Moused over!<br>";
}

function mySecondFunction(id) {
  document.getElementById("demo").innerHTML += "Clicked"+id.toString()+"<br>";
}

function myThirdFunction() {
  document.getElementById("demo").innerHTML += "Moused out!<br>";
}
*/

var elements = document.getElementsByClassName("date-outer");

function newWindow(id){
  window.location.replace(id.toString()+".hmtl");
}

for(let i = 0; i < elements.length; i++){
  let elementid = elements[i].id;
  elements[i].addEventListener("click", function(){
    newWindow(elementid);
  }, false);
}

/*
function hoveron(id) {
  document.getElementById(id).style.color = "red";
}

function hoveroff(id) {
  document.getElementById(id).style.color = "black";
}

function click(id) {
  document.getElementById(id).style.color = "blue";
}

getElementById("test1").addEventListener("mouseover", hoveron("test1"));
getElementById("test1").addEventListener("click", click("test1"));
getElementById("test1").addEventListener("mouseout", hoveroff("test1"));

/*
for(i = 0; i < elements.length; i++){
  elements[i].addEventListener("mouseover", hoveron(elements[i].id));
  elements[i].addEventListener("click", click(elements[i].id));
  elements[i].addEventListener("mouseout", hoveroff(elements[i].id));
}
*/








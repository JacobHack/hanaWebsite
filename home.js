var elements = document.getElementsByClassName("date-outer");
/*
function hoveron(id) {
  document.getElementById(id).style.color = "coral";
}

function hoveroff(id) {
  document.getElementById(id).style.color = "black";
}
*/
function newWindow(id){
  window.location.href = id.toString()+".html";
}

for(let i = 0; i < elements.length; i++){
  let elementid = elements[i].id;
  elements[i].addEventListener("click", function(){
    newWindow(elementid);
  }, false);
  /*
  elements[i].addEventListener("mouseover", function(){
    hoveron(elementid);
  }, false);
  elements[i].addEventListener("mouseout", function(){
    mouseout(elementid);
  }, false);
  */
}









//document.getElementById("1940s").style.color = "red";
/*
function colorred(id){
  document.getElementById(id).style.color = "red"
}
function colorblack(id){
  document.getElementById(id).style.color = "black"
}
*/

function newWindow(id){
  window.location.replace("/"+toString(id)+".hmtl");
}

const element = document.getElementsByClassName("title")

for(i = 0; i < element.length; i++){
  element.addEventListener("click", newWindow(element[i].id))
}







/*
const testModal = document.getElementById('testModal')

if (testModal) {
    testModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = `New message to ${recipient}`
    modalBodyInput.value = recipient
  })
}
*/
function buto() {

button = document.querySelector "button"
parent = button.parentElement

button.addEventListener "click", ->
  parent.classList.add "clicked"
  setTimeout ( -> parent.classList.add "success"), 2600
  
balapaCop "Upload Progress Interaction", "#999";
}
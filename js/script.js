const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

let currentImageIndex = 0;
const images = document.querySelectorAll('.crossfade-container img');
const totalImages = images.length;

setInterval(() => {
    images[currentImageIndex].classList.remove('visible');
    images[currentImageIndex].classList.add('hidden');
    
    currentImageIndex = (currentImageIndex + 1) % totalImages;
    
    images[currentImageIndex].classList.remove('hidden');
    images[currentImageIndex].classList.add('visible');
}, 3000); 

function changeYear(amount) {
  var yearInput = document.getElementById('tahun_terbit');
  var currentYear = parseInt(yearInput.value);
  if (!isNaN(currentYear)) {
      var newYear = currentYear + amount;
      yearInput.value = newYear;
  }
}
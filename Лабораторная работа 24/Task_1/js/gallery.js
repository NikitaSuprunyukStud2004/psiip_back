window.addEventListener('resize', updateWidth);

var carousel = document.getElementById("carousel");

{
  let i = 1;
  for (let li of carousel.querySelectorAll('li')) {
    li.style.position = 'relative';
    li.insertAdjacentHTML('beforeend', `<span style="position:absolute;left:0;top:0">${i}</span>`);
    i++;
  }
}

var width = window.innerWidth;
var count = 1;

var list = carousel.querySelector('ul');
var elementsCount = carousel.querySelectorAll('li').length;
var position = 0;

var currentIndex = 0;
var selectors = Array.from(carousel.querySelectorAll('.gallery-selector-bar img'));

carousel.querySelector('.prev').onclick = function () {
  if (currentIndex > 0) {
    currentIndex--;
    updateCarousel();
  }
};

carousel.querySelector('.next').onclick = function () {
  if (currentIndex < elementsCount - 1) {
    currentIndex++;
    updateCarousel();
  }
};

selectors.forEach((selector, idx) => {
  selector.onclick = function () {
    currentIndex = idx;
    updateCarousel();
  };
});

function updateCarousel() {
  position = -width * currentIndex;
  list.style.marginLeft = position + 'px';

  selectors.forEach((img, index) => {
    if (index === currentIndex) {
      img.classList.add('gallery-selector-bar-active-button');
      img.classList.remove('gallery-selector-bar-button');
      img.src = "./images/gallery_active_selector.png";
    } else {
      img.classList.add('gallery-selector-bar-button');
      img.classList.remove('gallery-selector-bar-active-button');
      img.src = "./images/gallery_selector.png";
    }
  });
}

function updateWidth() {
  width = window.innerWidth;
  position = -width * currentIndex;
  list.style.marginLeft = position + 'px';
}
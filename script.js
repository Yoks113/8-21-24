let numButtonClicks = 0;

function buttonClicked() {
    numButtonClicks++;
    document.getElementById("mainDiv").textContent = "Button Clicked times: " + numButtonClicks;
}

const images = [
    'image.png'
];

let currentIndex = 0;

function changeImage() {
    const slideshowImages = document.querySelectorAll('#slideshow img');

    slideshowImages[currentIndex].classList.remove('active');
    currentIndex = (currentIndex + 1) % images.length;
    slideshowImages[currentIndex].classList.add('active');
}

function preloadImages() {
    const slideshow = document.getElementById('slideshow');

    images.forEach((image, index) => {
        const imgElement = document.createElement('img');
        imgElement.src = image;
        imgElement.alt = `Slideshow image ${index + 1}`; 
        if (index === 0) imgElement.classList.add('active');
        slideshow.appendChild(imgElement);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    preloadImages();
    setInterval(changeImage, 2000);
});

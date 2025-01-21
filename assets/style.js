const eyes = document.getElementById("eyes");
const password = document.getElementById("password");
const message = document.getElementById("message");
const username = document.getElementById("username");
eyes.onclick = function () {
  if (password.type === "password") {
    password.type = "text";
    this.classList.remove("fa-eye");
    this.classList.add("fa-eye-slash");
  } else {
    password.type = "password";
    this.classList.remove("fa-eye-slash");
    this.classList.add("fa-eye");
  }
};

// -------------------------la parti img

const imageElement = document.getElementById("random-image");
const images = [
  "assets/1.gif",
  "assets/2.gif",
  "assets/10.gif",
  "assets/4.gif",
  "assets/10.gif",
  "assets/6.gif",
  "assets/7.gif",
  "assets/8.gif",
  "assets/9.gif",
  "assets/10.gif",
  "assets/11.gif",
];
function getRandomImage() {
  const randomIndex = Math.floor(Math.random() * images.length);
  const randomImage = images[randomIndex];
  imageElement.src = randomImage;
}
getRandomImage();

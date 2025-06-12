 let images = [];
let currentIndex = 0;

fetch("images.json")
  .then((res) => res.json())
  .then((data) => {
    images = data;
    showPages();
  });

function showPages() {
  const leftPage = document.getElementById("leftPage");
  const rightPage = document.getElementById("rightPage");
  const pageInfo = document.getElementById("pageInfo");

  leftPage.innerHTML = "";
  rightPage.innerHTML = "";

  if (currentIndex > 0) {
    const imgLeft = document.createElement("img");
    imgLeft.src = `uploads/${images[currentIndex - 1]}`;
    leftPage.appendChild(imgLeft);
  }

  if (images[currentIndex]) {
    const imgRight = document.createElement("img");
    imgRight.src = `uploads/${images[currentIndex]}`;
    rightPage.appendChild(imgRight);
  }

  pageInfo.innerText = `Page ${Math.floor(currentIndex / 2) + 1} of ${Math.ceil(images.length / 2)}`;
}

function prevPage() {
  if (currentIndex > 1) {
    currentIndex -= 2;
    showPages();
  }
}

function nextPage() {
  if (currentIndex < images.length - 1) {
    currentIndex += 2;
    showPages();
  }
}

document.getElementById('uploadForm').addEventListener('submit', function (e) {
  e.preventDefault();
  let formData = new FormData(this);
  fetch('upload.php', {
    method: 'POST',
    body: formData
  })
    .then(res => res.text())
    .then(data => {
      document.getElementById('uploadStatus').innerText = data;
      setTimeout(() => location.reload(), 1000);
    })
    .catch(err => console.error("Upload Error:", err));
});

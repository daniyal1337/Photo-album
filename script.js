document.getElementById('uploadForm').addEventListener('submit', function(e) {
  e.preventDefault();
  let formData = new FormData(this);
  fetch('upload.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    document.getElementById('uploadStatus').innerText = data;
    setTimeout(() => location.reload(), 1000);
  })
  .catch(err => console.error('Upload Error:', err));
});

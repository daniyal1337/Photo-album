<?php
// Show all PHP errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Safely scan the images folder
$images = is_dir('images') ? array_values(array_filter(scandir('images'), function($file) {
    return preg_match('/\.(jpg|jpeg|png)$/i', $file);
})) : [];

$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$perPage = 6;
$offset = ($page - 1) * $perPage;
$totalPages = ceil(count($images) / $perPage);
$currentImages = array_slice($images, $offset, $perPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Photo Album</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <h1>Photo Album</h1>
  <form id="uploadForm" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required />
    <button type="submit">Upload</button>
  </form>
  <div id="uploadStatus"></div>

  <div class="gallery">
    <div class="column">
      <?php foreach (array_slice($currentImages, 0, 3) as $img): ?>
        <img src="images/<?= htmlspecialchars($img) ?>" class="photo" />
      <?php endforeach; ?>
    </div>
    <div class="column">
      <?php foreach (array_slice($currentImages, 3, 3) as $img): ?>
        <img src="images/<?= htmlspecialchars($img) ?>" class="photo" />
      <?php endforeach; ?>
    </div>
  </div>

  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="?page=<?= $page - 1 ?>">Previous</a>
    <?php endif; ?>
    <?php if ($page < $totalPages): ?>
      <a href="?page=<?= $page + 1 ?>">Next</a>
    <?php endif; ?>
  </div>

  <script src="script.js"></script>
</body>
</html>

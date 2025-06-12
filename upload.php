<?php
$uploadDir = "uploads/";
$uploadedFiles = [];

if (!file_exists($uploadDir)) {
  mkdir($uploadDir);
}

if (!empty($_FILES["images"])) {
  foreach ($_FILES["images"]["tmp_name"] as $key => $tmpName) {
    $fileName = basename($_FILES["images"]["name"][$key]);
    $targetFile = $uploadDir . $fileName;
    if (move_uploaded_file($tmpName, $targetFile)) {
      $uploadedFiles[] = $fileName;
    }
  }
}

$fileList = array_diff(scandir($uploadDir), ["..", "."]);
file_put_contents("images.json", json_encode(array_values($fileList)));

echo "Upload successful!";
?>

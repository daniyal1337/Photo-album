 <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            echo "Upload successful!";
        } else {
            echo "Upload failed!";
        }
    } else {
        echo "No file uploaded or upload error!";
    }
}
?>

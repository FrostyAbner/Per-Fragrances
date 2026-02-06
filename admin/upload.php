<?php
require_once("../config/db.php");

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = intval($_POST['quantity']); // NEW: get quantity

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $uploadDir = '../uploads/';
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmp, $uploadFile)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO products (name, description, price, quantity, image, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
            $stmt->bind_param("sssds", $name, $description, $price, $quantity, $fileName);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit;
            } else {
                echo "Database error: " . $stmt->error;
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image uploaded or upload error.";
    }
}
?>

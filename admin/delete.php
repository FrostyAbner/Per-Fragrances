<?php
require_once("../config/db.php");

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Get image filename first
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row) {
        // Delete image file
        $imagePath = '../uploads/' . $row['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        // Delete from database
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}



header("Location: index.php");
exit;
?>

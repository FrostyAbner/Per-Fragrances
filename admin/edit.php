<?php
require_once("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $price = $_POST['price'];
    $quantity = intval($_POST['quantity']);

    $stmt = $conn->prepare("UPDATE products SET price = ?, quantity = ? WHERE id = ?");
    $stmt->bind_param("sii", $price, $quantity, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); // back to admin panel
        exit;
    } else {
        echo "Error updating product: " . $stmt->error;
    }
}
?>

<?php
header('Content-Type: application/json');
require_once("config/db.php");

try {
    // Count total products AND get latest timestamp
    $stmt = $conn->prepare("SELECT COUNT(*) as total, MAX(UNIX_TIMESTAMP(created_at)) as last_update FROM products");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    echo json_encode([
        'last_update' => (int)($row['last_update'] ?? time()),
        'total_products' => (int)($row['total'] ?? 0),
        'status' => 'ok'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'last_update' => time(),
        'total_products' => 0,
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
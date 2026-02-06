<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("config/db.php");

try {
    $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0):
        while($row = $result->fetch_assoc()):
            $imagePath = "uploads/" . htmlspecialchars($row['image']);
            $price = htmlspecialchars($row['price']);
            $quantity = intval($row['quantity']);

            // Add peso sign to all numbers in the price string
            $price = preg_replace('/\b(\d+)\b/', '₱ $1', $price);

            // Determine stock status
            $status = $quantity > 0 ? "In Stock" : "Out of Stock";
            $statusClass = $quantity > 0 ? "text-green-600" : "text-red-600";
?>
<div class="card opacity-0 animate-fadein border rounded-lg shadow hover:shadow-lg overflow-hidden">
    <img src="<?php echo $imagePath; ?>" 
         class="fragrance-img w-full h-64 object-cover" 
         alt="<?php echo htmlspecialchars($row['name']); ?>"
         onerror="console.error('Image failed to load:', '<?php echo $imagePath; ?>'); this.style.border='3px solid red';">
    
    <div class="p-6 text-center">
        <h4 class="serif text-2xl font-bold mb-2"><?php echo htmlspecialchars($row['name']); ?></h4>
        <p class="text-gray-600 mb-2"><?php echo htmlspecialchars($row['description']); ?></p>
        <p class="text-lg font-semibold mb-2"><?php echo $price; ?></p>
        <p class="<?php echo $statusClass; ?> font-medium">
            <?php echo $status; ?><?php echo $quantity > 0 ? " ({$quantity} pcs)" : ""; ?>
        </p>
    </div>
</div>
<?php
        endwhile;
    else:
?>
<p class="col-span-3 text-center text-gray-500">No products available yet.</p>
<?php 
    endif;
} catch (Exception $e) {
    echo '<p class="col-span-3 text-center text-red-500">Database Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>

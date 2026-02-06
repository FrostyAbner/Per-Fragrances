<?php
require_once("../config/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Per Fragrances</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            animation: fadeIn 0.2s ease;
        }
        .modal.active { display: flex; align-items: center; justify-content: center; }
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            max-width: 400px; width: 90%;
            animation: slideIn 0.3s ease;
        }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        @keyframes slideIn { from { transform: translateY(-50px); opacity:0; } to { transform: translateY(0); opacity:1; } }
    </style>
</head>

<body class="bg-gray-100 min-h-screen p-10">

<div class="max-w-5xl mx-auto">

    <h1 class="text-3xl font-bold mb-8">Admin Panel</h1>

    <!-- ADD PRODUCT FORM -->
    <div class="bg-white p-6 rounded-lg shadow mb-10">
        <h2 class="text-xl font-semibold mb-4">Add New Product</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block mb-1 font-medium">Product Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Description</label>
                <textarea name="description" class="w-full border p-2 rounded" rows="3" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Price</label>
                <input type="text" name="price" class="w-full border p-2 rounded" placeholder="₱ 1,200 - ₱ 2,500" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Quantity</label>
                <input type="number" name="quantity" class="w-full border p-2 rounded" min="0" value="1" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Product Image</label>
                <input type="file" name="image" accept="image/*" class="w-full" required>
            </div>
            <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-700">
                Upload Product
            </button>
        </form>
    </div>

    <!-- PRODUCT LIST -->
    <h2 class="text-2xl font-bold mb-4">Existing Products</h2>

    <?php
    $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()):
        $status = $row['quantity'] > 0 ? "In Stock" : "Out of Stock";
        $statusColor = $row['quantity'] > 0 ? "text-green-600" : "text-red-600";
    ?>
        <div class="bg-white p-4 mb-4 rounded-lg shadow flex justify-between items-center">

            <div class="flex items-center gap-4">
                <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>"
                     class="w-20 h-20 object-cover rounded">
                <div>
                    <h3 class="font-bold text-lg"><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p class="text-gray-600">Price: <?php echo htmlspecialchars($row['price']); ?></p>
                    <p class="text-gray-600">Quantity: <?php echo $row['quantity']; ?></p>
                    <p class="<?php echo $statusColor; ?> font-semibold"><?php echo $status; ?></p>
                </div>
            </div>

            <div class="flex gap-2">
                <button onclick="openEditModal(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['price'], ENT_QUOTES); ?>', <?php echo $row['quantity']; ?>)"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Edit
                </button>

                <button onclick="confirmDelete(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>')"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                    Delete
                </button>
            </div>
        </div>
    <?php endwhile; ?>

</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <h3 class="text-xl font-bold mb-4">Delete Product?</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to delete <strong id="productName"></strong>? This action cannot be undone.</p>
        <div class="flex gap-3">
            <button onclick="closeModal()" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition">Cancel</button>
            <button onclick="deleteProduct()" class="flex-1 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Delete</button>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3 class="text-xl font-bold mb-4">Edit Product</h3>
        <form id="editForm" method="POST" action="edit.php">
            <input type="hidden" name="id" id="editId">
            <div class="mb-4">
                <label class="block mb-1 font-medium">Price</label>
                <input type="text" name="price" id="editPrice" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Quantity</label>
                <input type="number" name="quantity" id="editQuantity" class="w-full border p-2 rounded" min="0" required>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition">Cancel</button>
                <button type="submit" class="flex-1 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
let deleteId = null;

// DELETE MODAL FUNCTIONS
function confirmDelete(id, name) {
    deleteId = id;
    document.getElementById('productName').textContent = name;
    document.getElementById('deleteModal').classList.add('active');
}

function closeModal() {
    document.getElementById('deleteModal').classList.remove('active');
    deleteId = null;
}

function deleteProduct() {
    if(deleteId){
        window.location.href = 'delete.php?id=' + deleteId;
    }
}

document.getElementById('deleteModal').addEventListener('click', function(e){
    if(e.target === this) closeModal();
});
document.addEventListener('keydown', function(e){
    if(e.key === 'Escape') closeModal();
});

// EDIT MODAL FUNCTIONS
function openEditModal(id, price, quantity){
    document.getElementById('editId').value = id;
    document.getElementById('editPrice').value = price;
    document.getElementById('editQuantity').value = quantity;
    document.getElementById('editModal').classList.add('active');
}
function closeEditModal(){
    document.getElementById('editModal').classList.remove('active');
}
document.getElementById('editModal').addEventListener('click', function(e){
    if(e.target === this) closeEditModal();
});
document.addEventListener('keydown', function(e){
    if(e.key === 'Escape') closeEditModal();
});
</script>

</body>
</html>

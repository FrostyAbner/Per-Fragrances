<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("config/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Per Fragrances</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Cormorant+Garamond:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- HEADER WITH NAVIGATION -->
<header class="bg-black text-white p-6 sticky top-0 z-50 shadow-lg">
    <div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center">
        <!-- Logo + Tagline -->
        <h1 class="text-2xl font-bold flex items-center gap-2">
            PER FRAGRANCES
            <span class="text-lg" style="font-family: 'Dancing Script', cursive; color: #d4af37; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                Your signature scent awaits
            </span>
        </h1>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav hidden md:flex gap-8">
            <a href="#home" class="nav-link text-white font-medium">Home</a>
            <a href="#collection" class="nav-link text-white font-medium">Collection</a>
            <a href="#about" class="nav-link text-white font-medium">About</a>
            <a href="https://www.facebook.com/messages/t/761473300382404" target="_blank" class="nav-link text-white font-medium">Contact</a>
        </nav>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="md:hidden text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Navigation -->
    <nav id="mobile-menu" class="mobile-menu md:hidden mt-4 space-y-3">
        <a href="#home" class="block text-white hover:text-yellow-500 font-medium">Home</a>
        <a href="#collection" class="block text-white hover:text-yellow-500 font-medium">Collection</a>
        <a href="#about" class="block text-white hover:text-yellow-500 font-medium">About</a>
        <a href="https://www.facebook.com/messages/t/YOUR_FACEBOOK_PAGE_ID" target="_blank" class="block text-white hover:text-yellow-500 font-medium">Contact</a>
    </nav>
</div>

    <!-- Mobile Navigation -->
    <nav id="mobile-menu" class="mobile-menu md:hidden mt-4 space-y-3">
        <a href="#home" class="block text-white hover:text-yellow-500 font-medium">Home</a>
        <a href="#collection" class="block text-white hover:text-yellow-500 font-medium">Collection</a>
        <a href="#about" class="block text-white hover:text-yellow-500 font-medium">About</a>
        <a href="https://www.facebook.com/messages/t/YOUR_FACEBOOK_PAGE_ID" target="_blank" class="block text-white hover:text-yellow-500 font-medium">Contact</a>
    </nav>
</div>

</header>

<!-- MAIN CONTENT -->
<main>
    <!-- HERO SECTION -->
    <section id="home" class="hero text-center py-16 bg-gradient-to-r from-gray-900 to-black text-white flex items-center justify-center">
        <div>
            <h2 class="serif text-6xl font-bold mb-4">Discover Your Signature Scent</h2>
            <p class="text-lg text-gray-300">
                Premium fragrances crafted for elegance and confidence.
            </p>
        </div>
    </section>

    <!-- PRODUCT SECTION -->
    <section id="collection" class="max-w-6xl mx-auto py-16 px-6">
        <h2 class="serif text-5xl font-bold mb-10 text-center">Our Collection</h2>
        
        <div id="product-grid" class="grid md:grid-cols-3 gap-8">
            <p class="col-span-3 text-center text-gray-500">Loading products...</p>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="bg-gray-900 text-white py-16 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="serif text-5xl font-bold mb-6">About Per Fragrances</h2>
            <p class="text-lg text-gray-300 mb-4">
                We curate premium fragrances that embody elegance, confidence, and sophistication. 
                Each scent in our collection is carefully selected to offer you a unique olfactory experience.
            </p>
            <p class="text-lg text-gray-300">
                From fresh aquatic notes to deep, mysterious blends, find the perfect fragrance that tells your story.
            </p>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="max-w-4xl mx-auto py-16 px-6 text-center">
        <h2 class="serif text-5xl font-bold mb-6">Get in Touch</h2>
        <p class="text-lg text-gray-600 mb-8">
            Have questions or want to know more about our fragrances? Message us on Facebook!
        </p>
        <a href="https://www.facebook.com/messages/t/https://www.facebook.com/messages/t/761473300382404" 
           target="_blank"
           class="inline-flex items-center gap-3 bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-blue-700 transition shadow-lg">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            Message Us on Facebook
        </a>
    </section>
</main>

<!-- FOOTER -->
<footer class="bg-black text-white text-center p-6 mt-16">
    <p class="mb-2">© <?php echo date("Y"); ?> Per Fragrances. All rights reserved.</p>
    <p class="text-sm text-gray-400">Crafted with passion for elegance</p>
</footer>

<!-- JAVASCRIPT FOR AUTO-REFRESH -->
<script>
let lastUpdateTime = 0;
let lastProductCount = 0;
let isLoading = false;

function loadProducts() {
    if (isLoading) {
        console.log('Already loading, skipping...');
        return;
    }
    
    isLoading = true;
    console.log('🔄 Loading products...');
    
    fetch('products.php?t=' + Date.now(), {
        method: 'GET',
        cache: 'no-cache'
    })
    .then(res => {
        console.log('✓ Response received:', res.status);
        return res.text();
    })
    .then(html => {
        console.log('✓ HTML received, length:', html.length);
        const grid = document.getElementById('product-grid');
        
        if (!grid) {
            console.error('❌ product-grid element not found!');
            return;
        }
        
        grid.innerHTML = html;
        console.log('✓ Products loaded into grid');
        
        // Trigger fade-in animations
        const cards = grid.querySelectorAll('.animate-fadein');
        console.log('✓ Found', cards.length, 'cards to animate');
        
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
        
        isLoading = false;
    })
    .catch(err => {
        console.error('❌ Error loading products:', err);
        document.getElementById('product-grid').innerHTML = 
            '<p class="col-span-3 text-center text-red-500">Error loading products. Check console.</p>';
        isLoading = false;
    });
}

function checkForUpdates() {
    console.log('🔍 Checking for updates...');
    
    fetch('check_updates.php?t=' + Date.now(), {
        method: 'GET',
        cache: 'no-cache'
    })
    .then(res => res.json())
    .then(data => {
        console.log('📊 Update check result:', data);
        
        // Check if timestamp changed OR product count changed
        if (data.last_update > lastUpdateTime || data.total_products !== lastProductCount) {
            console.log('🆕 Changes detected!');
            console.log('   Old timestamp:', lastUpdateTime, '→ New:', data.last_update);
            console.log('   Old count:', lastProductCount, '→ New:', data.total_products);
            
            lastUpdateTime = data.last_update;
            lastProductCount = data.total_products;
            loadProducts();
        } else {
            console.log('✓ No updates');
        }
    })
    .catch(err => {
        console.error('❌ Error checking updates:', err);
    });
}

// Mobile menu toggle
document.getElementById('mobile-menu-btn').addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.toggle('active');
});

// Close mobile menu when clicking a link
document.querySelectorAll('#mobile-menu a').forEach(link => {
    link.addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.remove('active');
    });
});

// Wait for page to fully load
window.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Page loaded, starting product loader...');
    
    // Initial load
    loadProducts();
    
    // Check for updates every 2 seconds
    setInterval(checkForUpdates, 2000);
    console.log('⏰ Auto-refresh enabled (every 2 seconds)');
});
</script>

</body>
</html>
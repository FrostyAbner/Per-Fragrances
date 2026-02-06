// =====================
// PRODUCT SYSTEM
// =====================

const defaultProducts = [
  {
    id: 1,
    name: "Odyssey Homme",
    description: "A masculine journey through aromatic woods and spices.",
    image: "https://images.unsplash.com/photo-1541643600914-78b084683601?w=500",
    price: "₱ 1,200 - ₱ 2,500"
  },
  {
    id: 2,
    name: "Acqua Di Gio",
    description: "Fresh aquatic essence inspired by the Mediterranean.",
    image: "https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=500",
    price: "₱ 1,500 - ₱ 3,000"
  }
];

let products = JSON.parse(localStorage.getItem("products")) || defaultProducts;

function saveProducts() {
  localStorage.setItem("products", JSON.stringify(products));
}

function renderProducts() {
  const container = document.getElementById("productContainer");
  if (!container) return;

  container.innerHTML = "";

  products.forEach(product => {
    container.innerHTML += `
      <div class="card">
        <img src="${product.image}" class="fragrance-img">
        <div class="p-6 text-center">
          <h4 class="serif text-2xl font-bold mb-2">${product.name}</h4>
          <p class="text-gray-600 mb-4">${product.description}</p>
          <span class="price-tag">${product.price}</span>
        </div>
      </div>
    `;
  });
}

renderProducts();

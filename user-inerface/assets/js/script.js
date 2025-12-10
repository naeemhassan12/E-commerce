// Unified product array
  const products = [
    {id:1, name:'Black Shirt', price:50, img:'assets/image/black.jpg', desc:'Stylish black shirt for men'},
    {id:2, name:'Laptop', price:60, img:'assets/image/top-view.jpg', desc:'Elegant white shirt for all occasions'},
    {id:3, name:'MakeUp Store', price:80, img:'assets/image/women-s-day.jpg', desc:'Comfortable blue jeans'},
    {id:4, name:'Red Shoes', price:100, img:'assets/image/antonio.jpg', desc:'Trendy red shoes for casual wear'}
  ];

  let cart = [];
  let currentProduct = null;

  // Scroll to section
  function scrollToSection(id){
    document.getElementById(id).scrollIntoView({behavior:'smooth'});
  }

  // Render products
  function renderProducts(){
    const list = document.getElementById('product-list');
    list.innerHTML = '';
    products.forEach(p => {
      list.innerHTML += `
        <div class="col-md-3 mb-4">
          <div class="card">
            <img src="${p.img}" class="card-img-top" alt="${p.name}">
            <div class="card-body">
              <h5 class="card-title">${p.name}</h5>
              <p class="card-text">$${p.price}</p>
              <button class="btn btn-primary" onclick="viewProductModal(${p.id})" data-bs-toggle="modal" data-bs-target="#productModal">View Details</button>
            </div>
          </div>
        </div>`;
    });
  }

  // View product in modal
  function viewProductModal(id){
    currentProduct = products.find(p => p.id === id);
    document.getElementById('productModalLabel').innerText = currentProduct.name;
    document.getElementById('modal-img').src = currentProduct.img;
    document.getElementById('modal-price').innerText = `$${currentProduct.price}`;
    document.getElementById('modal-desc').innerText = currentProduct.desc;
  }

  // Add to cart from modal
  function addToCartFromModal(){
    cart.push(currentProduct);
    alert('Product added to cart!');
    const modal = bootstrap.Modal.getInstance(document.getElementById('productModal'));
    modal.hide();
    renderCart();
  }

  // Render cart
  function renderCart(){
    const container = document.getElementById('cart-items');
    container.innerHTML = '';
    if(cart.length === 0){
      container.innerHTML = '<p>Your cart is empty</p>';
    } else {
      cart.forEach((p,i) => {
        container.innerHTML += `
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span>${p.name} - $${p.price}</span>
            <button class="btn btn-sm btn-danger" onclick="removeFromCart(${i})">Remove</button>
          </div>`;
      });
    }
  }

  function removeFromCart(index){
    cart.splice(index,1);
    renderCart();
  }

  // Payment form submission
  document.getElementById('payment-form').addEventListener('submit', function(e){
    e.preventDefault();
    alert('Payment Successful!');
    cart = [];
    renderCart();
    const modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
    modal.hide();
  });

  // Initialize
  document.addEventListener('DOMContentLoaded', renderProducts);

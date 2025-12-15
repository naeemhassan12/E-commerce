

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome 2026 Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    :root {
      --card-shadow: 0 4px 14px rgba(0,0,0,.06);
      --radius-xl: 18px;
      --radius-lg: 14px;
      --radius-md: 10px;
      --muted: #6f7785;
    }

    body {
      background: #f4f6fa;
      font-family: "Inter", sans-serif;
    }

    .section-title {
      font-weight: 700;
      color: #1e1f24;
    }

    .card-ui {
      border: 0;
      background: #fff;
      border-radius: var(--radius-xl);
      box-shadow: var(--card-shadow);
      padding: 22px;
    }

    .prod-img {
      width: 76px;
      height: 76px;
      border-radius: var(--radius-md);
      object-fit: cover;
    }

    .product-name {
      font-weight: 600;
      font-size: 15px;
    }

    .muted {
      color: var(--muted);
      font-size: 13px;
    }

    .badge-counter {
      font-size: 11px;
      padding: 6px 9px;
      border-radius: 8px;
    }

    .btn-icon {
      width: 40px;
      height: 40px;
      border-radius: var(--radius-md);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0;
    }

    .price-text {
      font-weight: 700;
      font-size: 17px;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="mb-5 text-center">
    <!-- <h2 class="section-title">Professional Multi-Cart System</h2>
    <p class="muted">Modern UI • Smooth UX • Multi-Cart Workflow • Standard Layout</p> -->
  </div>

  <div class="row g-4">

    <!-- Product Section -->
    <div class="col-lg-5">
      <div class="card-ui">
        <h5 class="mb-3 fw-bold">Products</h5>
        <div id="productList"></div>
      </div>
    </div>

    <!-- CART SYSTEM GRID -->
    <div class="col-lg-7">
      <div class="row g-4">

        <div class="col-md-6">
          <div class="card-ui h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <h6 class="fw-bold mb-0">Active Cart</h6>
              <span id="countActive" class="badge bg-primary badge-counter">0</span>
            </div>
            <div id="activeCart"></div>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
              <span class="price-text">Total: <span id="activeTotal">$0.00</span></span>
              <button class="btn btn-success btn-sm" id="activeCheckout">Checkout</button>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card-ui h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <h6 class="fw-bold mb-0">Saved for Later</h6>
              <span id="countSaved" class="badge bg-secondary badge-counter">0</span>
            </div>
            <div id="savedCart"></div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card-ui h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <h6 class="fw-bold mb-0">Wishlist</h6>
              <span id="countWish" class="badge bg-warning text-dark badge-counter">0</span>
            </div>
            <div id="wishCart"></div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card-ui h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <h6 class="fw-bold mb-0">Compare</h6>
              <span id="countCompare" class="badge bg-info text-dark badge-counter">0</span>
            </div>
            <div id="compareCart"></div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Payment Method</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="checkoutSummary" class="muted"></p>
        <button class="btn btn-primary w-100 mb-2" id="payPaypal"><i class="fa-brands fa-paypal me-2"></i>PayPal</button>
        <button class="btn btn-success w-100" id="payEasypaisa"><i class="fa-solid fa-mobile me-2"></i>EasyPaisa</button>
      </div>
    </div>
  </div>
</div>

<!-- Payment Detail Modal -->
<div class="modal fade" id="paymentDetailModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="paymentTitle" class="modal-title"></h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="paymentBody"></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ==========  CLEAN STRUCTURE JAVASCRIPT ==========
// State Structure
const StorageKey = "CartSystem2026";
const DefaultState = {
  products: [
    {id:1, name:"Premium Hoodie", price: 49.99, img:"https://picsum.photos/seed/h1/200"},
    {id:2, name:"Running Shoes", price: 89.00, img:"https://picsum.photos/seed/h2/200"},
    {id:3, name:"Smart Watch", price: 120.50, img:"https://picsum.photos/seed/h3/200"},
    {id:4, name:"Backpack", price: 35.20, img:"https://picsum.photos/seed/h4/200"}
  ],
  active: [],
  saved: [],
  wish: [],
  compare: []
};

function loadState() {
  return JSON.parse(localStorage.getItem(StorageKey)) || structuredClone(DefaultState);
}
function saveState() {
  localStorage.setItem(StorageKey, JSON.stringify(state));
}

let state = loadState();

// Render Products
function renderProducts() {
  const wrap = document.getElementById("productList");
  wrap.innerHTML = "";

  state.products.forEach(p => {
    const div = document.createElement("div");
    div.className = "d-flex align-items-center mb-3 p-2 rounded";
    div.style.background = "#fafbff";

    div.innerHTML = `
      <img src="${p.img}" class="prod-img me-3">
      <div class="flex-grow-1">
        <div class="product-name">${p.name}</div>
        <div class="muted">$${p.price.toFixed(2)}</div>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary btn-icon" data-act="add" data-id="${p.id}"><i class="fa fa-cart-plus"></i></button>
        <button class="btn btn-outline-secondary btn-icon" data-act="save" data-id="${p.id}"><i class="fa fa-bookmark"></i></button>
        <button class="btn btn-outline-warning btn-icon" data-act="wish" data-id="${p.id}"><i class="fa fa-heart"></i></button>
        <button class="btn btn-outline-info btn-icon" data-act="compare" data-id="${p.id}"><i class="fa fa-scale-balanced"></i></button>
      </div>
    `;

    wrap.appendChild(div);
  });
}

// Render Generic Cart
function renderCart(list, containerId) {
  const box = document.getElementById(containerId);
  box.innerHTML = "";

  if (list.length === 0) {
    box.innerHTML = '<div class="muted">No items</div>';
    return;
  }

  list.forEach(item => {
    const p = state.products.find(x => x.id === item.id);
    const div = document.createElement("div");
    div.className = "d-flex mb-3 align-items-center";

    div.innerHTML = `
      <img src="${p.img}" class="prod-img me-3">
      <div class="flex-grow-1">
        <div class="product-name">${p.name}</div>
        <div class="muted">$${p.price} × ${item.qty}</div>
      </div>
      <button class="btn btn-danger btn-sm" data-act="remove" data-id="${p.id}" data-list="${containerId}"><i class="fa fa-trash"></i></button>
    `;

    box.appendChild(div);
  });
}

// Refresh All UI
function refresh() {
  renderProducts();
  renderCart(state.active, "activeCart");
  renderCart(state.saved, "savedCart");
  renderCart(state.wish, "wishCart");
  renderCart(state.compare, "compareCart");

  document.getElementById("countActive").textContent = state.active.length;
  document.getElementById("countSaved").textContent = state.saved.length;
  document.getElementById("countWish").textContent = state.wish.length;
  document.getElementById("countCompare").textContent = state.compare.length;

  const total = state.active.reduce((t,i)=>{
    const p = state.products.find(x=>x.id===i.id);
    return t + p.price * i.qty;
  },0);
  document.getElementById("activeTotal").textContent = "$" + total.toFixed(2);

  saveState();
}

// Product Buttons
document.getElementById("productList").onclick = e => {
  const b = e.target.closest("button");
  if (!b) return;

  const id = Number(b.dataset.id);
  const act = b.dataset.act;

  if (act === "add") {
    const ex = state.active.find(x=>x.id===id);
    ex ? ex.qty++ : state.active.push({id, qty:1});
  }
  if (act === "save") state.saved.push({id, qty:1});
  if (act === "wish") state.wish.push({id, qty:1});
  if (act === "compare") state.compare.push({id, qty:1});

  refresh();
};

// Remove Buttons from carts
["activeCart","savedCart","wishCart","compareCart"].forEach(cid => {
  document.getElementById(cid).onclick = e => {
    const b = e.target.closest("button");
    if (!b) return;

    if (b.dataset.act === "remove") {
      const id = Number(b.dataset.id);
      state[cid.replace("Cart","")].splice(
        state[cid.replace("Cart","")].findIndex(x=>x.id===id), 1
      );
      refresh();
    }
  };
});

document.getElementById("activeCheckout").onclick = () => {
  const total = document.getElementById("activeTotal").textContent;
  document.getElementById("checkoutSummary").textContent = `Your total is ${total}`;
  new bootstrap.Modal(document.getElementById("checkoutModal")).show();
};

document.getElementById("payPaypal").onclick = () => {
  document.getElementById("paymentTitle").textContent = "PayPal Payment";
  document.getElementById("paymentBody").innerHTML = "Open PayPal in new tab (demo).";
  new bootstrap.Modal(document.getElementById("paymentDetailModal")).show();
};

document.getElementById("payEasypaisa").onclick = () => {
  document.getElementById("paymentTitle").textContent = "EasyPaisa Payment";
  document.getElementById("paymentBody").innerHTML = "Send payment to 0300-1234567 (demo).";
  new bootstrap.Modal(document.getElementById("paymentDetailModal")).show();
};

refresh();
</script>
</body>
</html>
<h1>Hello disccount!</h1>
<style>
        .discount {
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            position: absolute;
            top: 10px;
            right: 10px;
            font-weight: bold;
        }

        .applied {
            background-color: #6c757d;
            cursor: default;
        }

        .applied:hover {
            background-color: #6c757d;
        }

        .item {
            position: relative;
        }

        .item img {
            max-height: 200px; /* Adjust as needed */
            object-fit: cover; /* Prevents image distortion */
            width: 100%;
            border-bottom: 1px solid #eee;
        }

        .category {
            font-size: 0.8em;
            color: #777;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Available Items with Discounts</h1>
        <div class="row" id="items-container">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const items = [
            { id: 1, name: "Product A", price: 50, discount: 10, category: "Electronics", image: "profiles/1742896531_Viso Powder small.png" },
            { id: 2, name: "Product B", price: 100, discount: 20, category: "Clothing", image: "" },
            { id: 3, name: "Product C", price: 30, discount: 10, category: "Books", image: "https://via.placeholder.com/200x150?text=Product+C" },
            { id: 4, name: "Product D", price: 75, discount: 15, category: "Home Goods", image: "https://via.placeholder.com/200x150?text=Product+D" },
            { id: 5, name: "Product E", price: 120, discount: 25, category: "Electronics", image: "https://via.placeholder.com/200x150?text=Product+E" },
            { id: 6, name: "Product F", price: 40, discount: 5, category: "Toys", image: "https://via.placeholder.com/200x150?text=Product+F" },
        ];

        const itemsContainer = document.getElementById("items-container");

        items.forEach(item => {
            const itemDiv = document.createElement("div");
            itemDiv.classList.add("col-md-4", "mb-4", "item");
            itemDiv.innerHTML = `
                <div class="card h-100">
                    <img src="${item.image}" class="card-img-top" alt="${item.name}">
                    <div class="card-body">
                        <p class="category">${item.category}</p>
                        <h5 class="card-title">${item.name}</h5>
                        <p class="card-text">Price: $${item.price}</p>
                        ${item.discount > 0 ? `<div class="discount">${item.discount}% Off</div>` : ''}
                        ${item.discount > 0 ? `<button class="btn btn-primary apply-button w-100" data-item-id="${item.id}">Apply Discount</button>` : ''}
                    </div>
                </div>
            `;
            itemsContainer.appendChild(itemDiv);
        });

        itemsContainer.addEventListener("click", function(event) {
            if (event.target.classList.contains("apply-button")) {
                const itemId = parseInt(event.target.dataset.itemId);
                const clickedItem = items.find(item => item.id === itemId);

                if (clickedItem && clickedItem.discount > 0) {
                    const button = event.target;
                    button.classList.add("applied");
                    button.disabled = true;
                    button.textContent = "Applied";
                    alert(`Discount of ${clickedItem.discount}% applied to ${clickedItem.name}!`);
                }
            }
        });
    </script>
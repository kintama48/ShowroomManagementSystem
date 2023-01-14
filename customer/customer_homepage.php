<!-- customer.php -->
<html lang="en">
<head>
    <title>Customer Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../stylesheets/customer_homepage.css">
</head><!-- customer.php -->
<body>
<div id="table-div" class="container">
    <h1>Customer Page</h1>
    <h2>Vehicles</h2>
    <table class="styled-table">
        <tr>
            <thead>
            <th>ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            </thead>
        </tr>
        <tbody>
        <?php
        // Include the code to retrieve the list of vehicles from the database
        include './get_vehicles.php';

        // Iterate through the list of vehicles and display them in a table
        foreach ($vehicles as $vehicle) {
            echo "<tr>";
            echo "<td>" . $vehicle['id'] . "</td>";
            echo "<td>" . $vehicle['make'] . "</td>";
            echo "<td>" . $vehicle['model'] . "</td>";
            echo "<td>" . $vehicle['year'] . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>

    </table>

    <h2>Parts</h2>
    <table class="styled-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
<?php
// Include the code to retrieve the list of parts from the database
include 'get_parts.php';

// Iterate through the list of parts and display them in a table
foreach ($parts as $part) {
    echo "<tr>";
    echo "<td>" . $part['id'] . "</td>";
    echo "<td>" . $part['name'] . "</td>";
    echo "<td>" . $part['description'] . "</
</td>";
    echo "<td>" . $part['price'] . "</td>";
    echo "<td><button class='add-to-cart-btn' data-part-id='" . $part['id'] . "' data-part-name='" . $part['name'] . "' data-part-price='" . $part['price'] . "'>Add to Cart</button></td>";
    echo "</tr>";
}
?>
        </tbody>

    </table>
    <div id="shopping-cart">
        <h2>Shopping Cart</h2>
        <table class="styled-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody id="cart-items">

            </tbody>
        </table>
        <h4 id="cart-total">Total: $0</h4>
        <button id="place-order-btn">Place Order</button>
    </div>
</div>

<script>
    // Add event listener to the "Add to Cart" buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', event => {
            // Get the part information
            const item = event.target.parentElement.parentElement;
            const name = item.querySelector('.part-name').innerText;
            const price = item.querySelector('.part-price').innerText;

            // Add the part to the cart
            addToCart(name, price);

            // Update the cart total
            updateCartTotal();
        });
    });

    // Add the part to the cart
    function addToCart(name, price) {
        // Check if the cart already has an item with the same name
        const existingItem = document.querySelector(`.cart-item[data-name='${name}']`);
        if (existingItem) {
            // If it does, increase the quantity of that item
            const quantity = existingItem.querySelector('.cart-item-quantity');
            quantity.innerText = parseInt(quantity.innerText) + 1;
        } else {
            // If it doesn't, create a new item in the cart
            const cartRow = document.createElement('div');
            cartRow.classList.add('cart-row');
            cartRow.innerHTML = `
            <div class="cart-item" data-name="${name}">
                <span class="cart-item-name">${name}</span>
                <span class="cart-item-price">${price}</</span>
                <input type="number" class="cart-item-quantity" value="1">
                <button class="btn btn-danger" type="button">Remove</button>
            </div>
        `;
            cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem);
            cartRow.getElementsByClassName('cart-item-quantity')[0].addEventListener('change', quantityChanged);
            cart.append(cartRow);
            updateCartTotal();
        }
        function removeCartItem(event) {
            const buttonClicked = event.target;
            buttonClicked.parentElement.remove();
            updateCartTotal();
        }
        function quantityChanged(event) {
            const input = event.target;
            if (isNaN(input.value) || input.value <= 0) {
                input.value = 1;
            }
            updateCartTotal();
        }
        function updateCartTotal() {
            const cartItemContainer = document.getElementsByClassName('cart-items')[0];
            const cartRows = cartItemContainer.getElementsByClassName('cart-row');
            let total = 0;
            Array.from(cartRows).forEach(function(cartRow) {
                const price = cartRow.getElementsByClassName('cart-item-price')[0].innerText;
                const quantity = cartRow.getElementsByClassName('cart-item-quantity')[0].value;
                total += price * quantity;
            });
            document.getElementsByClassName('cart-total-price')[0].innerText = `Total: $${total}`;
        }
        // Event Listeners
        addToCartButtons.forEach(function(addToCartButton) {
            addToCartButton.addEventListener('click', addToCartClicked);
        });
    }
    updateCartTotal();

    function addToCartClicked(event) {
        const button = event.target;
        const shopItem = button.parentElement.parentElement;
        const name = shopItem.getElementsByClassName('vehicle-name')[0].innerText;
        const price = shopItem.getElementsByClassName('vehicle-price')[0].innerText;
        const imageSrc = shopItem.getElementsByClassName('vehicle-img')[0].src;

        addItemToCart(name, price, imageSrc);
        updateCartTotal();
    }

    function addItemToCart(name, price, imageSrc) {
        const cartRow = document.createElement('div');
        cartRow.classList.add('cart-row');
        cartRow.innerHTML = `<div class="cart-item cart-column"> <img class="cart-item-image" src="${imageSrc}" width="100" height="100"> <span class="cart-item-title">${name}</span> </div> <span class="cart-price cart-column">${price}</span> <div class="cart-quantity cart-column"> <input class="cart-quantity-input" type="number" value="1"> <button class="btn btn-danger" type="button">REMOVE</button> </div>;`
    cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem);
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged);
    document.getElementsByClassName('cart-items')[0].append(cartRow);
    }

    function updateCartTotal() {
        const cartItemContainer = document.getElementsByClassName('cart-items')[0];
        const cartRows = cartItemContainer.getElementsByClassName('cart-row');
        let total = 0;
        for (let i = 0; i < cartRows.length; i++) {
            const cartRow = cartRows[i];
            const priceElement = cartRow.getElementsByClassName('cart-item-price')[0];
            const quantityElement = cartRow.getElementsByClassName('cart-item-quantity')[0];
            const price = parseFloat(priceElement.innerText.replace('$', ''));
            const quantity = quantityElement.value;
            total = total + (price * quantity);
        }
        total = Math.round(total * 100) / 100;
        document.getElementsByClassName('cart-total-price')[0].innerText = '$' + total;
    }
</script>
</body>
</html>



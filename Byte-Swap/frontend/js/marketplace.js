document.getElementById('listProductForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch('../../backend/users/marketplace.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Product listed successfully.');
            loadProducts();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});

function loadProducts() {
    fetch('../../backend/users/marketplace.php')
    .then(response => response.json())
    .then(products => {
        let productsContainer = document.getElementById('productsContainer');
        productsContainer.innerHTML = '';
        products.forEach(product => {
            productsContainer.innerHTML += `
                <div class="product-item">
                    <img src="${product.product_image}" alt="${product.product_name}">
                    <h3>${product.product_name}</h3>
                    <p>${product.product_description}</p>
                    <p>Value: ${product.product_value} Byte Points</p>
                    <p>Condition: ${product.product_condition}</p>
                </div>
            `;
        });
    })
    .catch(error => console.error('Error:', error));
}

window.onload = function() {
    loadProducts();
}
3. Database Table
Make sure your database has a table to store the products, like this:

sql
Copy code
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    productName VARCHAR(255) NOT NULL,
    productDescription TEXT NOT NULL,
    productValue INT NOT NULL,
    productCondition ENUM('Fresh', 'Good', 'Fair') NOT NULL,
    productImage VARCHAR(255),
);
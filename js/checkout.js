 
/*import {products} from '../js/products.js';

let cartSummaryHTML = '';
  

cart.forEach((cartItem) =>{
    const productId = cartItem.productId;
   
    let matchingProduct;

    products.forEach((product) =>{
        if(product.id === productId){
            matchingProduct = product;
        }
    });
cartSummaryHTML += ` 
     <div class="cartsub">
            <span class="js-cart-item-container-645834">
    <div class="cartitem">
        <img src="img/pngwing.com (11).png" alt="" class="cartimg" id="cartimg1">
        <div class="desc">
        <p id="cartdescription">Device</p>
        <p class="items-present">9</p>
        <h3 class="cart-price">30000</h3>
        <input type="number" value="2" class="cart-quantity-input">
        </div>
    </div>
    <div class="reducecart">
        <span class="rem" data-product-id="${matchingProduct.id}">Remove</span>
        <span class="outstock">OUT OF STOCK</span>
    </div>
</span>
    </div>`;
});
console.log(cartSummaryHTML);
document.querySelector('.js-order-summary').innerHTML = cartSummaryHTML;
document.querySelectorAll('.rem').forEach((link)=> {
    link.addEventListener('click', () =>{
        
        const productId = link.dataset.productId;
        removeFromCart(productId);

         document.querySelector(`.js-cart-item-container-${productid}`);

         CSSContainerRule.remove();
    });
    
});

console.log(cart);
console.log(removeFromCart);
console.log(products);
console.log(cartSummaryHTML);
console.log(matchingProduct);
console.log(productId);*/

// Function to handle adding items to cart
function addToCart(productName, productPrice) {
    // Get cart object from localStorage or initialize empty
    let cart = JSON.parse(localStorage.getItem('cart') || '{}');
    
    // Update quantity and total price for product
    if (cart[productName]) {
        cart[productName].quantity += 1;
        cart[productName].totalPrice += productPrice;
    } else {
        cart[productName] = {
            quantity: 1,
            totalPrice: productPrice
        };
    }
    
    // Save updated cart to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Update UI to reflect changes
    updateCartDisplay();
}

// Function to update cart display
function updateCartDisplay() {
    const cartList = document.getElementById('cart');
    const cart = JSON.parse(localStorage.getItem('cart') || '{}');
    
    // Clear current cart display
    cartList.innerHTML = '';
    
    // Add each item to cart display
    for (let product in cart) {
        const item = cart[product];
        const listItem = document.createElement('li');
        listItem.innerHTML = `
            ${product} - Quantity: ${item.quantity} - Total: $${item.totalPrice.toFixed(2)}
            <button onclick="removeFromCart('${product}')">Remove</button>
        `;
        cartList.appendChild(listItem);
    }
}

// Function to remove items from cart
function removeFromCart(productName) {
    const cart = JSON.parse(localStorage.getItem('cart') || '{}');
    delete cart[productName];
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
}


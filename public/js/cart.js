

let shoppingForm = document.querySelector('.submit-form-checkout')
let checkoutButton = document.querySelector('.checkout-btn')
let addToCartButtons = document.getElementsByClassName('cart-btn')
let allQuantityInputFields = document.getElementsByClassName('input-quantity')
let addCartModal = document.querySelector('.click-addcart-modal')
let checkoutModal = document.querySelector('.click-checkout-modal')

let cartMessage = document.querySelector('.click-addcart-modal-content')
let checkoutMessage = document.querySelector('.click-checkout-modal-content')

let cartCounter = 0
let totalAmount = 0

let toggleCartModal = () => {
    addCartModal.classList.toggle('show-modal')
}

let toggleCheckoutModal = () => {
    checkoutModal.classList.toggle('show-checkout-modal')
}


let cart = [
    {
        userID: window.User.userID,
        tag: Date.now()
    }
]

// event listeners
shoppingForm.addEventListener('submit', (event) => {
    event.preventDefault();
})


// //we get the products from the backend
fetch('/products')
    .then(response => response.json())
    .then(responseData => {
        let products = responseData
        Array.from(addToCartButtons).forEach((element) => {
            element.addEventListener('click', (event)=>{
                event.preventDefault()

                // when a user clicks add to cart, we add an object with the product name and quantity to the cart
                let productName = element.parentElement.parentElement.firstElementChild.innerText
                let quantity = element.parentElement.children[0].value

                //we get the id associated with the product name. check in the products array
                let productID = products.filter(product => product.name === productName)[0].id

                // we need to make sure that there are no duplicate products/entries in the cart
                let match = cart.find(element => element.productName === productName)
                if(!match && quantity > 0){
                    cart.push(
                        {
                            id: productID,
                            productName: productName,
                            quantity: quantity,
                        }
                    )
                    cartCounter += 1
                    cartMessage.innerText = `You have added ${cartCounter} item(s) to the cart.`
                    toggleCartModal()
                    setTimeout(toggleCartModal, 1500)

                }else if(match && quantity > 0){
                    match.quantity = quantity;
                }
            })
        })
        checkoutButton.addEventListener('click', (event) => {
            console.log(cart)
            // put some logic to check if cart is not empty
            if(cart.length > 1){
                Array.from(allQuantityInputFields).forEach(element => {
                    element.value = ''
                });
                let shoppingCart = (JSON.stringify(cart));

                cart.slice(1).forEach(entry => {
                    let ratePerItem = products.filter(product => product.name === entry.productName)[0].ratePerItem
                    let amount = entry.quantity * ratePerItem
                    totalAmount += amount
                });

                checkoutMessage.innerHTML =
                `<div class=checkout-total>
                        <p id="c-1">Purchase details</p>
                        <p id="c-2">Total amount: ${totalAmount}</p>
                        <p id="c-3">Do you wish to finalise the purchase???</p>
                        <button type="submit" class="confirm-purchase">CONFIRM</button>
                </div>`

                toggleCheckoutModal()
                let confirmPurchase = document.querySelector('.confirm-purchase')
                confirmPurchase.addEventListener('click', () => {
                    fetch('/checkout', {
                        'method': 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        'body': shoppingCart
                    })
                    .then(response => response.json())
                    .then(data => console.log(data))
                    .catch(error => console.log(error))
                    toggleCheckoutModal()
                    cartMessage.innerText = `Thank you for shopping with us!!!!!` // Your goods will be delivered to ${window.User.address}`
                    toggleCartModal()
                    setTimeout(toggleCartModal, 1500)

                    //empty the cart after this purchase has been completed.
                    for (let index = 0; index < cart.length; index++) {
                        cart.pop()
                    }
                    cartCounter = 0
                    cart = [
                        {
                            userID: window.User.userID,
                            tag: Date.now()
                        }
                    ]

                })
            }
        })

    })

//TODO;
// fix the cart destoying logic


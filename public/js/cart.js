import axios from 'axios';
import { toNumber } from 'lodash';

const GET_PRODUCTS_URL = '/products'

const fetchData = async (url) => {
    let response = await axios.get(url);
    return response
}

let form = document.getElementsByTagName('form')[0]
let checkoutButton = document.querySelector('.btn-primary')
let addToCartButtons = document.getElementsByClassName('btn-cart')
let cart = [
    {
        userID: 6,// for now let us assume 6 but it should be the id of the logged in customer.
        tag: Date.now() //this field so that we can sort carts by date
    }
]

// event listeners
form.addEventListener('submit', (event) => {
    event.preventDefault();
})


//we get the products from the backend
fetchData(GET_PRODUCTS_URL)
    .then((response) => {
        let products = response.data
        Array.from(addToCartButtons).forEach((element) => {
            element.addEventListener('click', (event)=>{
                event.preventDefault()

                // when a user clicks add to cart, we add an object with the product name and quantity to the cart
                let productName = element.parentElement.parentElement.firstElementChild.innerHTML
                let quantity = toNumber(element.parentElement.children[1].value)

                //we get the id associated with the product name. check in the products array
                let productID = products.filter(product => product.name === productName)[0].id

                // we need to make sure that there are no duplicate products in the cart
                let match = cart.find(element => element.id === productID)
                if(!match && quantity > 0){
                    cart.push(
                        {
                            id: productID,
                            productName: productName,
                            quantity: quantity,
                        }
                    )
                }else if(match && quantity > 0){
                    match.quantity = quantity;
                }


                // ((cart))
            })
        })
        checkoutButton.addEventListener('click', (event) => {
            // put some logic to check if cart is not empty
            if(cart.length > 0){
                let shoppingCart = (JSON.stringify(cart));
                axios.post('/checkout', shoppingCart, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => console.log(response.data))// if response successful , purchase OK.
                    .catch(error => console.log(error))
            }
        })

    })




//TODO;
// solve my allocating axios response to variable problem.
// should i use fetch instead


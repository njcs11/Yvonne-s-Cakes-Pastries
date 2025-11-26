// resources/js/catalog/CartService.js
export default class CartService {
    constructor(endpoint) {
        this.endpoint = endpoint;
    }

    sendToCart(payload) {
        fetch(this.endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('cart-count').textContent =
                    `${data.cartCount} item(s) added`;
                alert(`${payload.name} added to cart!`);
            }
        });
    }
    
}
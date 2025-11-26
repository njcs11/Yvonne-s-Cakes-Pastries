// resources/js/catalog/handlers/CupcakeHandler.js
export default class CupcakeHandler {
    constructor(cartService) {
        this.cartService = cartService;
    }

    populateModal(card, modal) {
        const customizationCard = modal.querySelector('#cupcake-customization');
        const imageEl = modal.querySelector('#cupcake-image');
        const isCustomization = card.dataset.customization === 'true';

        modal.querySelector('#cupcake-name').textContent = card.dataset.name;

        if (isCustomization) {
            customizationCard.classList.remove('hidden');
            imageEl.classList.add('hidden');

            const flavorSelect = modal.querySelector('#cupcake-flavor');
            const icingSelect = modal.querySelector('#cupcake-icing');

            flavorSelect.innerHTML = '';
            icingSelect.innerHTML = '';

            const servings = JSON.parse(card.dataset.servings || '[]');
            servings.forEach(s => {
                if (s.flavor) flavorSelect.innerHTML += `<option value="${s.flavor}">${s.flavor}</option>`;
                if (s.icing) icingSelect.innerHTML += `<option value="${s.icing}">${s.icing}</option>`;
            });

            this.setupQuantity(modal, { value: servings[0]?.price || 0 }, '#cupcake-price', '#cupcake-total', '#quantity-cupcake');

        } else {
            customizationCard.classList.add('hidden');
            imageEl.classList.remove('hidden');
            imageEl.src = card.dataset.image;

            const price = parseFloat(card.dataset.price || 0);
            modal.querySelector('#cupcake-price').textContent = `₱${price.toFixed(2)}`;
            this.setupQuantity(modal, { value: price }, '#cupcake-price', '#cupcake-total', '#quantity-cupcake');
        }
    }

    setupQuantity(modal, priceSource, priceSelector, totalSelector, qtySelector) {
        let qty = 1;
        const qtyEl = modal.querySelector(qtySelector);
        const priceEl = modal.querySelector(priceSelector);
        const totalEl = modal.querySelector(totalSelector);

        const updateTotal = () => {
            qtyEl.textContent = qty;
            const price = parseFloat(priceSource.value || priceSource) || 0;
            priceEl.textContent = `₱${price.toFixed(2)}`;
            totalEl.textContent = `₱${(price * qty).toFixed(2)}`;
        };

        if (priceSource.addEventListener) {
            priceSource.addEventListener('change', updateTotal);
        } else if (priceSource.onchange !== undefined) {
            priceSource.onchange = updateTotal;
        }

        modal.querySelector('#increase-qty-cupcake').onclick = () => { qty++; updateTotal(); };
        modal.querySelector('#decrease-qty-cupcake').onclick = () => { if (qty > 1) qty--; updateTotal(); };
        updateTotal();
    }

    openModal(modal) {
        modal.classList.remove('hidden');
        modal.querySelector('#add-to-cart-cupcake').onclick = () => {
            const price = parseFloat(modal.querySelector('#cupcake-price').textContent.replace('₱', '')) || 0;
            const isCustomization = !modal.querySelector('#cupcake-customization').classList.contains('hidden');
            const flavor = isCustomization ? modal.querySelector('#cupcake-flavor option:checked')?.textContent : null;
            const icing = isCustomization ? modal.querySelector('#cupcake-icing option:checked')?.textContent : null;
            const message = modal.querySelector('#cupcake-message')?.value || null;

            this.cartService.sendToCart({
                id: modal.querySelector('#cupcake-name').textContent,
                name: modal.querySelector('#cupcake-name').textContent,
                image: modal.querySelector('#cupcake-image')?.src ?? null,
                price: price,
                quantity: parseInt(modal.querySelector('#quantity-cupcake').textContent),
                productType: 'Cupcake',
                customization: isCustomization ? { flavor, icing, message } : null
            });

            modal.classList.add('hidden');
        };
    }
}


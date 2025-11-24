// resources/js/catalogfilter.js

import CatalogController from './catalog/CatalogController';
import CartService from './catalog/CartService';
import FoodTrayHandler from './catalog/handlers/FoodTrayHandler';
import FoodPackageHandler from './catalog/handlers/FoodPackageHandler';
import CakeHandler from './catalog/handlers/CakeHandler';
import CupcakeHandler from './catalog/handlers/CupcakeHandler';
import PaluwaganHandler from './catalog/handlers/PaluwaganHandler';

document.addEventListener('DOMContentLoaded', () => {
    // ------------------- INIT CART SERVICE -------------------
    const cartService = new CartService('/cart/add');

    // ------------------- INIT HANDLERS -------------------
    const handlers = {
        foodtray: new FoodTrayHandler(cartService),
        foodpackage: new FoodPackageHandler(cartService),
        cake: new CakeHandler(cartService),
        cupcake: new CupcakeHandler(cartService),
        paluwagan: new PaluwaganHandler(cartService)
    };

    // Expose handlers globally for modal usage
    window.handlers = handlers;

    // ------------------- INIT CONTROLLER -------------------
    const controller = new CatalogController(handlers);
    controller.init();
});

// Removed redundant paluwagan join code since modal handles it now

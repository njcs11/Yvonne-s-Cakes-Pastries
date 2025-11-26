// resources/js/catalog/ProductModalFactory.js
export default class ProductModalFactory {
    static getModal(category) {
        switch (category) {
            case 'foodtray':
                return document.getElementById('foodtray-modal');
            case 'foodpackage':
                return document.getElementById('foodpackage-modal');
            case 'cake':
                return document.getElementById('cake-modal');
            case 'cupcake':
                return document.getElementById('cupcake-modal');
            case 'paluwagan':
                return document.getElementById('paluwagan-modal');
            default:
                return null;
        }
    }
}
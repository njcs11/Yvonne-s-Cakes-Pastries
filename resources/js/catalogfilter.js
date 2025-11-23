document.addEventListener("DOMContentLoaded", function () {
    const categoryButtons = document.querySelectorAll(".category-btn");
    const productCards = document.querySelectorAll(".product-card");

    // ------------------- CATEGORY FILTER -------------------
    categoryButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const category = btn.dataset.category;
            productCards.forEach(card => {
                card.style.display = card.dataset.category === category ? "block" : "none";
            });
        });
    });

    // ------------------- MODALS -------------------
    const modals = {
        foodtray: document.getElementById("foodtray-modal"),
        foodpackage: document.getElementById("foodpackage-modal"),
        cake: document.getElementById("cake-modal"),
        cupcake: document.getElementById("cupcake-modal"),
        paluwagan: document.getElementById("paluwagan-modal"),
    };

    const openModal = (modal) => modal.classList.remove("hidden");
    const closeModal = (modal) => modal.classList.add("hidden");

    // ------------------- CLOSE BUTTONS (Cancel) -------------------
    // Works for all modals with id starting with 'close-'
    document.querySelectorAll("[id^=close-]").forEach(btn => {
        btn.addEventListener("click", () => {
            const modal = btn.closest(".fixed.inset-0");
            if (modal) closeModal(modal);
        });
    });

    // ------------------- PRODUCT CARD CLICK -------------------
    productCards.forEach(card => {
        card.addEventListener("click", () => {
            const category = card.dataset.category;
            const servings = JSON.parse(card.dataset.servings || "[]");
            const isCustomization = card.dataset.customization === "true";

            switch (category) {
                case "foodtray":
                    populateFoodTrayModal(card, servings);
                    openModal(modals.foodtray);
                    break;
                case "foodpackage":
                    populateFoodPackageModal(card, servings);
                    openModal(modals.foodpackage);
                    break;
                case "cake":
                    populateCakeModal(card, servings, isCustomization);
                    openModal(modals.cake);
                    break;
                case "cupcake":
                    populateCupcakeModal(card, servings, isCustomization);
                    openModal(modals.cupcake);
                    break;
                case "paluwagan":
                    populatePaluwaganModal(card);
                    openModal(modals.paluwagan);
                    break;
            }
        });
    });

    // ------------------- HELPER -------------------
    function populateDescriptionList(ulEl, description) {
        ulEl.innerHTML = '';
        if (!description) return;
        description.split("\n").forEach(line => {
            if (line.trim()) {
                const li = document.createElement("li");
                li.textContent = line.trim();
                ulEl.appendChild(li);
            }
        });
    }

    // ------------------- FOOD TRAY -------------------
    function populateFoodTrayModal(card, servings) {
        const modal = modals.foodtray;
        modal.querySelector("#foodtray-name").textContent = card.dataset.name;
        modal.querySelector("#foodtray-image").src = card.dataset.image;
        populateDescriptionList(modal.querySelector("#foodtray-includes"), card.dataset.description);

        const select = modal.querySelector("#foodtray-size");
        select.innerHTML = "";
        servings.forEach(s => {
            const opt = document.createElement("option");
            opt.value = s.price;
            opt.textContent = `${s.size} - ₱${parseFloat(s.price).toFixed(2)}`;
            select.appendChild(opt);
        });

        let qty = 1;
        const qtyEl = modal.querySelector("#quantity-foodtray");
        const priceEl = modal.querySelector("#foodtray-price");
        const totalEl = modal.querySelector("#foodtray-total");

        const updateTotal = () => {
            qtyEl.textContent = qty;
            const price = parseFloat(select.value) || 0;
            priceEl.textContent = `₱${price.toFixed(2)}`;
            totalEl.textContent = `₱${(price * qty).toFixed(2)}`;
        };

        select.onchange = updateTotal;
        modal.querySelector("#increase-qty-foodtray").onclick = () => { qty++; updateTotal(); };
        modal.querySelector("#decrease-qty-foodtray").onclick = () => { if (qty > 1) qty--; updateTotal(); };
        updateTotal();
    }

    // ------------------- FOOD PACKAGE -------------------
    function populateFoodPackageModal(card, servings) {
        const modal = modals.foodpackage;
        modal.querySelector("#foodpackage-name").textContent = card.dataset.name;
        modal.querySelector("#foodpackage-image").src = card.dataset.image;
        populateDescriptionList(modal.querySelector("#foodpackage-includes"), card.dataset.description);

        const price = servings[0]?.price || 0;
        modal.querySelector("#foodpackage-price").textContent = `₱${parseFloat(price).toFixed(2)}`;
        modal.querySelector("#foodpackage-total").textContent = `₱${parseFloat(price).toFixed(2)}`;

        let qty = 1;
        const qtyEl = modal.querySelector("#quantity-foodpackage");

        const updateTotal = () => {
            qtyEl.textContent = qty;
            modal.querySelector("#foodpackage-total").textContent = `₱${(price * qty).toFixed(2)}`;
        };

        modal.querySelector("#increase-qty-foodpackage").onclick = () => { qty++; updateTotal(); };
        modal.querySelector("#decrease-qty-foodpackage").onclick = () => { if (qty > 1) qty--; updateTotal(); };
        updateTotal();
    }

    // ------------------- CAKE -------------------
    function populateCakeModal(card, servings, isCustomization) {
    const modal = modals.cake;
    const customizationCard = modal.querySelector("#cake-customization");
    const messageWrapper = modal.querySelector("#cake-message-wrapper");
    const messageInput = modal.querySelector("#cake-message");
    const imageEl = modal.querySelector("#cake-image");

    modal.querySelector("#cake-name").textContent = card.dataset.name;

    // Personalized message always visible
    messageWrapper.classList.remove("hidden");
    messageInput.value = "";

    if (isCustomization) {
        customizationCard.classList.remove("hidden");
        imageEl.classList.add("hidden"); // hide image for customization
        const sizeSelect = modal.querySelector("#cake-size");
        const flavorSelect = modal.querySelector("#cake-flavor");
        const shapeSelect = modal.querySelector("#cake-shape");
        const icingSelect = modal.querySelector("#cake-icing");

        sizeSelect.innerHTML = "";
        flavorSelect.innerHTML = "";
        shapeSelect.innerHTML = "";
        icingSelect.innerHTML = "";

        servings.forEach(s => {
            if (s.size) sizeSelect.innerHTML += `<option value="${s.price}">${s.size}</option>`;
            if (s.flavor) flavorSelect.innerHTML += `<option value="${s.flavor}">${s.flavor}</option>`;
            if (s.shape) shapeSelect.innerHTML += `<option value="${s.shape}">${s.shape}</option>`;
            if (s.icing) icingSelect.innerHTML += `<option value="${s.icing}">${s.icing}</option>`;
        });
    } else {
        customizationCard.classList.add("hidden");
        imageEl.classList.remove("hidden"); // show image for regular cakes
        imageEl.src = card.dataset.image;
    }

    let qty = 1;
    const priceEl = modal.querySelector("#cake-price");
    const basePrice = isCustomization ? parseFloat(modal.querySelector("#cake-size")?.value || 0) : parseFloat(card.dataset.price || 0);

    const updateTotal = () => {
        const price = isCustomization ? parseFloat(modal.querySelector("#cake-size")?.value || 0) : basePrice;
        priceEl.textContent = (price * qty).toFixed(2);
    };

    modal.querySelector("#increase-qty-cake").onclick = () => { qty++; updateTotal(); };
    modal.querySelector("#decrease-qty-cake").onclick = () => { if (qty > 1) qty--; updateTotal(); };
    if (isCustomization) modal.querySelector("#cake-size").onchange = updateTotal;
    updateTotal();
}

    // ------------------- CUPCAKE -------------------
    function populateCupcakeModal(card, servings, isCustomization) {
        const modal = modals.cupcake;
        const customizationCard = modal.querySelector("#cupcake-customization");
        const regularInfo = modal.querySelector("#cupcake-product-info");

        modal.querySelector("#cupcake-name").textContent = card.dataset.name;

        // Personalized message always visible
        const messageWrapper = modal.querySelector("#cupcake-message-wrapper");
        const messageInput = modal.querySelector("#cupcake-message");
        if (messageWrapper) messageWrapper.classList.remove("hidden");
        if (messageInput) messageInput.value = "";

        if (isCustomization) {
            customizationCard.classList.remove("hidden");
            if (regularInfo) regularInfo.classList.add("hidden");

            const flavorSelect = modal.querySelector("#cupcake-flavor");
            const icingSelect = modal.querySelector("#cupcake-icing");
            flavorSelect.innerHTML = "";
            icingSelect.innerHTML = "";

            servings.forEach(s => {
                if (s.flavor) flavorSelect.innerHTML += `<option value="${s.flavor}">${s.flavor}</option>`;
                if (s.icing) icingSelect.innerHTML += `<option value="${s.icing}">${s.icing}</option>`;
            });
        } else {
            customizationCard.classList.add("hidden");
            if (regularInfo) regularInfo.classList.remove("hidden");
            modal.querySelector("#cupcake-image").src = card.dataset.image;
        }

        let qty = 1;
        const qtyEl = modal.querySelector("#quantity-cupcake");
        const priceEl = modal.querySelector("#cupcake-price");
        const price = servings[0]?.price || 0;

        const updateTotal = () => {
            qtyEl.textContent = qty;
            priceEl.textContent = `₱${(price * qty).toFixed(2)}`;
        };

        modal.querySelector("#increase-qty-cupcake").onclick = () => { qty++; updateTotal(); };
        modal.querySelector("#decrease-qty-cupcake").onclick = () => { if (qty > 1) qty--; updateTotal(); };
        updateTotal();
    }


    // ------------------- PALUWAGAN -------------------
    function populatePaluwaganModal(card) {
        const modal = modals.paluwagan;
        modal.querySelector("#paluwagan-name").textContent = card.dataset.name;
        modal.querySelector("#paluwagan-image").src = card.dataset.image;
        populateDescriptionList(modal.querySelector("#paluwagan-desc"), card.dataset.description || "");
    }
});

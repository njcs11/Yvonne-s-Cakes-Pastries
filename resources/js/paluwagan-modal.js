document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("paluwagan-modal");
    const step1 = document.getElementById("paluwagan-step1");
    const step2 = document.getElementById("paluwagan-step2");

    const joinBtn = document.getElementById("join-paluwagan");
    const backBtn = document.getElementById("back-paluwagan");
    const confirmBtn = document.getElementById("confirm-paluwagan");
    const closeBtn = document.getElementById("close-modal-paluwagan");

    const imageStep2 = document.getElementById("paluwagan-image2");
    const startMonthSelect = document.getElementById("start-month");

    let currentPaluwaganData = null;

    // ------------------- OPEN MODAL WITH DATA -------------------
    window.openPaluwaganModal = function (paluwaganData) {
        currentPaluwaganData = paluwaganData;

        // Populate Step 1
        document.getElementById("paluwagan-name").textContent = paluwaganData.name;
        document.getElementById("paluwagan-image").src = paluwaganData.image;
        document.getElementById("paluwagan-total").textContent = `₱${parseFloat(paluwaganData.total).toFixed(2)}`;
        document.getElementById("paluwagan-monthly").textContent = `₱${parseFloat(paluwaganData.monthly).toFixed(2)}`;
        document.getElementById("paluwagan-duration").textContent = paluwaganData.duration;

        // Reset to step 1
        step1.classList.remove("hidden");
        step2.classList.add("hidden");
        modal.classList.remove("hidden");
    };

    // ------------------- STEP NAVIGATION -------------------
    joinBtn.addEventListener("click", () => {
        if (!currentPaluwaganData) return;

        // Populate Step 2
        imageStep2.src = currentPaluwaganData.image;
        startMonthSelect.value = startMonthSelect.options[0].value;

        step1.classList.add("hidden");
        step2.classList.remove("hidden");
    });

    backBtn.addEventListener("click", () => {
        step2.classList.add("hidden");
        step1.classList.remove("hidden");
    });

    confirmBtn.addEventListener("click", () => {
        const selectedMonth = startMonthSelect.value;
        if (!selectedMonth) {
            alert("Please select a start month.");
            return;
        }

        // Example: redirect to PaluwaganPage with chosen month as query param
        const url = `/paluwagan/${currentPaluwaganData.id}?start_month=${encodeURIComponent(selectedMonth)}`;
        window.location.href = url;
    });

    // ------------------- CLOSE MODAL -------------------
    closeBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    // Optional: close modal when clicking outside content
    modal.addEventListener("click", (e) => {
        if (e.target === modal) modal.classList.add("hidden");
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const gcashDetails = document.getElementById('gcashDetails');
    const codNote = document.getElementById('codNote');
    const paymentRadios = document.querySelectorAll('input[name="payment"]');
    const orderTotal = document.getElementById('orderTotal');

    function togglePaymentDetails() {
        const checkedRadio = document.querySelector('input[name="payment"]:checked');
        const selected = checkedRadio ? checkedRadio.value : null;

        if (selected === 'gcash') {
            gcashDetails.classList.remove('hidden');
            codNote.classList.add('hidden');
        } else if (selected === 'cod') {
            gcashDetails.classList.add('hidden');
            codNote.classList.remove('hidden');
            orderTotal.textContent = document.getElementById('summaryTotal').textContent;
        } else {
            gcashDetails.classList.add('hidden');
            codNote.classList.add('hidden');
        }
    }

    // Listen to changes
    paymentRadios.forEach(radio => radio.addEventListener('change', togglePaymentDetails));

    // Initialize visibility on page load
    togglePaymentDetails();
});

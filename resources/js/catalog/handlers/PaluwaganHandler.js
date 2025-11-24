// resources/js/catalog/handlers/PaluwaganHandler.js
export default class PaluwaganHandler {
    constructor(cartService) {
        this.cartService = cartService;
    }

    populateModal(card, modal) {
        modal.querySelector('#paluwagan-name').textContent = card.dataset.name;
        modal.querySelector('#paluwagan-image').src = card.dataset.image;
        modal.querySelector('#paluwagan-desc').innerHTML = '';

        const description = card.dataset.description || '';
        description.split('\n').forEach(line => {
            if (line.trim()) {
                const li = document.createElement('li');
                li.textContent = line.trim();
                modal.querySelector('#paluwagan-desc').appendChild(li);
            }
        });

        // Populate Total Package, Monthly Payment, Duration for Paluwagan packages
        if (card.dataset.servings) {
            const servings = JSON.parse(card.dataset.servings);
            if (servings.length > 0) {
                modal.querySelector('#paluwagan-total').textContent = servings[0].price;
                modal.querySelector('#paluwagan-monthly').textContent = card.dataset.monthly || servings[0].price;
                modal.querySelector('#paluwagan-duration').textContent = card.dataset.duration || servings[0].size;
            }
        }

        // Ensure Step 1 is visible initially
        modal.querySelector('#paluwagan-step1').classList.remove('hidden');
        modal.querySelector('#paluwagan-step2').classList.add('hidden');

        // Set up Join and Back buttons
        const joinBtn = modal.querySelector('#join-paluwagan');
        const backBtn = modal.querySelector('#back-paluwagan');

        joinBtn.addEventListener('click', () => {
            modal.querySelector('#paluwagan-step1').classList.add('hidden');
            modal.querySelector('#paluwagan-step2').classList.remove('hidden');
        });

        backBtn.addEventListener('click', () => {
            modal.querySelector('#paluwagan-step2').classList.add('hidden');
            modal.querySelector('#paluwagan-step1').classList.remove('hidden');
        });
    }

    openModal(modal) {
        modal.classList.remove('hidden');
    }

    handleConfirmEnrollment(modal) {
        const packageId = modal.dataset.packageId; // set this when opening modal
        const startMonth = modal.querySelector('#start-month').value;

        if (!packageId) {
            alert('Package not selected!');
            return;
        }

        fetch('/paluwagan/enroll', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                packageID: packageId,
                startMonth: startMonth
            })
        }).then(res => res.json())
          .then(data => {
              if (data.success) {
                  alert('Enrollment successful!');
                  modal.classList.add('hidden');
                  // Optionally reload paluwagan page or update frontend
              } else {
                  alert(data.message || 'Failed to enroll');
              }
          });
    }
}

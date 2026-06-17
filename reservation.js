document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    if (form) {
        const submitBtn = form.querySelector("button[type='submit']");

        form.addEventListener("submit", function (e) {
            const nom   = form.nom   ? form.nom.value.trim() : '';
            const date  = form.date  ? form.date.value       : '';
            const heure = form.heure ? form.heure.value      : '';

            if (!nom || !date || !heure) {
                e.preventDefault();
                alert("Tous les champs sont obligatoires.");
                return;
            }

            const selectedDate = new Date(date + "T" + heure);
            const now          = new Date();
            if (selectedDate < now) {
                e.preventDefault();
                alert("Impossible de réserver une date passée.");
                return;
            }

            if (submitBtn) {
                submitBtn.disabled    = true;
                submitBtn.textContent = "Envoi en cours...";
            }
        });
    }

    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const id        = this.getAttribute('data-id');
            const csrfToken = this.getAttribute('data-csrf');

            if (!confirm("Voulez-vous vraiment supprimer cette réservation ?")) {
                return;
            }

            const formData = new FormData();
            formData.append('id',          id);
            formData.append('csrf_token',  csrfToken);

            fetch('../backend/supprimer_reservation.php', {
                method: 'POST',
                body:   formData
            })
            .then(function (response) { return response.text(); })
            .then(function (data) {
                if (data.trim() === "OK") {
                    btn.closest('.reservation-card').remove();
                } else {
                    alert("Erreur : " + data);
                }
            })
            .catch(function () {
                alert("Erreur réseau lors de la suppression.");
            });
        });
    });

});
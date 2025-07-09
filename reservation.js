// reservation.js

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const submitBtn = form.querySelector("button[type='submit']");

    form.addEventListener("submit", function (e) {
        // Désactiver le bouton pour éviter les doubles clics
        submitBtn.disabled = true;
        submitBtn.textContent = "Envoi en cours...";

        // Vérifier les champs
        const nom = form.nom.value.trim();
        const date = form.date.value;
        const heure = form.heure.value;

        if (!nom || !date || !heure) {
            e.preventDefault();
            alert("Tous les champs sont obligatoires.");
            submitBtn.disabled = false;
            submitBtn.textContent = "Réserver";
            return;
        }

        // Vérifier si la date sélectionnée est passée
        const selectedDate = new Date(date + "T" + heure);
        const now = new Date();
        if (selectedDate < now) {
            e.preventDefault();
            alert("Impossible de réserver une date passée.");
            submitBtn.disabled = false;
            submitBtn.textContent = "Réserver";
        }
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');

            if (confirm("Voulez-vous vraiment supprimer cette réservation ?")) {
                fetch(`../backend/supprimer_reservation.php?id=${id}`, {
                    method: 'GET'
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "OK") {
                        this.parentElement.remove(); // retire la carte du DOM
                    } else {
                        alert("Erreur : " + data);
                    }
                });
            }
        });
    });
});

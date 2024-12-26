document.querySelector("form").addEventListener("submit", function (e) {
  e.preventDefault(); // Empêche le formulaire de se soumettre normalement

  const formData = new FormData(this); // Récupère les données du formulaire

  fetch("../controllers/submit_contact.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        document.querySelector(
          ".form"
        ).innerHTML = `<p class="success">${data.message}</p>`;
      } else {
        // Si une erreur se produit, on affiche le message d'erreur
        document.querySelector(
          ".form"
        ).innerHTML = `<p class="error">${data.message}</p>`;
      }
    })
    .catch((error) => {
      document.querySelector(
        ".form"
      ).innerHTML = `<p class="error">Une erreur est survenue. Veuillez réessayer plus tard.</p>`;
    });
});

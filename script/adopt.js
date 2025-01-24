document
  .getElementById("adoptionForm")
  .addEventListener("submit", async function (event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    try {
      const response = await fetch(
        "/php/cinema/appphp/E-Shop/organization/process_adoption",
        {
          method: "POST",
          headers: {
            Accept: "application/json",
          },
          body: formData,
        }
      );
      
      
      
      

      // Vérifie si la réponse HTTP est correcte
      if (!response.ok) {
        // Affiche une erreur si la réponse n'est pas OK
        console.error("Erreur HTTP : " + response.status);
        alert("Une erreur s'est produite. Veuillez réessayer plus tard.");
        return;
      }

      // Si la réponse est OK, essaie de la convertir en JSON
      const result = await response.json();

      // Gère la réponse JSON
      if (result.success) {
        alert("Votre demande a été envoyée avec succès.");
        event.target.reset();
        const formContainer = document.getElementById("adoptionForm");
        if (formContainer) {
          formContainer.style.display = "none";
        }
      } else {
        alert("Erreur : " + result.message);
      }
    } catch (error) {
      console.error("Erreur lors de l'envoi de la demande:", error);
      alert("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
  });

document.addEventListener("DOMContentLoaded", () => {
  const closeButton = document.querySelector(".close");
  const modal = document.getElementById("adoptionForm");

  if (closeButton && modal) {
    closeButton.addEventListener("click", () => {
      modal.style.display = "none";
    });
  }
});

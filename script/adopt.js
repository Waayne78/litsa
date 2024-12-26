document
  .getElementById("adoptionForm")
  .addEventListener("submit", async function (event) {
    event.preventDefault(); 

    const formData = new FormData(event.target);

    try {
      const response = await fetch("../controllers/process_adoption.php", {
        method: "POST",
        headers: {
          Accept: "application/json",
        },
        body: formData, 
      });

      const result = await response.json();

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

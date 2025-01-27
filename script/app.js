document.addEventListener("DOMContentLoaded", function () {
  const popup = document.getElementById("popupForm");
  const editPopup = document.getElementById("editPopupForm");
  const addAnimalForm = document.getElementById("addAnimalForm");
  const editAnimalForm = document.getElementById("editAnimalForm");
  const animalGrid = document.querySelector(".animal-grid");
  const successPopup = document.getElementById("successPopup");
  let currentEditingCard = null;
  const formData = new FormData(document.querySelector("form"));

  window.openPopup = function () {
    popup.style.display = "flex";
  };

  window.closePopup = function () {
    popup.style.display = "none";
    addAnimalForm.reset();
  };

  function openEditPopup(card) {
    currentEditingCard = card;
    const animalId = card.getAttribute("data-animal-id");
    document.getElementById("edit-animal-id").value = animalId;
    document.getElementById("edit-animal-name").value =
      card.querySelector("h3").textContent;
    document.getElementById("edit-animal-description").value = card
      .querySelector("p")
      .textContent.replace("Description : ", "");
    document
      .getElementById("edit-animal-photo")
      .setAttribute("data-img-src", card.querySelector("img").src);
    editPopup.style.display = "flex";
  }

  window.closeEditPopup = function () {
    editPopup.style.display = "none";
    editAnimalForm.reset();
  };

  animalGrid.addEventListener("click", function (e) {
    if (e.target.closest(".edit-btn")) {
      const card = e.target.closest(".animal-card");
      openEditPopup(card);
    }
  });

  animalGrid.addEventListener("click", function (e) {
    if (e.target.closest(".delete-btn")) {
      const card = e.target.closest(".animal-card");
      const animalId = card.getAttribute("data-animal-id");
      if (
        confirm(
          `Voulez-vous vraiment supprimer ${
            card.querySelector("h3").textContent
          }?`
        )
      ) {
        fetch(
          `/php/cinema/appphp/E-Shop/organization/delete_animal?id=${animalId}`,
          {
            method: "GET",
          }
        )
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              card.remove();
            } else {
              alert("Échec de la suppression: " + data.error);
            }
          })
          .catch((error) => {
            alert("Erreur lors de la suppression: " + error.message);
          });
      }
    }
  });

  document
    .getElementById("addAnimalForm")
    .addEventListener("submit", function (event) {
      event.preventDefault();

      const formData = new FormData(this);
      fetch("/php/cinema/appphp/E-Shop/organization/add_animal", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            closePopup();
            successPopup.classList.add("show");
            successPopup.style.display = "block";
            setTimeout(function () {
              successPopup.classList.remove("show");
              successPopup.style.display = "none";
              window.location.reload();
            }, 1000);
          } else {
            alert("Échec de l'ajout: " + data.error);
          }
        })
        .catch((error) => {
          console.error("Erreur lors de l'ajout:", error);
          alert("Erreur lors de l'ajout: " + error.message);
        });
    });

  editAnimalForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const animalId = document.getElementById("edit-animal-id").value;
    const name = document.getElementById("edit-animal-name").value;
    const description = document.getElementById(
      "edit-animal-description"
    ).value;
    const photo = document.getElementById("edit-animal-photo").files[0];
    const imgSrc = document
      .getElementById("edit-animal-photo")
      .getAttribute("data-img-src");

    const formData = new FormData(editAnimalForm);
    formData.append("animal-id", animalId);

    fetch(`/php/cinema/appphp/E-Shop/organization/edit_animal`, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          currentEditingCard.querySelector("h3").textContent = name;
          currentEditingCard.querySelector("p").textContent =
            "Description : " + description;

          if (photo) {
            const reader = new FileReader();
            reader.onload = function (e) {
              currentEditingCard.querySelector("img").src = e.target.result;
            };
            reader.readAsDataURL(photo);
          } else {
            currentEditingCard.querySelector("img").src = imgSrc;
          }

          closeEditPopup();
        } else {
          alert("Échec de la mise à jour");
        }
      })
      .catch((error) => {
        alert("Erreur lors de la mise à jour: " + error.message);
      });
  });

  const adoptButtons = document.querySelectorAll(".adopt-btn");

  adoptButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const animalId = this.closest(".animal-card").dataset.animalId;
      const animalName =
        this.closest(".animal-card").querySelector("h3").textContent;
      openAdoptionForm(animalId, animalName);
    });
  });

  function openAdoptionForm(animalId, animalName) {
    const form = document.getElementById("adoptionForm");
    form.querySelector("#animal-id").value = animalId;
    form.querySelector(".animal-name").textContent = animalName;
    form.style.display = "block";
  }
});

document.querySelector("form").addEventListener("submit", function (e) {
  e.preventDefault();
  const formData = new FormData(this);
  fetch(
    "/php/cinema/appphp/E-Shop/organization/controllers/submit_contact.php",
    {
      method: "POST",
      body: formData,
    }
  )
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        document.querySelector(
          ".form"
        ).innerHTML = `<p class="success">${data.message}</p>`;
      } else {
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

document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("login-form");

  form.addEventListener("submit", function(e) {
    e.preventDefault();
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if (username === "piotr" && password === "ryba") {
      window.location.href = "/slownik";
    } else {
      window.alert("dane logowania są niepoprawne");
    }
  });
});

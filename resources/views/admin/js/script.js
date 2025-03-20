window.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.querySelector("#togglePassword");
    const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
    const password = document.querySelector("#password");
    const confirmPassword = document.querySelector("#password_confirmation");

    togglePassword.addEventListener("click", function (e) {
      // toggle the type attribute for password field
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      // toggle the eye / eye slash icon
      this.classList.toggle("bi-eye");
    });

    toggleConfirmPassword.addEventListener("click", function (e) {
      // toggle the type attribute for confirm password field
      const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
      confirmPassword.setAttribute("type", type);
      // toggle the eye / eye slash icon
      this.classList.toggle("bi-eye");
    });
});

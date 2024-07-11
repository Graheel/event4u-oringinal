
document.addEventListener("DOMContentLoaded", function() {
  const formOpenBtn = document.querySelector("#form-open");
  const home = document.querySelector(".home");
  const formContainer = document.querySelector(".form_container");
  const formCloseBtn = document.querySelector(".form_close");
  const signupBtn = document.querySelector("#signup");
  const loginBtn = document.querySelector("#login");
  const pwShowHide = document.querySelectorAll(".pw_hide");
  const accountDetails = document.getElementById("account-details");
  const userEmail = document.querySelector(".user-email");
  const logoutBtn = document.getElementById("logout");

  
  const isLoggedIn = () => {
    return !!localStorage.getItem("user_email");
  };

  
  const showAccountDetails = () => {
    if (isLoggedIn()) {
      const email = localStorage.getItem("user_email");
      userEmail.textContent = email;
      accountDetails.style.display = "flex";
      formOpenBtn.style.display = "none"; 
    } else {
      accountDetails.style.display = "none";
      formOpenBtn.style.display = "block"; 
    }
  };

 
  formOpenBtn.addEventListener("click", () => home.classList.add("show"));
  formCloseBtn.addEventListener("click", () => home.classList.remove("show"));

  pwShowHide.forEach((icon) => {
    icon.addEventListener("click", () => {
      let getPwInput = icon.parentElement.querySelector("input");
      if (getPwInput.type === "password") {
        getPwInput.type = "text";
        icon.classList.replace("uil-eye-slash", "uil-eye");
      } else {
        getPwInput.type = "password";
        icon.classList.replace("uil-eye", "uil-eye-slash");
      }
    });
  });

  signupBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.add("active");
  });
  loginBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.remove("active");
  });

  logoutBtn.addEventListener("click", () => {
    localStorage.removeItem("user_email"); 
    showAccountDetails(); 
  });
  
  showAccountDetails();
});
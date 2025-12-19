document.addEventListener("DOMContentLoaded", function () {
  var filterButtons = document.querySelectorAll(".filter-button");
  var cards = document.querySelectorAll(".achievement-card");
  var modal = document.getElementById("card-modal");
  var modalImage = document.getElementById("modal-image");
  var modalTitle = document.getElementById("modal-title");
  var modalDescription = document.getElementById("modal-description");
  var modalClose = document.querySelector(".modal-close");
  var searchInput = document.getElementById("search-input");
  var currentFilter = "all";
  var currentSearch = "";

  function applyFilters() {
    cards.forEach(function (card) {
      var category = card.getAttribute("data-category");
      var text = card.textContent.toLowerCase();
      var matchesCategory = currentFilter === "all" || category === currentFilter;
      var matchesSearch = currentSearch === "" || text.indexOf(currentSearch) !== -1;

      if (matchesCategory && matchesSearch) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  }

  if (filterButtons.length > 0 && cards.length > 0) {
    filterButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        var filter = this.getAttribute("data-filter");
        currentFilter = filter;

        filterButtons.forEach(function (btn) {
          btn.classList.remove("active");
        });
        this.classList.add("active");

        applyFilters();
      });
    });
  }

  if (searchInput) {
    searchInput.addEventListener("input", function () {
      currentSearch = searchInput.value.toLowerCase().trim();
      applyFilters();
    });
  }

  if (cards.length > 0 && modal) {
    cards.forEach(function (card) {
      card.addEventListener("click", function () {
        var imgSrc = card.getAttribute("data-image");
        var title = card.querySelector("h3").textContent;
        var description = card.querySelector("p").textContent;

        modalImage.src = imgSrc;
        modalTitle.textContent = title;
        modalDescription.textContent = description;
        modal.style.display = "flex";
      });
    });
  }

  if (modal && modalClose) {
    modalClose.addEventListener("click", function () {
      modal.style.display = "none";
    });

    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    });

    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && modal.style.display === "flex") {
        modal.style.display = "none";
      }
    });
  }

  var contactForm = document.getElementById("contact-form");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      var name = document.getElementById("name");
      var email = document.getElementById("email");
      var message = document.getElementById("message");

      if (!name.value.trim() || !email.value.trim() || !message.value.trim()) {
        alert("Please fill in your name, email, and message before submitting.");
        e.preventDefault();
        return;
      }

      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email.value.trim())) {
        alert("Please enter a valid email address.");
        e.preventDefault();
        return;
      }

      alert("Thank you for your message!");
    });
  }

  var registerForm = document.getElementById("register-form");
  if (registerForm) {
    registerForm.addEventListener("submit", function (e) {
      var name = document.getElementById("reg-name").value.trim();
      var email = document.getElementById("reg-email").value.trim();
      var password = document.getElementById("reg-password").value;
      var confirmPassword = document.getElementById("reg-confirm-password").value;

      if (!name || !email || !password || !confirmPassword) {
        alert("Please fill in all fields to continue.");
        e.preventDefault();
        return;
      }

      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        e.preventDefault();
        return;
      }

      if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        e.preventDefault();
        return;
      }

      if (password !== confirmPassword) {
        alert("Passwords do not match. Please re-check.");
        e.preventDefault();
        return;
      }

      alert("Account created successfully!");
    });
  }
});

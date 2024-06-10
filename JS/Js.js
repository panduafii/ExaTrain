$(document).ready(function () {
  $(".message a").click(function (event) {
    event.preventDefault(); // Prevent the default link behavior
    $(this).closest("form").toggleClass("active").animate({ height: "toggle", opacity: "toggle" }, "slow");
    $(this).closest("form").siblings("form").toggleClass("active").animate({ height: "toggle", opacity: "toggle" }, "slow");
  });

  // Initially show the login form
  $(".login-form").addClass("active").show();
});

document.querySelectorAll(".year-selector button").forEach((button) => {
  button.addEventListener("click", () => {
    document.querySelector(".year-selector .active").classList.remove("active");
    button.classList.add("active");
  });
});

function selectCourse(courseElement) {
  courseElement.classList.toggle("active");
}

document.addEventListener("DOMContentLoaded", () => {
  const yearButtons = document.querySelectorAll(".year-button");
  const yearFilter = document.getElementById("yearFilter");

  yearButtons.forEach((button) => {
    button.addEventListener("click", () => {
      yearButtons.forEach((btn) => btn.classList.remove("active"));
      button.classList.add("active");
    });
  });

  yearFilter.addEventListener("change", (e) => {
    const selectedYear = e.target.value;
    yearButtons.forEach((btn) => btn.classList.remove("active"));
    document.getElementById(selectedYear).classList.add("active");
  });
});

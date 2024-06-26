$(document).ready(function () {
  // Handle form switching between login and register
  $(".message a").click(function (event) {
    event.preventDefault(); // Prevent the default link behavior
    $(".login-form, .register-form").toggleClass("active").animate({ height: "toggle", opacity: "toggle" }, "slow");
  });

  // Initially show the login form
  $(".login-form").addClass("active").show();

  // Handle menu toggle for mobile view
  $(".menu-toggle").click(function () {
    $(".menu").toggleClass("active");
  });
});

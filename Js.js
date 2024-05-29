$(document).ready(function () {
  $(".message a").click(function (event) {
    event.preventDefault(); // Prevent the default link behavior
    $(this).closest("form").toggleClass("active").animate({ height: "toggle", opacity: "toggle" }, "slow");
    $(this).closest("form").siblings("form").toggleClass("active").animate({ height: "toggle", opacity: "toggle" }, "slow");
  });

  // Initially show the login form
  $(".login-form").addClass("active").show();
});

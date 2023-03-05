$(document).ready(function () {
  $("#admin-login").on("submit", function () {
    var email = $("#log_email");
    var pass = $("#log_password");
    var status = false;
    if (email.val() == "") {
      email.addClass("border-danger");
      $("#e_error").html(
        "<span class='text-danger'>Please Enter Email Address</span>"
      );
      status = false;
    } else {
      email.removeClass("border-danger");
      $("#e_error").html("");
      status = true;
    }
    if (pass.val() == "") {
      pass.addClass("border-danger");
      $("#p_error").html(
        "<span class='text-danger'>Please Enter Password</span>"
      );
      status = false;
    } else {
      pass.removeClass("border-danger");
      $("#p_error").html("");
      status = true;
    }
    if (status) {
      $.ajax({
        url: "includes/process.php",
        method: "POST",
        data: $("#admin-login").serialize(),
        success: function (data) {
          if (data == "Password Does not Match") {
            pass.addClass("border-danger");
            $("#p_error").html(
              "<span class='text-danger'>Please Enter Correct Password</span>"
            );
            status = false;
          } else {
            console.log(data);
            window.location.href ="dashboard.php";
          }
        },
      });
    }
  });

  $("#category_form").on("submit", function () {
    var cat_name = $("#category_name");
    if (cat_name.val() == "") {
      $("#category_name").addClass("border-danger");
      $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
    } else {
      $.ajax({
        url: "includes/process.php",
        method: "POST",
        data: $("#category_form").serialize(),
        success: function (data) {
          if (data == "CATEGORY_ADDED") {
            $("#cat_error").html("<span class='text-success'>Catagory addded successfully</span>");
          } else {
            $("#cat_error").html("<span class='text-danger'>Something Went Wrong</span>");
          }
        }
      })
    }
  })
})
var price = document.getElementById("m_price");
var cost = document.getElementById("m_cost");

price.addEventListener("change", function () {
  var parcentage = (price.value * 13) / 100;
  cost.value = price.value-parcentage;
});
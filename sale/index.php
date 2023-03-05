<?php
session_start();
include 'includes/user.php';
$id = isset($_SESSION['id_m']) ? $_SESSION['id_m'] : NULL;
$init = isset($_SESSION['init_m']) ? $_SESSION['init_m'] : NULL;
if ($id == !NULL && $init == !NULL) {
  header('location:testorder.php?id=' . $id . '&init=' . $init . '');
}

if (isset($_POST['submit'])) {

  $conn = new Admin();
  $t = new mysqli("localhost","shebabar_shebabari","mysql!8Dy()","shebabar_inv");
  $username = $t->real_escape_string($_POST['username']);
  $pass = $t->real_escape_string($_POST['password']);

  $sql = "SELECT * FROM manager WHERE username='$username' AND password='$pass'";
  $check = $conn->login($sql);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Shebabari - Login</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/shebabari.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>

                  <form class="user" id="admin-login" method="POST">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control" id="log_email" aria-describedby="emailHelp" placeholder="Enter Email Address">
                      <small id="e_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" id="log_password" placeholder="Password">
                      <small id="p_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <input class="btn btn-primary btn-block" type="submit" name="submit" value="Login">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>


</body>

</html>
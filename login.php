<?php require_once ('config.php'); ?>
<?php error_reporting(0); ?>
<?php
session_start();
if ($_SESSION['userID'] == TRUE) {
    header("Location: index.php");
}
?>
<?php
$responseText = '';
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $qr=mysqli_query($db,$query) or die('Query failed. ' . mysqli_error($db));
    if (mysqli_num_rows($qr) == 1) {
        $row = mysqli_fetch_array($qr);
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['name'] = $row['name'];
        header('Location: index.php');
        exit;
    } else {
        $responseText ='<div class="alert alert-warning">
                        <span class="close" data-dismiss="alert">&times;</span>
                        <strong>Error!</strong> Wrong username or password. 
                        </div>';
    }
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>What2Do : Login</title>
    <style>
      html, body {
      height: 100%;
      }

      html {
          display: table;
          margin: auto;
      }

      body {
          display: table-cell;
          vertical-align: middle;
          background-color: #E9ECEF;
      }
    </style>
  </head>
  <body>
    <section class="container">
      <section class="row justify-center">
        <div class="jumbotron">
          <form class="needs-validation" method="POST" action="" novalidate>
            <h3 class="text-center ">Welcome to What2Do</h3>
            <div class="form-row">
              <div class="col-12 mb-2">
                <?php echo $responseText; ?>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-2">
                <label for="inputUsername">Username</label>
                <input name="username" type="text" class="form-control" id="inputUsername" placeholder="zax" required>
                <div class="invalid-feedback">
                  Please enter your Username.
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <label for="inputPassword">Password</label>
                <input name="password" type="text" class="form-control" id="inputPassword" placeholder="1234" required>
                <div class="invalid-feedback">
                  Please enter your Password.
                </div>
              </div>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
            <button class="btn btn-secondary" type="button" onclick="window.location.href='register.php'">Register</button>
          </form>
        </div>
      </section>
    </section>

    <script>
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          var forms = document.getElementsByClassName('needs-validation');
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php
include_once './conexion.php';

function aler()
{
  echo 'hiciste click';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="../style.css">
  <title>Document</title>
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="../img/logo.png" class="img-fluid img_ampere" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="./home.php" method="post">
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
              <p class="lead fw-normal mb-0 me-3">Sign in with</p>
              <button type="button" class="btn btn-primary btn-floating mx-1 btn_ampere">
                <i class="fa-brands fa-facebook-f"></i>
              </button>

              <button type="button" class="btn btn-primary btn-floating mx-1 btn_ampere">
                <i class="fa-brands fa-twitter"></i>
              </button>

              <button type="button" class="btn btn-primary btn-floating mx-1 btn_ampere">
                <i class="fa-brands fa-linkedin-in"></i>
              </button>
            </div>

            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0">Or</p>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" />
              <label class="form-label" for="form3Example3">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" />
              <label class="form-label" for="form3Example4">Password</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                  Remember me
                </label>
              </div>
              <a href="#!" class="text-body">Forgot password?</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg btn_ampere" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="logina">
                Login
                <i class="fa-solid fa-right-to-bracket"></i>
              </button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-danger ampere_clr">Register</a></p>
            </div>

            <?php 
                if (array_key_exists('logina', $_POST)) {
                  aler();
                } 
              ?>

          </form>
        </div>
      </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary ampere_bk footer_login">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
        Copyright © 2020. Grupo 4 - Programación 3.
      </div>
      <!-- Copyright -->

      <!-- Right -->
      <div>
        <a href="#!" class="text-white me-4">
          <i class="fa-brands fa-facebook-f"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fa-brands fa-twitter"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="#!" class="text-white">
          <i class="fa-brands fa-linkedin-in"></i>
        </a>
      </div>
      <!-- Right -->


      <!-- LINK FONTAWESOME -->
      <script src="https://kit.fontawesome.com/c997deb1aa.js" crossorigin="anonymous"></script>
    </div>
  </section>
</body>

</html>
<?php
 session_start();session_destroy();
 require'./conexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head> <?php $obj=new ConexionBD(); $obj->Header();?> </head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="../img/logo.png" class="img-fluid img_ampere" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="Procesador.php" method="post">
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
              <input type="text" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" name="usuario" />
              <label class="form-label" for="form3Example3">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" name="pass" />
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
            <button type="submit" class="btn btn-primary btn-lg btn_ampere" style="padding-left: 2.5rem; padding-right: 2.5rem;" value="aceptar" name="btaccede" id="btaccede">
                            Ingresar
                <i class="fa-solid fa-right-to-bracket"></i>
              </button>
            </div>

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

    </div>
  </section>
</body>

</html>
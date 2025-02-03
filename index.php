<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Manajemen Raperda dan Paripurna DPRD">
  <meta name="author" content="Icha gemoyy">
  <title> Manajemen Raperda dan Paripurna DPRD - Login</title>
  <link rel="icon" href="dist/img/dprdbulat.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page" style="background-image: url('dist/img/background.jpeg'); background-size: cover; background-position: center; overflow: hidden; height: 100vh;">

  <div class="background-overlay"></div>

  <div class="login-box">
    <div class="login-logo" style="text-align: center; font-family: 'Arial', sans-serif; background-color: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
      <img class="w-25" src="dist/img/dprdbulat.png" alt="logo" style="max-width: 25%; margin-bottom: 15px; border-radius: 5px;">
      <br>
      <span style="display: block; font-size: 2rem; font-weight: bold; color: #2c3e50; letter-spacing: 1px;">
        MAPERDA
      </span>
      <span style="display: block; font-size: 1.2rem; font-weight: normal; color: #34495e; margin-top: 5px;">
        MANAJEMEN RAPERDA DAN PARIPURNA 
      </span>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg" style="font-size: 1.5rem; font-weight: bold;">LOGIN</p>

        <form action="include/login.php" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-eye" onclick="togglePassword()" style="cursor: pointer;"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
          </div>
        </form>

        <hr>
        <p class="text-center">
          <a href="forget.php" class="text-danger">Lupa Password?</a>
        </p>
        <p class="text-center">
          <a href="register.php" class="btn btn-warning btn-block">Buat Akun Baru!</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <!-- Script untuk Toggle Password -->
  <script>
    function togglePassword() {
      const passwordField = document.getElementById("password");
      const toggleText = document.querySelector(".toggle-password");
      const passwordType = passwordField.getAttribute("type");

      if (passwordType === "password") {
        passwordField.setAttribute("type", "text");
        toggleText.textContent = "Sembunyikan";
      } else {
        passwordField.setAttribute("type", "password");
        toggleText.textContent = "Tampilkan";
      }
    }
  </script>
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    }
  </script>

  <style>
    /* Background overlay with blur effect */
    .background-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: url('dist/img/background.jpeg');
      background-size: cover;
      background-position: center;
      filter: blur(5px);
      z-index: -1;
      animation: blurEffect 5s infinite alternate;
    }

    /* Animation for blur effect */
    @keyframes blurEffect {
      0% {
        filter: blur(5px);
      }

      100% {
        filter: blur(0px);
      }
    }
  </style>
</body>

</html>
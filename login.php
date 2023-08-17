<?php               
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel = "icon" type = "image/png" href = "images/logo.png" />
    <title>PRMS</title>
    <script src="libraries/p5.js" type="text/javascript"></script>
    <script src="libraries/p5.dom.js" type="text/javascript"></script>
    <script src="libraries/p5.sound.js" type="text/javascript"></script>
    <script src="sketch.js" type="text/javascript"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
      #container{
        width:60% !important;
      }
    </style>
  </head>
<body class="bg-light">
<div class="container mt-5 card shadow-lg rounded" id="container">
    <div class="row">
        <!-- Left column for content or imagery -->
        <div class="col-md-6 bg-info p-3">
            <h4 class="text-white">Welcome Back!</h4>
            <p class="text-white">Patient Record Management System</p>
            <img src="images/logo.png" alt="Image" class="">
        </div>

        <!-- Right column for login form -->
        <div class="col-md-6 bg-white p-3">
            <form name='login' method="POST" action="db/operations/loginhandler.php">
              <h4>Login</h4>
            <?php 
                  if (isset($_SESSION['error_message'])) { 
                  ?>
                  <div class="alert alert-danger mt-3" role="alert">
                      <?php 
                      echo $_SESSION['error_message']; 
                      unset($_SESSION['error_message']);
                      ?>
                  </div>
                  <?php 
                  } 
                  ?>
                <div class="form-group mb-3">
                    <label for="email">Username:</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter username" name="uname" required>
                </div>
                <div class="form-group mb-3">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="psw" required>
                </div>
                
                <div class="d-flex justify-content-between">
                <div class="form-group mb-3 form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember"> Remember me
                    </label>
                </div>
                <button type="submit" 
                class="btn btn-outline-primary">  
                Login
              </button>                
              </div>
                
                <!-- Alert Message Here -->
                
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>  </body>
</html>



<?php
require ('header.php');
include '../db/operations/users.php';
if(!isset($_SESSION)) {
  session_start();
}
$userDetails = [];

if (session_id() != '' && isset($_SESSION["username"])) {
  $user = $_SESSION["username"];
  $userDetails = getUser($user);
  $username=$userDetails['username'];
  $password=$userDetails["password"];
  $fullname = $userDetails["fullname"];
  $address = $userDetails["address"];
  $email = $userDetails["email"];
  $phone= $userDetails["phone"];
  $degree = $userDetails["degree"];
}
 ?>
<div class="container mt-5 card p-3 shadow-lg">
  <form action="/PRMS/db/operations/updateAccountHandler.php" method="post">
    <h5>Update Account</h5>
    <?php 
      if (isset($_SESSION['success_message'])) { 
      ?>
      <div class="alert alert-success mt-3" role="alert">
          <?php 
          echo $_SESSION['success_message']; 
          unset($_SESSION['success_message']);
          ?>
      </div>
      <?php 
      } else if (isset($_SESSION['error_message'])) { 
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
  <div class="row">
  <input type="hidden" name="act" value="<?php echo $_SESSION["username"]; ?>"/>
    <div class="col-md-6">
      <label for="form-label">Username</label>
      <input type="text" class="form-control mb-3" name="username" placeholder="Username" value="<?php echo $username; ?>" required/>
    </div>
    <div class="col-md-6">
      <label for="form-label">Password</label>
      <input type="password" name="password" class="form-control mb-3" placeholder="Password" value="<?php echo $password; ?>" required/>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <label for="form-label">Name</label>
      <input type="text" class="form-control mb-3" name="fullname" placeholder="Name" value="<?php echo $fullname; ?>" required/>
    </div>
    <div class="col-md-6">
      <label for="form-label">Email</label>
      <input type="email" name="email" class="form-control mb-3" placeholder="Email" value="<?php echo $email; ?>" required/>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <label for="form-label">Phone Number</label>
      <input type="tel" class="form-control mb-3" name="phone" placeholder="Phone Number" value="<?php echo $phone; ?>" required/>
    </div>
    <div class="col-md-6">
      <label for="form-label">Degree</label>
      <input type="text" name="degree" class="form-control mb-3" placeholder="Degree" value="<?php echo $degree; ?>" required/>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <label for="form-label">Address</label>
      <input type="text" class="form-control mb-3" name="address" placeholder="Address" value="<?php echo $address; ?>" required/>
    </div>
    
  </div>
  <div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-outline-success">Save</button>
    </div>
  </form>
</div>

<?php
require ('footer.php');
?>
  

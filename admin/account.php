

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

}
 ?>
<div class="mx-3 mt-5 card p-3">
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
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Account Details</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Edit Account</button>
  </li>
</ul>

<div class="tab-content container" id="pills-tabContent">
  <div class="tab-pane fade show active card p-3" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  
  <div class="row">
    <div class="col-md-4">
      <h6 for="form-label">Username</h6>
      <p class="text-capitalize"><?php echo $username; ?></p class="text-capitalize">
    </div>
    <div class="col-md-4">
      <h6 for="form-label">Fullname</h6>
      <p class="text-capitalize"><?php echo $fullname; ?></p class="text-capitalize">
    </div>
    <div class="col-md-4">
      <h6 for="form-label">Email</h6>
      <p><?php echo $email; ?></p class="text-capitalize">
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <h6 for="form-label">Phone Number</h6>
      <p class="text-capitalize"><?php echo $phone; ?></p class="text-capitalize">
    </div>
    <div class="col-md-4">
      <h6 for="form-label">Address</h6>
      <p class="text-capitalize"><?php echo $address; ?></p class="text-capitalize">
    </div>
    <div class="col-md-4">

    </div>
  </div>
</div>
<div class="tab-pane fade card p-3" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
<!--  -->
<form action="/PRMS/db/operations/updateAccountHandler.php" method="post">
  <div class="row">
    <div class="col-md-6">
      <label for="form-label">Username</label>
      <input type="text" class="form-control mb-3" readonly name="username" placeholder="Username" value="<?php echo $username; ?>" required/>
    </div>
    <div class="col-md-6">
      <label for="form-label">Password</label>
      <input type="password" name="password" class="form-control mb-3" placeholder="Password" required/>
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
      <label for="form-label">Address</label>
      <input type="text" class="form-control mb-3" name="address" placeholder="Address" value="<?php echo $address; ?>" required/>
    </div>
  </div>
  <div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-outline-success">Save</button>
    </div>
  </form>
<!--  -->
</div>

</div>
</div>

<?php
require ('footer.php');
?>
  

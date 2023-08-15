

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
<div class="container mt-5 card p-3">
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
      <h6 for="form-label">Degree</h6>
      <p class="text-capitalize"><?php echo $degree; ?></p class="text-capitalize">
    </div>
    <div class="col-md-4">
      <h6 for="form-label">Address</h6>
      <p class="text-capitalize"><?php echo $address; ?></p class="text-capitalize">
    </div>
  </div>
</div>

<?php
require ('footer.php');
?>
  

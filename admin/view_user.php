

<?php
require ('header.php');
include '../db/operations/users.php';
if(!isset($_SESSION)) {
  session_start();
}
$userDetails = [];

if (session_id() != '' && isset($_SESSION["username"])) {
    $user = $_GET['id'];
  $userDetails = getUserById($user);
  $username=$userDetails['username'];
  $password=$userDetails["password"];
  $fullname = $userDetails["fullname"];
  $address = $userDetails["address"];
  $email = $userDetails["email"];
  $phone= $userDetails["phone"];

}
 ?>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 

<div class="modal fade bd-example-modal-lg" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion?</h5>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete the user?</p>
            <form class="d-flex justify-content-around" action="/PRMS/db/operations/deleteUser.php" method="post">
                <input type="text" hidden name="username" id="username" value=<?php echo $username?>>
                <button type="button" data-dismiss="modal" class="btn btn-outline-danger">Cancel</button>
                <button type="submit" class="btn btn-outline-success">Delete</button>
            </form>
        </div>
    </div>
  </div>
</div>
<div class="mx-3 mt-5 card p-3">
    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
        <button type="button" 
        class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
        </svg> 
        Delete User
        </button>
        </div>
    </div>
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
        <input type="hidden" name="act" value="<?php echo $_SESSION["username"]; ?>"/>
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
  

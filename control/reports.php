
<?php require('header.php');

include '../db/operations/users.php';
if(!isset($_SESSION)) {
  session_start();
}
$befores = [];
$afters = [];
$monthlys = [];
$users = [];


if (session_id() != '' && isset($_SESSION["username"])) {
  $user = $_SESSION["username"];
  $user = getUser($user);
  $user_id=$user['ID'];
  $befores = getAllUsersHealth("before");
  $afters = getAllUsersHealth("after");
  $monthlys = getAllUsersHealth("monthly");
  $users = getPatients();



  
}
?>

<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

<!-- Responsive datatable examples -->
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> -->
<!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> -->

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .table-col{
        font-weight: 400 !important;
        font-size:1em !important;
    }
</style>


<div class="mx-3 mt-5 card p-3 bg-white shadow-sm">
<div class="d-flex justify-content-end">
        <button type="button" 
        class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-pulse" viewBox="0 0 16 16">
        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
        <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
        <path d="M9.979 5.356a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.926-.08L4.69 10H4.5a.5.5 0 0 0 0 1H5a.5.5 0 0 0 .447-.276l.936-1.873 1.138 3.793a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h.5a.5.5 0 0 0 0-1h-.128L9.979 5.356Z"/>
        </svg>  
        New Test
</button>
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
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Session before dialysis</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Session after dialysis</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-monthly-tab" data-bs-toggle="pill" data-bs-target="#pills-monthly" type="button" role="tab" aria-controls="pills-monthly" aria-selected="false">Monthly dialysis</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="container">
        <div class="card p-3 shadow-sm">
            <table class="table align-middle datatable dt-responsive table-check" id="before"
                    style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Body weight</th>
                    <th scope="col">Blood pressure</th>
                    <th scope="col">Haemoglobin</th>
                    <th scope="col">Temperature</th>
                    <th scope="col">Oxygen saturation</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($befores as $before){
                        $health_id = $before['id'];
                        ?>
                        <tr>
                        <th class="table-col"><?php echo $before['fullname']?></th>
                        <th class="table-col"><?php echo $before['body_weight']." kg"?></th>
                        <th class="table-col"><?php echo $before['blood_pressure']." mm Hg"?></th>
                        <th class="table-col"><?php echo $before['haemoglobin']." g/dL"?></th>
                        <th class="table-col"><?php echo $before['temperature']."°C"?></th>
                        <th class="table-col"><?php echo $before['oxygen_saturation']."%"?></th>
                        <th class="table-col"><?php echo date('j M, Y', strtotime($before['date']))?></th>
                        <th class="table-col">
                                <a role="button" <?php echo "href=view_report.php?id=$health_id"  ?>
                                class="btn btn-sm btn-outline-primary" id="dropdownMenu2" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>    
                                View
                                </a>
                            </th>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
  
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="container">
        <div class="card p-3 shadow-sm">
            <table class="table align-middle datatable dt-responsive table-check" id="after"
                    style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Body weight</th>
                    <th scope="col">Blood pressure</th>
                    <th scope="col">Heart rate</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($afters as $after){
                        $health_id = $after['id'];
                        ?>
                        <tr>
                        <th class="table-col"><?php echo $after['fullname']?></th>
                        <th class="table-col"><?php echo $after['body_weight']." kg"?></th>
                        <th class="table-col"><?php echo $after['blood_pressure']." mm Hg"?></th>
                        <th class="table-col"><?php echo $after['heart_rate']." bpm"?></th>
                        <th class="table-col"><?php echo date('j M, Y', strtotime($after['date']))?></th>
                        <th class="table-col">
                                <a role="button" <?php echo "href=view_report.php?id=$health_id"  ?>
                                class="btn btn-sm btn-outline-primary" id="dropdownMenu2" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>    
                                View
                                </a>
                            </th>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


  </div>
  <div class="tab-pane fade" id="pills-monthly" role="tabpanel" aria-labelledby="pills-monthly-tab">

  <div class="container">
        <div class="card p-3 shadow-sm">
            <table class="table align-middle datatable dt-responsive table-check" id="monthly"
                    style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Body weight</th>
                    <th scope="col">Blood pressure</th>
                    <th scope="col">Haemoglobin</th>
                    <th scope="col">Temperature</th>
                    <th scope="col">Oxygen saturation</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($monthlys as $monthly){
                        $health_id = $monthly['id'];
                        ?>
                        <tr>
                        <th class="table-col"><?php echo $monthly['fullname']?></th>
                        <th class="table-col"><?php echo $monthly['body_weight']." kg"?></th>
                        <th class="table-col"><?php echo $monthly['blood_pressure']." mm Hg"?></th>
                        <th class="table-col"><?php echo $monthly['haemoglobin']." g/dL"?></th>
                        <th class="table-col"><?php echo $monthly['temperature']."°C"?></th>
                        <th class="table-col"><?php echo $monthly['oxygen_saturation']."%"?></th>
                        <th class="table-col"><?php echo date('j M, Y', strtotime($monthly['date']))?></th>
                        <th class="table-col">
                                <a role="button" <?php echo "href=view_report.php?id=$health_id"  ?>
                                class="btn btn-sm btn-outline-primary" id="dropdownMenu2" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>    
                                View
                                </a>
                            </th>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

  </div>

</div>
</div>

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Test</h5>
      </div>
      <div class="modal-body">
      <form action="/PRMS/db/operations/newTestHandler.php" method="post" class="card p-3">
        <!--  -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="user_id">Patient</label>
                <select class="form-select form-select" name="user_id" id="user_id">
                    <?php foreach($users as $user){
                        ?>
                    <option value=<?php echo $user['ID']?>>
                    <?php echo $user['fullname']?>
                    </option>
                    <?php    
                    }?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="">Test Type</label>
                <select class="form-select form-select" name="test_type" id="test_type">
                    <option selected value="before">Session before dialysis</option>
                    <option value="after">Session after dialysis</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>
            <div class="col-md-4">
                
            </div>

        </div>
        <!--  -->
        <div class="row mb-3" id="row1">
            <div class="col-md-4">
                <label for="">Magnesium</label>
                <input type="number" steps="0.1" name="magnesium" class="form-control" id="magnesium" required>
            </div>
            <div class="col-md-4">
                <label for="">Phosphate</label>
                <input type="number" steps="0.1" name="phosphate" class="form-control" id="phosphate" required>
            </div>
            <div class="col-md-4">
                <label for="">Potassium</label>
                <input type="number" steps="0.1" name="potassium" class="form-control" id="potassium" required>
            </div>

        </div>

        <!--  -->
        <div class="row mb-3" id="row2">
            <div class="col-md-4">
                <label for="">Sodium</label>
                <input type="number" steps="0.1" name="sodium" class="form-control" id="sodium" required>
            </div>
            <div class="col-md-4">
                <label for="">Calcium</label>
                <input type="number" steps="0.1" name="calcium" class="form-control" id="calcium" required>
            </div>
            <div class="col-md-4">
                <label for="">Blood flow rate</label>
                <input type="number" steps="0.1" name="blood_flow_rate" class="form-control" id="blood_flow_rate" required>
            </div>

        </div>
        <!--  -->
        <div class="row mb-3" id="row1">
            <div class="col-md-4">
                <label for="">Dialysate flow rate</label>
                <input type="number" steps="0.1" name="dialysate_flow_rate" class="form-control" id="dialysate_flow_rate" required>
            </div>
            <div class="col-md-4">
                <label for="">Urea</label>
                <input type="number" steps="0.1" name="urea" class="form-control" id="urea" required>
            </div>
            <div class="col-md-4">
                <label for="">Creatinine</label>
                <input type="number" steps="0.1" name="creatinine" class="form-control" id="creatinine" required>
            </div>

        </div>
        <!--  -->
        <div class="row mb-3">
        <div class="col-md-4">
                <label for="">Body weight</label>
                <input type="number" steps="0.1" name="body_weight" class="form-control" id="body_weight" required>
            </div>
            <div class="col-md-4">
                <label for="">Blood pressure</label>
                <input type="number" steps="0.1" name="blood_pressure" class="form-control" id="blood_pressure" required>
            </div>
            <div class="col-md-4">
                <label for="">Heart rate</label>
                <input type="number" steps="0.1" name="heart_rate" class="form-control" id="heart_rate" required>
            </div>

        </div>

        <!--  -->
        <div class="row mb-3" id="row5">
        <div class="col-md-4">
                <label for="">Haemoglobin</label>
                <input type="number" steps="0.1" name="haemoglobin" class="form-control" id="haemoglobin" required>
            </div>
            <div class="col-md-4">
                <label for="">Temperature</label>
                <input type="number" steps="0.1" name="temperature" class="form-control" id="temperature" required>
            </div>
            <div class="col-md-4">
                <label for="">Oxygen saturation</label>
                <input type="number" steps="0.1" name="oxygen_saturation" class="form-control" id="oxygen_saturation" required>
            </div>

        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-outline-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    $('#row1, #row2, #row3').hide();  
    $('#row1 input, #row2 input, #row3 input').removeAttr('required'); // Remove the 'required' attribute

    $('#before').DataTable();
    $('#after').DataTable();
    $('#monthly').DataTable();


    $('#test_type').on('change', function() {
        $('#row1, #row2, #row3, #row4, #row5').show();  
        $('#row1 input, #row2 input, #row3 input, #row4 input, #row5 input').attr('required'); // Remove the 'required' attribute

        if ($(this).val() === 'before') { 
            $('#row1, #row2, #row3').hide(); 
            $('#row1 input, #row2 input, #row3 input').removeAttr('required'); // Remove the 'required' attribute

            console.log("before"); 
        } else if($(this).val() === 'after') {
            $('#row1, #row2, #row3, #row4, #row5').hide();  
            $('#row1 input, #row2 input, #row3 input, #row4 input, #row5 input').removeAttr('required'); // Remove the 'required' attribute

            console.log("after"); 
        } else if($(this).val() === 'monthly') {
            $('#row1, #row2, #row3, #row4, #row5').show();  
            console.log("monthly"); 
        }
    });

});
</script>

<?php require('footer.php')?>





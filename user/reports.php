
<?php require('header.php');

include '../db/operations/users.php';
if(!isset($_SESSION)) {
  session_start();
}
$befores = [];
$afters = [];
$monthlys = [];


if (session_id() != '' && isset($_SESSION["username"])) {
  $user = $_SESSION["username"];
  $user = getUser($user);
  $user_id=$user['ID'];
  $befores = getUsersHealth($user_id, "before");
  $afters = getUsersHealth($user_id, "after");
  $monthlys = getUsersHealth($user_id, "monthly");



  
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

<style>
    .table-col{
        font-weight: 400 !important;
        font-size:1em !important;
    }
</style>

<div class="mx-3 mt-5 card p-3 bg-white shadow-sm">
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
                    <!-- <th scope="col">Name</th> -->
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
                        <!-- <th scope="col">Name</th> -->
                        <th class="table-col"><?php echo $before['body_weight']." kg"?></th>
                        <th class="table-col"><?php echo $before['blood_pressure']." /56"?></th>
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
                    <!-- <th scope="col">Name</th> -->
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
                        <!-- <th scope="col">Name</th> -->
                        <th class="table-col"><?php echo $after['body_weight']." kg"?></th>
                        <th class="table-col"><?php echo $after['blood_pressure']." /56"?></th>
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
                    <!-- <th scope="col">Name</th> -->
                    <th scope="col">Body weight</th>
                    <th scope="col">Blood pressure</th>
                    <th scope="col">Haemoglobin</th>
                    <th scope="col">Creatinine</th>
                    <th scope="col">Potassium</th>
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
                        <!-- <th scope="col">Name</th> -->
                        <th class="table-col"><?php echo $monthly['body_weight']." kg"?></th>
                        <th class="table-col"><?php echo $monthly['blood_pressure']." /56"?></th>
                        <th class="table-col"><?php echo $monthly['haemoglobin']." g/dL"?></th>
                        <th class="table-col"><?php echo $monthly['creatinine']." mg/dL"?></th>
                        <th class="table-col"><?php echo $monthly['potassium']." mEq/L"?></th>
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

<script>
$(document).ready(function() {
    $('#before').DataTable();
    $('#after').DataTable();
    $('#monthly').DataTable();

});
</script>

<?php require('footer.php')?>





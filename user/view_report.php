
<?php require('header.php');

include '../db/operations/users.php';
if(!isset($_SESSION)) {
  session_start();
}
$userDetails = [];

if (session_id() != '' && isset($_SESSION["username"])) {
  $id = $_GET['id'];
  $userDetail = getUserHealth($id);
//   echo print_r($userDetails);
  $body_weight = $userDetail['body_weight'];
  $blood_pressure = $userDetail['blood_pressure'];
  $heart_rate = $userDetail['heart_rate'];
  $temperature = $userDetail['temperature'];
  $oxygen_saturation = $userDetail['oxygen_saturation'];

  $magnesium = $userDetail['magnesium'];
  $phosphate = $userDetail['phosphate'];
  $potassium = $userDetail['potassium'];
  $sodium = $userDetail['sodium'];
  $calcium = $userDetail['calcium'];

  $blood_flow_rate = $userDetail['blood_flow_rate'];
  $dialysate_flow_rate = $userDetail['dialysate_flow_rate'];
  $urea = $userDetail['urea'];
  $creatinine = $userDetail['creatinine'];
  $haemoglobin = $userDetail['haemoglobin'];
  
}
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<style>
    .table-col{
        font-weight: 400 !important;
        font-size:1em !important;
    }
</style>

<div class="mx-3 mt-5 card p-3 bg-white shadow-sm">
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Health Results</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Misc</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="container">
        <div class="card p-3 shadow-sm">
            <div class="row">
              <div class="col-md-4">
                <h6 for="form-label">Magnesium</h6>
                <p><?php echo $magnesium." mg/dL"; ?></p>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Phosphate</h6><?php echo $phosphate." mg/d"; ?></p>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Potassium</h6>
                <p><?php echo $potassium." mEq/L"; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <h6 for="form-label">Sodium</h6>
                <p><?php echo $sodium." mEq/L"; ?></p>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Calcium</h6>
                <p><?php echo $calcium." mg/dL"; ?></p>
              </div>
            <div class="col-md-4">
              <h6 for="form-label">Blood Flow Rate</h6>
              <p><?php echo $blood_flow_rate." ml/min"; ?></p>
            </div>
          </div>
          <div class="row">
              <div class="col-md-4">
                <h6 for="form-label">Dialysate Flow Rate</h6>
                <p><?php echo $dialysate_flow_rate." ml/min"; ?></p>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Urea</h6><?php echo $urea." mg/dL"; ?></p>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Creatinine</h6>
                <p><?php echo $creatinine." mg/dL"; ?></p>
              </div>
            </div>
            <!--  -->
            <div class="row">
              <div class="col-md-4">
                <h6 for="form-label">Haemoglobin</h6>
                <p><?php echo $haemoglobin." g/dL"; ?></p>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Blood Pressure</h6><?php echo $blood_pressure." mm Hg"; ?></p>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Heart Rate</h6>
                <p><?php echo $heart_rate; ?></p>
              </div>
            </div>
            <!--  -->
            <div class="row">
              <div class="col-md-4">
                <h6 for="form-label">Body Weight</h6>
                <p><?php echo $body_weight ." kg"; ?></p>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Temperature</h6><?php echo $temperature."°C"; ?></p>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Oxygen Saturation</h6>
                <p><?php echo $oxygen_saturation."%"; ?></p>
              </div>
            </div>
            <!--  -->
        </div>
    </div>
  
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">Misc</div>
</div>
</div>

<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>

<?php require('footer.php')?>





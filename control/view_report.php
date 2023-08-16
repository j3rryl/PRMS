
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
  $test_type = $userDetail['test_type'];
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
    .status-color{
    display: inline-block;
    padding: 5px !important;
    font-size: 80% !important;
    font-weight: bold;
    /* line-height: 1; */
    width: 5rem;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    border-radius: 10px;
  }
  /* .low {
    background-color: rgba(52, 152, 219, 0.2) !important;
    color: rgb(52, 152, 219);
  } */
  .low {
    background-color: rgba(155, 89, 182,0.2);
    color: rgb(155, 89, 182);
  }
  .normal {
    background-color: rgba(39, 174, 96, 0.2);
    color: rgb(39, 174, 96);
  }
  .high {
    background-color: rgba(231, 76, 60, 0.2);
    color: rgb(231, 76, 60);
  }
</style>

<div class="mx-3 mt-5 card p-3 bg-white shadow-sm">
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Health Results</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Miscellaneous</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="container">
        <div class="card p-3 shadow-sm">
          <?php if($test_type=="monthly"){
          ?>
            <div class="row mb-3">
              <div class="col-md-4">
                <h6 for="form-label">Magnesium</h6>
                <p><?php echo $magnesium." mg/dL"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($magnesium<1.5){
                    echo "low";
                  } else if($magnesium<2.5){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($magnesium<1.5){
                    echo "low";
                  } else if($magnesium<2.5){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Phosphate</h6>
                <p><?php echo $phosphate." mg/d"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($phosphate<2.5){
                    echo "low";
                  } else if($phosphate<5.5){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($phosphate<2.5){
                    echo "low";
                  } else if($phosphate<5.5){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Potassium</h6>
                <p><?php echo $potassium." mEq/L"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($potassium<3.5){
                    echo "low";
                  } else if($potassium<5){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($potassium<3.5){
                    echo "low";
                  } else if($potassium<5){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <h6 for="form-label">Sodium</h6>
                <p><?php echo $sodium." mEq/L"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($sodium<135){
                    echo "low";
                  } else if($sodium<145){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($sodium<135){
                    echo "low";
                  } else if($sodium<145){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Calcium</h6>
                <p><?php echo $calcium." mg/dL"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($calcium<8.4){
                    echo "low";
                  } else if($calcium<10.2){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($calcium<8.4){
                    echo "low";
                  } else if($calcium<10.2){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
            <div class="col-md-4">
              <h6 for="form-label">Blood Flow Rate</h6>
              <p><?php echo $blood_flow_rate." ml/min"; ?></p>
              <span class="text-capitalize status-color <?php 
                  if($blood_flow_rate<200){
                    echo "low";
                  } else if($blood_flow_rate<500){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($blood_flow_rate<200){
                    echo "low";
                  } else if($blood_flow_rate<500){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
            </div>
          </div>
          <div class="row mb-3">
              <div class="col-md-4">
                <h6 for="form-label">Dialysate Flow Rate</h6>
                <p><?php echo $dialysate_flow_rate." ml/min"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($dialysate_flow_rate<500){
                    echo "low";
                  } else if($dialysate_flow_rate<700){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($dialysate_flow_rate<500){
                    echo "low";
                  } else if($dialysate_flow_rate<700){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Urea</h6><?php echo $urea." mg/dL"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($urea<10){
                    echo "low";
                  } else if($urea<20){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($urea<10){
                    echo "low";
                  } else if($urea<20){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Creatinine</h6>
                <p><?php echo $creatinine." mg/dL"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($creatinine<0.6){
                    echo "low";
                  } else if($creatinine<1.2){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($creatinine<0.6){
                    echo "low";
                  } else if($creatinine<1.2){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
            </div>

            <?php
            }
            ?>
            <!--  -->
            <div class="row mb-3">
            <div class="col-md-4">
                <h6 for="form-label">Body Weight</h6>
                <p><?php echo $body_weight ." kg"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($body_weight<65){
                    echo "low";
                  } else if($body_weight<120){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($body_weight<65){
                    echo "low";
                  } else if($body_weight<120){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
                
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Blood Pressure</h6><?php echo $blood_pressure." mm Hg"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($blood_pressure<120){
                    echo "low";
                  } else if($blood_pressure<140){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($blood_pressure<120){
                    echo "low";
                  } else if($blood_pressure<140){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
              <?php if($test_type=="before"){
              ?>
              <div class="col-md-4">
                <h6 for="form-label">Heart Rate</h6>
                <p><?php echo $heart_rate." bpm"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($heart_rate<65){
                    echo "low";
                  } else if($heart_rate<84){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($heart_rate<65){
                    echo "low";
                  } else if($heart_rate<84){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
            </div>
            <!--  -->
            <div class="row">
            <div class="col-md-4">
                <h6 for="form-label">Haemoglobin</h6>
                <p><?php echo $haemoglobin." g/dL"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($haemoglobin<11){
                    echo "low";
                  } else if($haemoglobin<11){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($haemoglobin<11){
                    echo "low";
                  } else if($haemoglobin<11){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
              
              <div class="col-md-4">
                <h6 for="form-label">Temperature</h6><?php echo $temperature."°C"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($temperature<36){
                    echo "low";
                  } else if($temperature<38){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($temperature<36){
                    echo "low";
                  } else if($temperature<38){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
              <div class="col-md-4">
                <h6 for="form-label">Oxygen Saturation</h6>
                <p><?php echo $oxygen_saturation."%"; ?></p>
                <span class="text-capitalize status-color <?php 
                  if($oxygen_saturation<95){
                    echo "low";
                  } else if($oxygen_saturation<100){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>">
                  <?php 
                  if($oxygen_saturation<95){
                    echo "low";
                  } else if($oxygen_saturation<100){
                    echo "normal";
                  } else {
                    echo "high";
                  }
                  ?>
                </span>
              </div>
            </div>
            <?php }?>
            <!--  -->
        </div>
    </div>
  
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">Miscellaneous</div>
</div>
</div>

<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>

<?php require('footer.php')?>




